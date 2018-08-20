<?php

namespace App\Http\Controllers\CasinoAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Services\CasinoAdmin\GameResultService;
use App\Http\Requests\GameResultModifyRequest;
use App\Http\Requests\GameResultCancelRequest;


/**
 * @property GameResultService gameResultService
 */
class GameResultModifyController extends VoyagerBaseController
{
    /**
     * GameResultModifyController constructor.
     * @param GameResultService $gameResultService
     */
    public function __construct(
        GameResultService $gameResultService
    ) {
        $this->gameResultService = $gameResultService;
    }

    /**
     * @param Request $request
     * @param null $responseString
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, $responseString=null)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
        $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
        $orderBy = $request->get('order_by');
        $sortOrder = $request->get('sort_order', null);

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $relationships = $this->getRelationships($dataType);

            $model = app($dataType->model_name);
            $query = $model::select('*')->with($relationships);

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
                $query->where($search->key, $search_filter, $search_value);
            }

            if ($orderBy && in_array($orderBy, $dataType->fields())) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'DESC';
                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        if (($isModelTranslatable = is_bread_translatable($model))) {
            $dataTypeContent->load('translations');
        }

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return Voyager::view('vendor.voyager.baccarathistory.browse', compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'sortOrder',
            'searchable',
            'isServerSide',
            'responseString'
        ));
    }

    /**
     * @param GameResultCancelRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function putCancel(GameResultCancelRequest $request)
    {
        Voyager::canOrFail('browse_BaccaratHistory');

        // 1. Call Game Server API to cancel remote Database
        $responseString = $this->gameResultService->putCancel($request);

        if ( !$this->isResultSuccess($responseString)) {
            return redirect('admin/baccarathistory')->withErrors([$responseString]);
        }

        // 2. Modify On-spot Database
        $this->gameResultService->modifyBaccaratHistory($request);

        return redirect('admin/baccarathistory')->with('Message', $responseString);
    }

    /**
     * @param GameResultModifyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putModify(GameResultModifyRequest $request)
    {
        Voyager::canOrFail('browse_BaccaratHistory');

        // 1. Call Game Server API to modify remote Database
        $responseString = $this->gameResultService->putModify($request);

        if ( !$this->isResultSuccess($responseString)) {
            return redirect('admin/baccarathistory')->withErrors([$responseString]);
        }

        // 2. Modify On-spot Database
        $this->gameResultService->modifyBaccaratHistory($request);

        return redirect('admin/baccarathistory')->with('Message', $responseString);
    }

    /**
     * @param $responseString
     * @return bool
     */
    private function isResultSuccess($responseString)
    {
        $temp = (explode(",", explode(":", $responseString)[2])[0]);
        $result = str_replace('"', '', $temp);

        return $result == "error" ? false : true;
    }
}

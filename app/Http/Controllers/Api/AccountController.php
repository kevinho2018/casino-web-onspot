<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/20
 * Time: 下午4:45
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Api\AccountService;

/**
 * Class AccountController
 * @property AccountService accountService
 * @package App\Http\Controllers\Api
 */
class AccountController extends ApiController
{
    /**
     * AccountController constructor.
     * @param AccountService $accountService
     */
    public function __construct(
        AccountService $accountService
    ) {
        $this->accountService = $accountService;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function getLoginValidation(Request $request)
    {
        return $this->accountService->getLoginValidation();
    }
}

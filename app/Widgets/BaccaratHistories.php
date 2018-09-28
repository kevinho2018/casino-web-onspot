<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/22
 * Time: 上午11:02
 */

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class BaccaratHistories extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Models\BaccaratHistory\BaccaratHistory::count();
        $string = 'Baccarat games';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-controller',
            'title'  => "{$count} {$string}",
            'text'   => __('voyager::dimmer.post_text', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => '遊戲改單取消',
                'link' => route('voyager.baccarathistory.index'),
            ],
            'image' => '/images/baccarat-history-bg.jpg',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', \App\Models\BaccaratHistory\BaccaratHistory::getModel());
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/12/10
 * Time: 11:39 AM
 */

namespace App\Http\Controllers\CasinoAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class VoyagerController
 * @package App\Http\Controllers\CasinoAdmin
 */
class VoyagerController extends Controller
{
    /**
     * @return mixed
     */
    public function getLogout()
    {
        return redirect()->route('login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
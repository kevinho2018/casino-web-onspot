<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/20
 * Time: 下午4:58
 */

namespace App\Repositories;

use App\Models\users;

/**
 * Class UsersRepository
 * @package App\Repositories
 */
class UsersRepository
{
    /**
     * @var users
     */
    protected $users;

    /**
     * @param $email
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
   public function getPasswordByEmail($email)
   {
       return $this->users
           ->select(['password'])
           ->where('email', '=', $email)
           ->first();
   }
}

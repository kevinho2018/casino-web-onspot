<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/20
 * Time: 下午4:55
 */

namespace App\Services\Api;

use App\Repositories\UsersRepository;

/**
 * Class AccountService
 * @property UsersRepository usersRepository
 * @package App\Services\Api
 */
class AccountService
{
    /**
     * AccountService constructor.
     * @param UsersRepository $usersRepository
     */
    public function __construct(
        UsersRepository $usersRepository
    ) {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @return string
     */
    public function getLoginValidation()
    {
        $email = 'CasinoManager@ifalo.com.tw';
        $hashedPassword = $this->usersRepository->getPasswordByEmail($email);
        $returnBody = ['status' => 'Success', 'data' => $hashedPassword];

        return response()->json($returnBody);
    }
}
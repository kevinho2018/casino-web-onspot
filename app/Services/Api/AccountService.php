<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/20
 * Time: 下午4:55
 */

namespace App\Services\Api;

use App\Repositories\UsersRepository;
use Hash;

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
     * @param $input
     * @return bool
     */
    public function getLoginValidation($input)
    {
        $hashedPassword = $this->usersRepository->getPasswordByEmail($input['email']);
        $plain_text = ($input['password']);

        if (Hash::check($plain_text, $hashedPassword['password']) ) {
            return json_encode(['status' => 'Success']);
        }

        return json_encode(['status' => 'Failed']);
    }
}
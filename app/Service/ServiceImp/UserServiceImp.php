<?php


namespace App\Service\ServiceImp;


use App\Http\Service\UserService;
use App\Like;
use App\User;

class UserServiceImp implements UserService
{
    protected $userRepository;


    public function __construct(User $user)
    {
        $this->userRepository = $user->query();

    }

    /**
     * 获取用户信息
     * @param int $id
     * @return User
     */
    public function getInfo($id)
    {
        $user = $this->userRepository->findOrFail($id);
        return $user;
    }


    public function find($user_id)
    {
        $user = $this->userRepository->find($user_id);
        return $user;
    }

    public function lookpost($user_id)
    {
        $user = $this->userRepository->findOrFail($user_id);
        return $user;
    }

}

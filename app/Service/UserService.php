<?php


namespace App\Http\Service;


interface UserService
{
    public function getInfo($id);

    public function find($user_id);

    public function lookpost($user_id);



}

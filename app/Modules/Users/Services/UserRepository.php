<?php


namespace App\Modules\Users\Services;


use App\Modules\Users\DAO\UserCreateDAO;
use App\Modules\Users\Models\UserRepository as Model;

class UserRepository
{
    public function create(UserCreateDAO $dao):bool
    {
        return Model::create($dao->getEmail(), $dao->getName(), $dao->getPassword());
    }
}

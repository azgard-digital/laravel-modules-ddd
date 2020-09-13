<?php


namespace App\Modules\Users\Services;


use App\Interfaces\DAO\IUserCreateDAO;
use App\Modules\Users\Models\UserRepository as Model;

class UserRepository
{
    public function create(IUserCreateDAO $dao):bool
    {
        return Model::create($dao->getEmail(), $dao->getName(), $dao->getPassword());
    }
}

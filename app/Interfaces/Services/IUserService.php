<?php


namespace App\Interfaces\Services;

use App\Interfaces\DAO\IUserCreateDAO;
use App\Interfaces\DAO\IUserAuthDAO;

interface IUserService
{
    /**
     * @param IUserCreateDAO $dao
     * @return IUserAuthDAO
     */
    public function create(IUserCreateDAO $dao):IUserAuthDAO;
}

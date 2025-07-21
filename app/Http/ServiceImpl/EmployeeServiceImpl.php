<?php

namespace App\Http\ServiceImpl;

use App\Http\Interfaces\RepoInterfaces\EmployeeRepoInterface;

class EmployeeServiceImpl{
    protected $employee_repo;
    function __construct(){
        $this->employee_repo = app(EmployeeRepoInterface::class);
    }

    function index($request){
        return $this->employee_repo->index($request);
    }
}
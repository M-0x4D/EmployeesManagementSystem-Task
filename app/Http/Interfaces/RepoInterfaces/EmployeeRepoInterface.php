<?php

namespace App\Http\Interfaces\RepoInterfaces;

interface EmployeeRepoInterface{
    function index($request);

    function store($request);
}
<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ServiceInterfaces\EmployeeServiceInterface;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\IndexEmployeeResource;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    protected $employee_service;
    function __construct()
    {
        $this->employee_service = app(EmployeeServiceInterface::class);
    }

    function index(Request $request)
    {
        $employees = $this->employee_service->index($request);
        return IndexEmployeeResource::collection($employees);
    }

    function store(StoreEmployeeRequest $request)
    {
        $this->employee_service->store($request);
        return response()->json('created', 201);
    }
}

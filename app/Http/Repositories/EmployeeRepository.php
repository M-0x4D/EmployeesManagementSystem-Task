<?php

namespace App\Http\Repositories;

use App\Models\Employee;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class EmployeeRepository
{

    function index($request)
    {
        try {

            $pageSize = $request->pageSize ?? 10;
            $page = $request->page ?? 1;

            $cacheKey = 'employees:' . md5(json_encode([
                'search'        => $request->search,
                'status'        => $request->status,
                'hired_at'      => $request->hired_at,
                'department_id' => $request->department_id,
                'user_id'       => $request->user_id,
                'page'          => $page,
                'pageSize'      => $pageSize,
            ]));

            return Cache::tags(['employees'])->remember($cacheKey, 60, function () use ($request, $pageSize) {
                $query = Employee::query();
                $query->when($request->filled('search'), function ($q) use ($request) {
                    $term = $request['search'];
                    $q->where(function ($sub) use ($term) {
                        $sub->where('name', 'LIKE', "%$term%")
                            ->orWhere('phone', 'LIKE', "%$term%")
                            ->orWhere('email', 'LIKE', "%$term%");
                    });
                });
                $query->when($request->filled('status'), fn($q) => $q->where('status', $request->status));
                $query->when($request->filled('hired_at'), fn($q) => $q->where('hired_at', $request->hired_at));
                $query->when($request->filled('department_id'), fn($q) => $q->where('department_id', $request->department_id));
                $query->when($request->filled('user_id'), fn($q) => $q->where('id', $request->user_id));
                return $query->with('department')->paginate($pageSize);
            });
        } catch (\Throwable $th) {
            report($th->getMessage());
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    function store($request)
    {
        try {
            DB::beginTransaction();

            Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => 'active',
                'position' => $request->position,
                'salary' => $request->salary,
                'hired_at' => $request->hired_at,
                'department_id' => $request->department_id,
                'avatar' => $request->file('avatar')
            ]);

            // invalidate cache when data change
            Cache::tags(['employees'])->flush();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

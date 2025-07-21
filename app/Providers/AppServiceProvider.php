<?php

namespace App\Providers;

use App\Http\Interfaces\RepoInterfaces\EmployeeRepoInterface;
use App\Http\Interfaces\ServiceInterfaces\EmployeeServiceInterface;
use App\Http\Repositories\EmployeeRepository;
use App\Http\ServiceImpl\EmployeeServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(EmployeeServiceInterface::class, EmployeeServiceImpl::class);
        $this->app->bind(EmployeeRepoInterface::class, EmployeeRepository::class);
        
    }
}

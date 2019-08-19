<?php

namespace Payroll;

use Illuminate\Support\ServiceProvider;
use Payroll\Domain\Model\Employee\EmployeeRepositoryInterface;
use Payroll\Infra\Repository\Employee\EmployeeRepository;

class PayrollServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

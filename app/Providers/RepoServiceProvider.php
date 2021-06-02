<?php

namespace App\Providers;

use App\Interfaces\Fees\FeesRepositoryInterface;
use App\Interfaces\Graduated\StudentGraduatedRepositoryInterface;
use App\Interfaces\Promotions\StudentPromotionRepositoryInterface;
use App\Interfaces\Students\StudentRepositoryInterface;
use App\Interfaces\Teacher\TeacherRepositoryInterface;
use App\Repository\Fees\FeesRepository;
use App\Repository\Graduated\StudentGraduatedRepository;
use App\Repository\Promotions\StudentPromotionRepository;
use App\Repository\Students\StudentRepository;
use App\Repository\Teacher\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(StudentPromotionRepositoryInterface::class, StudentPromotionRepository::class);
        $this->app->bind(StudentGraduatedRepositoryInterface::class, StudentGraduatedRepository::class);
        $this->app->bind(FeesRepositoryInterface::class, FeesRepository::class);


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

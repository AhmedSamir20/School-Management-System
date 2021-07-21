<?php

namespace App\Providers;

use App\Interfaces\Attendance\AttendanceRepositoryInterface;
use App\Interfaces\Fees\FeeInvoicesRepositoryInterface;
use App\Interfaces\Fees\FeesRepositoryInterface;
use App\Interfaces\Fees\ProcessingFeeRepositoryInterface;
use App\Interfaces\Graduated\StudentGraduatedRepositoryInterface;
use App\Interfaces\Payment\PaymentRepositoryInterface;
use App\Interfaces\Promotions\StudentPromotionRepositoryInterface;
use App\Interfaces\Receipt\ReceiptStudentsRepositoryInterface;
use App\Interfaces\Students\StudentRepositoryInterface;
use App\Interfaces\Teacher\TeacherRepositoryInterface;
use App\Repository\Attendance\AttendanceRepository;
use App\Repository\Fees\FeeInvoicesRepository;
use App\Repository\Fees\FeesRepository;
use App\Repository\Fees\ProcessingFeeRepository;
use App\Repository\Graduated\StudentGraduatedRepository;
use App\Repository\Payment\PaymentRepository;
use App\Repository\Promotions\StudentPromotionRepository;
use App\Repository\Receipt\ReceiptStudentsRepository;
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
        $this->app->bind(FeeInvoicesRepositoryInterface::class, FeeInvoicesRepository::class);
        $this->app->bind(ReceiptStudentsRepositoryInterface::class, ReceiptStudentsRepository::class);
        $this->app->bind(ProcessingFeeRepositoryInterface::class, ProcessingFeeRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class);


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

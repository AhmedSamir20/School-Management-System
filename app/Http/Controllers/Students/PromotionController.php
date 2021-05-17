<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Interfaces\Promotions\StudentPromotionRepositoryInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    private $Promotions;
    public function __construct(StudentPromotionRepositoryInterface $promotion)
    {

        $this->Promotions=$promotion;
    }

    public function index()
    {
        return $this->Promotions->index();

    }

    public function store(Request $request)
    {
        return $this->Promotions->store($request);
    }
}

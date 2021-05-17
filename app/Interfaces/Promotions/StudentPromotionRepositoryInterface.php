<?php


namespace App\Interfaces\Promotions;


interface StudentPromotionRepositoryInterface
{
    public function index();

    public function store($request);
}

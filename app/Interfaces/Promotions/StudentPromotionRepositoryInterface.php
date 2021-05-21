<?php


namespace App\Interfaces\Promotions;


interface StudentPromotionRepositoryInterface
{
    public function index();

    public function store($request);

    //=============student promotion Management===========
    public function create();

    public function destroy( $request);
}

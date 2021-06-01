<?php


namespace App\Interfaces\Graduated;


interface StudentGraduatedRepositoryInterface
{
    public function index();

    public function create();

    // update Students to SoftDelete
    public function SoftDelete($request);

    // ReturnData Students
    public function ReturnData($request);

    // destroy Students
    public function destroy($request);
}

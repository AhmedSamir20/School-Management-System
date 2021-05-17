<?php

namespace App\Interfaces\Teacher;

interface TeacherRepositoryInterface{

    // get all Teachers
    public function getAllTeachers();
    // Get Specializations
    public function GetSpecializations();
    // Get Genders
    public function GetGenders();
    // Store Teacher
    public function StoreTeacher($request);
    // Store Teacher
    public function EditTeacher($id);
    // Update Teacher
    public function UpdateTeacher($request);
// Update Teacher
    public function DeleteTeacher($request);
}

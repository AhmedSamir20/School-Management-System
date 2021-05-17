<?php

namespace App\Interfaces\Students;

interface StudentRepositoryInterface
{

    // get All Doctors
    public function index();

    // create Doctors
    public function create();

    // store Doctors
    public function store($request);

    public function show($id);

    public function edit($id);
    // Update Doctors
    public function update($request);

    // destroy Doctors
    public function destroy($request);

    public function Get_classrooms($id);

    public function Get_Sections($id);

    //uploaded file with student
    public function Upload_attachment($request);
    //Download file with student
    public function Download_attachment($studentsname,$filename);
    //Delete file with student
    public function Delete_attachment( $request);
}

<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentsRequest;
use App\Interfaces\Students\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $Student;

    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }

    public function index()
    {
        return $this->Student->index();
    }

    public function create()
    {
        return $this->Student->create();
    }

    public function store(StudentsRequest $request)
    {
        return $this->Student->store($request);
    }

    public function show($id)
    {
        return $this->Student->show($id);
    }

    public function edit($id)
    {
        return $this->Student->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Student->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Student->destroy($request);
    }


    public function Get_classrooms($id)
    {
        return $this->Student->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }

    public function Upload_attachment(Request $request)
    {
        return $this->Student->Upload_attachment($request);
    }

    public function Download_attachment($studentsname,$filename)
    {
        return $this->Student->Download_attachment($studentsname,$filename);
    }

    public function Delete_attachment(Request $request)
    {
        return $this->Student->Delete_attachment($request);
    }


}

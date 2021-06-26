<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentsRequest;
use App\Interfaces\Students\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $Students;

    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Students = $Student;
    }

    public function index()
    {
        return $this->Students->index();
    }

    public function create()
    {
        return $this->Students->create();
    }

    public function store(StudentsRequest $request)
    {
        return $this->Students->store($request);
    }

    public function show($id)
    {
        return $this->Students->show($id);
    }

    public function edit($id)
    {
        return $this->Students->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Students->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Students->destroy($request);
    }


    public function Get_classrooms($id)
    {
        return $this->Students->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Students->Get_Sections($id);
    }

    public function Upload_attachment(Request $request)
    {
        return $this->Students->Upload_attachment($request);
    }

    public function Download_attachment($studentsname,$filename)
    {
        return $this->Students->Download_attachment($studentsname,$filename);
    }

    public function Delete_attachment(Request $request)
    {
        return $this->Students->Delete_attachment($request);
    }


}

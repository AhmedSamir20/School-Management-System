<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Interfaces\Teacher\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    protected $Teacher;
    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher=$Teacher;
    }

    public function index()
    {
        return $this->Teacher->getAllTeachers();

    }

    public function create()
    {
        return $this->Teacher->createTeacher();
    }

    public function store(StoreTeachers $request)
    {
        return $this->Teacher->StoreTeacher($request);
    }

    public function edit($id)
    {

      return $this->Teacher->EditTeacher($id);
    }


    public function update(StoreTeachers $request)
    {
       return $this->Teacher->UpdateTeacher($request);
    }

    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeacher($request);
    }
}

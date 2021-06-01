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
        $Teachers = $this->Teacher->getAllTeachers();
        return view('pages.Teachers.Teachers',compact('Teachers'));
    }

    public function create()
    {
        $data=[];
        $data['specializations']=$this->Teacher->GetSpecializations();
        $data['genders']=$this->Teacher->GetGenders();

        return view('pages.Teachers.create',$data);
    }

    public function store(StoreTeachers $request)
    {
        return $this->Teacher->StoreTeacher($request);
    }

    public function edit($id)
    {

        $data=[];
        $data['specializations']=$this->Teacher->GetSpecializations();
        $data['genders']=$this->Teacher->GetGenders();
        $data['Teachers']=$this->Teacher->EditTeacher($id);
        return view('pages.Teachers.Edit',$data);
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

<?php


namespace App\Repository\Graduated;


use App\Interfaces\Graduated\StudentGraduatedRepositoryInterface;
use App\Models\Grade;
use App\Models\Student;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{

    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('Pages.Students.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Grades=Grade::all();
        return view('Pages.Students.Graduated.create',compact('Grades'));
    }

    public function SoftDelete($request)
    {
        $students = student::where('Grade_id',$request->Grade_id)
                    ->where('Classroom_id',$request->Classroom_id)
                    ->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_Graduated', __('Students_trans.Error_no_data'));
        }

        foreach ($students as $student){
            $ids = explode(',',$student->id);
            student::whereIn('id', $ids)->Delete();
        }

        toastr()->success(trans('message.success'));
        return redirect()->route('Graduated.index');    }

    public function ReturnData($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->restore();
        toastr()->success(trans('message.success'));
        return redirect()->back();
    }

    public function destroy($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        toastr()->error(trans('message.delete'));
        return redirect()->back();
    }
}

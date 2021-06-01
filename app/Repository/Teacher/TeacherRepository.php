<?php

namespace App\Repository\Teacher;


use App\Interfaces\Teacher\TeacherRepositoryInterface;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Hash;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function GetSpecializations()
    {

        return Specialization::all();
    }
    public function GetGenders()
    {
        return  Gender::all();
    }

    public function StoreTeacher($request)
    {
        try {
            $Teachers = new Teacher();
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Teachers.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function EditTeacher($id)
    {
    return Teacher::findOrFail($id);
    }

    public function UpdateTeacher($request)
    {
        try {
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('message.update'));
            return redirect()->route('Teachers.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function DeleteTeacher($request)
    {

        Teacher::findOrFail($request->id)->delete();
        toastr()->error(__('message.delete'));
        return redirect()->route('Teachers.index');

    }

}

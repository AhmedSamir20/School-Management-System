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
        $Teachers=Teacher::all();
        return view('pages.Teachers.index',compact('Teachers'));

    }


    public function createTeacher()
    {
        $data=[];
        $data['specializations']=Specialization::all();
        $data['genders']=Gender::all();
        return view('pages.Teachers.create',$data);
    }

    public function StoreTeacher($request)
    {
        try {

            Teacher::create([
                'Name'=> ['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'Email'=> $request->Email,
                'Password'=>  Hash::make($request->Password),
                'Specialization_id'=> $request->Specialization_id,
                'Gender_id'=> $request->Gender_id,
                'Joining_Date'=> $request->Joining_Date,
                'Address'=> $request->Address,
            ]);

            toastr()->success(trans('message.success'));
            return redirect()->route('Teachers.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function EditTeacher($id)
    {

        $data=[];
        $data['Teachers']=Teacher::findOrFail($id);;
        $data['specializations']=Specialization::all();
        $data['genders']=Gender::all();


        return view('pages.Teachers.Edit',$data);

    }



    public function UpdateTeacher($request)
    {
        $Teachers = Teacher::findOrFail($request->id);


        try {
            $Teachers->update([

            'Email' => $request->Email,
            'Password' =>  Hash::make($request->Password),
            'Name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            'Specialization_id' => $request->Specialization_id,
            'Gender_id' => $request->Gender_id,
            'Joining_Date' => $request->Joining_Date,
            'Address' => $request->Address,

            ]);

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

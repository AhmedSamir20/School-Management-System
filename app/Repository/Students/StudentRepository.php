<?php

namespace App\Repository\Students;


use App\Interfaces\Students\StudentRepositoryInterface;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class StudentRepository implements StudentRepositoryInterface

{
    public function index()
    {

        $students = Student::all();
        return view('Pages.Students.index', compact('students'));

    }


    public function create()
    {

        $data['my_classes'] = Grade::all();
        $data['parents'] = My_parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        return view('pages.Students.create', $data);

    }

    public function store($request)
    {


        try {
            DB::beginTransaction();
                $students = Student::create([

                    'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'gender_id' => $request->gender_id,
                    'nationalitie_id' => $request->nationalitie_id,
                    'blood_id' => $request->blood_id,
                    'Date_Birth' => $request->Date_Birth,
                    'Grade_id' => $request->Grade_id,
                    'Classroom_id' => $request->Classroom_id,
                    'section_id' => $request->section_id,
                    'parent_id' => $request->parent_id,
                    'academic_year' => $request->academic_year,

                ]);

                // insert img
                if ($request->hasfile('photos')) {
                    foreach ($request->file('photos') as $file) {
                        $name = $file->getClientOriginalName();
                        $file->storeAs('attachments/students/' . $students->name, $file->getClientOriginalName(), 'upload_attachments');

                        // insert in image_table
                        $images = new Image();
                        $images->filename = $name;
                        $images->imageable_iddssd= $students->id;
                        $images->imageable_type = 'App\Models\Student';
                        $images->save();

                    }
                }

            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('Students.create');


        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function show($id)
    {

        $Student = Student::findorfail($id);
        return view('Pages.Students.show',compact('Student'));

    }

    public function edit($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        $data['Students'] = Student::findOrFail($id);
        return view('pages.Students.edit', $data);
    }

    public function update($request)
    {


        try {
            $Student = Student::findorfail($request->id);
            $Student->update([
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender_id' => $request->gender_id,
                'nationalitie_id' => $request->nationalitie_id,
                'blood_id' => $request->blood_id,
                'Date_Birth' => $request->Date_Birth,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id,
                'academic_year' => $request->academic_year,
            ]);


            toastr()->success(trans('message.update'));
            return redirect()->route('Students.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        Student::destroy($request->id);
        toastr()->success(trans('message.delete'));
        return redirect()->route('Students.index');


    }

    //Get Classrooms
    public function Get_classrooms($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("Name_class", "id");
        return $list_classes;
    }

    //Get Sections
    public function Get_Sections($id)
    {
        $list_sections = Section::where("class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }

    public function Upload_attachment($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/'.$request->student_name, $file->getClientOriginalName(),'upload_attachments');

            // insert in image_table
            $images= new image();
            $images->filename=$name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        toastr()->success(trans('message.success'));
        return redirect()->route('Students.show',$request->student_id);
    }

    public function Download_attachment($studentsname,$filename)
    {
        return response()->download(public_path('attachments/students/'.$studentsname.'/'.$filename));
    }

    public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        Image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('message.delete'));
        return redirect()->route('Students.show',$request->student_id);
    }

}

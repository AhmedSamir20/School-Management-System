<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){
//        Classroom::all()->map->name->dd();

        $data=[];
        $data['Grades']=Grade::with(['Sections'])->get();
        $data['list_Grades']=Grade::all();
        $data['teachers']=Teacher::all();
        return view('Pages.Sections.Sections',$data);
    }

    public function store(StoreSections $request)
    {


        try {

            $Sections = new Section();
            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->grade_id = $request->grade_id;
            $Sections->class_id = $request->class_id;
            $Sections->Status = 1;
            $Sections->save();
            $Sections->teachers()->attach($request->teacher_id);
            toastr()->success(trans('messages.success'));
            return redirect()->route('Sections.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function update(StoreSections $request)
    {

        try {
            $Sections = Section::findOrFail($request->id);

            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->grade_id;
            $Sections->Class_id = $request->class_id;

            if(isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 2;
            }

            // update pivot tABLE
            if (isset($request->teacher_id)) {
                $Sections->teachers()->sync($request->teacher_id);
            } else {
                $Sections->teachers()->sync(array());
            }


            $Sections->save();
            toastr()->success(trans('message.update'));

            return redirect()->route('Sections.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function destroy(request $request)
    {

        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Sections.index');

    }


    public function getclasses($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;
    }
}

<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    public function index()
    {
        $Grades = Grade::all();
        return view('Pages.Grades.index', compact('Grades'));
    }

    public function store(StoreGrades $request)
    {

        try {

            Grade::create([
                'Name'  => ['en' => $request->Name_en, 'ar' => $request->Name],
                'Notes' => $request->Notes,
            ]);

            toastr()->success(__('message.success'));
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
        }

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    public function update(StoreGrades $request)
    {
        try {

            $Grades = Grade::findOrFail($request->id);

            $Grades->update([
                $Grades->Name = ['en' => $request->Name_en, 'ar' => $request->Name],
                $Grades->Notes = $request->Notes,
            ]);

            toastr()->success(__('message.update'));
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        //========================check if you can delete or no ==========================
        $Class_id = Classroom::where('grade_id', $request->id)->pluck('grade_id');
        if ($Class_id->count() == 0) {

            $grade = Grade::findOrFail($request->id);
            $grade->delete();
            toastr()->error(__('message.delete'));
            return redirect()->route('Grades.index');
        } else {
            toastr()->error(__('grades-trans.delete_grade_error'));
            return redirect()->route('Grades.index');
        }
    }

}



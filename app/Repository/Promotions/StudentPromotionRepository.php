<?php


namespace App\Repository\Promotions;

use App\Interfaces\Promotions\StudentPromotionRepositoryInterface;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('Pages.Students.Promotion.index', compact('Grades'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            $students   = Student::where('Grade_id', $request->Grade_id)
                        ->where('Classroom_id', $request->Classroom_id)
                        ->where('section_id', $request->section_id)->get();

            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            // update in table student
            foreach ($students as $student) {

                $ids = explode(',', $student->id);
                Student::whereIn('id', $ids) //[1,2,3]
                ->update([
                    'Grade_id' => $request->Grade_id_new,
                    'Classroom_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new,
                ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id'       => $student->id,
                    'from_grade'       => $request->Grade_id,
                    'from_Classroom'   => $request->Classroom_id,
                    'from_section'     => $request->section_id,
                    'to_grade'         => $request->Grade_id_new,
                    'to_Classroom'     => $request->Classroom_id_new,
                    'to_section'       => $request->section_id_new,
                ]);

            }
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->back();

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }
}

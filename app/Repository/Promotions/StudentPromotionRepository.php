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
        $promotions = Promotion::all();
        return view('Pages.Students.Promotion.index', compact('promotions'));


    }

    public function create()
    {

        $Grades = Grade::all();
        return view('Pages.Students.Promotion.create', compact('Grades'));
    }



    public function store($request)
    {
        DB::beginTransaction();

        try {

            $students   = Student::where('Grade_id', $request->Grade_id)
                          ->where('Classroom_id', $request->Classroom_id)
                          ->where('section_id', $request->section_id)
                          ->where('academic_year', $request->academic_year)->get();


            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', __('Students_trans.Error_no_data'));
            }

            // update in table student
            foreach ($students as $student) {

                $ids = explode(',', $student->id); //[1,2,3]


                Student::whereIn('id', $ids)->update([
                    'Grade_id'           => $request->Grade_id_new,
                    'Classroom_id'       => $request->Classroom_id_new,
                    'section_id'         => $request->section_id_new,
                    'academic_year'      => $request->academic_year_new,
                ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id'         => $student->id,
                    'from_grade'         => $request->Grade_id,
                    'from_Classroom'     => $request->Classroom_id,
                    'from_section'       => $request->section_id,
                    'from_academic_year' => $request->academic_year,
                    'to_grade'           => $request->Grade_id_new,
                    'to_Classroom'       => $request->Classroom_id_new,
                    'to_section'         => $request->section_id_new,
                    'to_academic_year'   => $request->academic_year_new,
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


    //=============student promotion Management===========


    public function destroy($request)
    {
        DB::beginTransaction();

        try {
            // return From Promotion
            if ($request->page_id == 1) {

                $Promotions = Promotion::all();
                foreach ($Promotions as $Promotion) {

                    // Update From Table Student
                    $ids = explode(',', $Promotion->student_id);
                    student::whereIn('id', $ids)->update([

                        'Grade_id'       => $Promotion->from_grade,
                        'Classroom_id'   => $Promotion->from_Classroom,
                        'section_id'     => $Promotion->from_section,
                        'academic_year'  => $Promotion->from_academic_year,
                    ]);

                        // Delete Table Promotion
                        Promotion::truncate();

                }
                DB::commit();
                toastr()->error(trans('message.delete'));
                return redirect()->back();


            } else {
                $Promotion = Promotion::findorfail($request->id);
                student::where('id', $Promotion->student_id)
                    ->update([
                        'Grade_id'       => $Promotion->from_grade,
                        'Classroom_id'   => $Promotion->from_Classroom,
                        'section_id'     => $Promotion->from_section,
                        'academic_year'  => $Promotion->from_academic_year,
                    ]);


                Promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('message.delete'));
                return redirect()->back();
            }

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}

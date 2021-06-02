<?php


namespace App\Repository\Fees;
use App\Interfaces\Fees\FeesRepositoryInterface;
use App\Models\Fee;
use App\Models\Grade;
use Exception;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {
        $fees = Fee::all();

        return view('Pages.Fees.index', compact('fees'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('Pages.Fees.create', compact('Grades'));
    }

    public function store($request)
    {

        try {
            Fee::create([
                'title'         => ['en' => $request->title_en, 'ar' => $request->title_ar],
                'amount'        => $request->amount,
                'Grade_id'      => $request->Grade_id,
                'Classroom_id'  => $request->Classroom_id,
                'description'   => $request->description,
                'year'          => $request->year

            ]);

            toastr()->success(trans('message.success'));
            return redirect()->route('Fees.create');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {

        $Grades = Grade::all();
        $fee = Fee::findOrFail($id);
        return view('Pages.Fees.edit', compact('Grades', 'fee'));

    }


    public function update($request)
    {
        $fee = Fee::findOrFail($request->id);

        try {


            $fee->update([

                'title'         => ['en' => $request->title_en, 'ar' => $request->title_ar],
                'amount'        => $request->amount,
                'Grade_id'      => $request->Grade_id,
                'Classroom_id'  => $request->Classroom_id,
                'description'   => $request->description,
                'year'          => $request->year

            ]);

            toastr()->success(trans('message.update'));
            return redirect()->route('Fees.edit', $fee->id);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        try {
            Fee::destroy($request->id);
            toastr()->error(trans('message.delete'));
            return redirect()->route('Fees.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}

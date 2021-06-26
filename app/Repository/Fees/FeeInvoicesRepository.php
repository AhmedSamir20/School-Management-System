<?php


namespace App\Repository\Fees;


use App\Interfaces\Fees\FeeInvoicesRepositoryInterface;
use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\studentAccount;
use Illuminate\Support\Facades\DB;

class FeeInvoicesRepository implements FeeInvoicesRepositoryInterface
{

    public function index()
    {
        $data=[];
        $data['Fee_invoices'] = Fee_invoice::all();
        $data['Grades'] = Grade::all();
        return view('Pages.Fees_Invoices.index',$data);
    }
//
    public function show($id)
    {
        $data = [];
        $data['student']  = Student::findOrFail($id);
        $data['fees']     = Fee::where('Classroom_id', $data['student']->Classroom_id)->get();
        return view('Pages.Fees_invoices.create', $data);
    }


    public function store($request)
    {
        $List_Fees = $request->List_Fees;
        DB::beginTransaction();
        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees=  Fee_invoice::create([
                    'invoice_date'  => date('Y-m-d'),
                    'student_id'    => $List_Fee['student_id'],
                    'Grade_id'      => $request->Grade_id,
                    'Classroom_id'  => $request->Classroom_id,
                    'fee_id'        => $List_Fee['fee_id'],
                    'amount'        => $List_Fee['amount'],
                    'description'   => $List_Fee['description'],

                ]);
                // حفظ البيانات في جدول حسابات الطلاب
                StudentAccount::create([

                    'date'           => date('Y-m-d'),
                    'type'           => 'invoice',
                    'fee_invoice_id' => $Fees->id,
                    'student_id'     => $List_Fee['student_id'],
                    'Debit'          => $List_Fee['amount'],
                    'credit'         => 0.00,
                    'description'    => $List_Fee['description'],

                ]);

            }

            DB::commit();

            toastr()->success(trans('message.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $fee_invoices = Fee_invoice::findorfail($id);
        $fees = Fee::where('Classroom_id',$fee_invoices->Classroom_id)->get();
        return view('pages.Fees_Invoices.edit',compact('fee_invoices','fees'));
    }


    public function update($request)
    {
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = Fee_invoice::findorfail($request->id);
            $Fees->update([
            'fee_id' => $request->fee_id,
            'amount' => $request->amount,
            'description' => $request->description,
            ]);


            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::where('fee_invoice_id',$request->id)->first();
            $StudentAccount->update([
                'Debit' => $request->amount,
                'description' => $request->description,
            ]);
            DB::commit();

            toastr()->success(trans('message.Update'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            Fee_invoice::destroy($request->id);
            toastr()->error(trans('message.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}

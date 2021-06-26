<?php


namespace App\Http\Controllers\Classrooms;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalssroom;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;


class ClassroomController extends Controller
{


  public function index()
  {
        $data=[];
        $data['My_Classes'] =Classroom::all();
        $data['Grades']     =Grade::all();
        return view('Pages.My_Classes.index',$data);
  }

  public function store(StoreCalssroom $request)
  {
      $List_Classes=$request->List_Classes;
      try {
            foreach ($List_Classes as $List_Classes){
                $My_Classes= New Classroom();
                $My_Classes->Name_class	 = ['en' => $List_Classes['Name_class_en'], 'ar' => $List_Classes['Name']];
                $My_Classes->grade_id= $List_Classes['Grade_id'];
                $My_Classes->save();

            }
          toastr()->success(__('message.success'));
          return redirect()->route('Classrooms.index');
      }
      catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
      }
  }





  public function update(Request $request)
  {
      try {

          $Classrooms = Classroom::findOrFail($request->id);

          $Classrooms->update([

              $Classrooms->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_class_en],
              $Classrooms->grade_id = $request->Grade_id,
          ]);
          toastr()->success(trans('message.update'));
          return redirect()->route('Classrooms.index');
      }

      catch
      (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

  }

  public function destroy(Request $request)
  {

      $Classroom=Classroom::findOrFail($request->id);
      $Classroom->delete();
      toastr()->error(__('message.delete'));
      return redirect()->route('Classrooms.index');

  }


    public function delete_all(Request $request){
      $delete_all_id = explode(",", $request->delete_all_id);
        Classroom::whereIn('id', $delete_all_id)->Delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }


    public function Filter_Classes(Request $request)
    {

        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('grade_id',$request->grade_id)->get();
        return view('Pages.My_Classes.index',compact('Grades'))->withDetails($Search);
    }

}

?>

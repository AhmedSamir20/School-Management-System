<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Interfaces\Attendance\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    private $Attendances;
    public function __construct(AttendanceRepositoryInterface $Attendance)
    {
        return $this->Attendances=$Attendance;
    }


    public function index()
    {
        return $this->Attendances->index();
    }

    public function show($id)
    {
        return $this->Attendances->show($id);
    }


    public function store(Request $request)
    {
        return $this->Attendances->store($request);
    }
    public function update(Request $request)
    {
        return $this->Attendances->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->Attendances->destroy($request);
    }

}

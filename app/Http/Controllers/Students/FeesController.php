<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeesRequest;
use App\Interfaces\Fees\FeesRepositoryInterface;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    private $Fees;
    public function __construct(FeesRepositoryInterface $fees)
    {

        $this->Fees=$fees;
    }

    public function index(){

        return $this->Fees->index();
    }

    public function create()
    {
        return $this->Fees->create();
    }

    public function store(FeesRequest $request)
    {
        return $this->Fees->store($request);
    }

    public function edit($id)
    {
        return $this->Fees->edit($id);
    }

    public function update(FeesRequest $request)
    {
        return $this->Fees->update($request);
    }

    public function destroy(Request $request){
        return $this->Fees->destroy($request);

    }
}

<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Interfaces\Fees\ProcessingFeeRepositoryInterface;
use Illuminate\Http\Request;

class ProcessingFeeController extends Controller
{
    protected $ProcessingFees;
    public function __construct(ProcessingFeeRepositoryInterface $ProcessingFee)
    {

        $this->ProcessingFees=$ProcessingFee;
    }

    public function index()
    {
        return $this->ProcessingFees->index();
    }

    public function show($id)
    {
        return $this->ProcessingFees->show($id);
    }

    public function store(Request $request)
    {
        return $this->ProcessingFees->store($request);
    }

    public function edit($id)
    {
        return $this->ProcessingFees->edit($id);
    }

    public function update(Request $request){
        return $this->ProcessingFees->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->ProcessingFees->destroy($request);
    }
}

<?php

namespace App\Http\Controllers\Receipts;

use App\Http\Controllers\Controller;
use App\Interfaces\Receipt\ReceiptStudentsRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptStudentsController extends Controller
{

    private $Receipts;
    public function __construct(ReceiptStudentsRepositoryInterface $Receipt)
    {
        $this->Receipts=$Receipt;
    }


    public function index()
    {
        return $this->Receipts->index();
    }

    public function show($id)
    {
        return $this->Receipts->show($id);
    }


    public function store(Request $request)
    {
        return $this->Receipts->store($request);
    }

    public function edit($id)
    {
        return $this->Receipts->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Receipts->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Receipts->destroy($request);
    }
}

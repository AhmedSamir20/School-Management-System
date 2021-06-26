<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Interfaces\Fees\FeeInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class FeeInvoicesController extends Controller
{

    protected $Fee_Invoices;

    public function __construct(FeeInvoicesRepositoryInterface $FeeInvoice)
    {
        $this->Fee_Invoices = $FeeInvoice;

    }

    public function index()
    {
        return $this->Fee_Invoices->index();
    }
    public function show($id)
    {
        return $this->Fee_Invoices->show($id);
    }

    public function store(Request $request)
    {
        return $this->Fee_Invoices->store($request);
    }

    public function edit($id)
    {
        return $this->Fee_Invoices->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Fee_Invoices->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->Fee_Invoices->destroy($request);
    }
}

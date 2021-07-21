<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Interfaces\Payment\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $Payments;
    public function __construct(PaymentRepositoryInterface $Payment)
    {

        return $this->Payments=$Payment;
    }

    public function index()
    {
        return $this->Payments->index();
    }

    public function show($id)
    {
        return $this->Payments->show($id);
    }

    public function edit($id)
    {
        return $this->Payments->edit($id);
    }
    public function store(Request $request)
    {
        return $this->Payments->store($request);
    }
    public function update(Request $request)
    {
        return $this->Payments->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->Payments->destroy($request);
    }
}

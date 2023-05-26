<?php

namespace App\Http\Controllers;

use App\Http\AsaasService\Repository\AsaasRepository;
use App\Http\Requests\BoletoPaymentRequest;
use App\Http\Requests\CardPaymentRequest;
use App\Http\Requests\PixPaymentRequest;
use App\Http\Resources\BoletoPaymentResource;
use App\Http\Resources\PixPaymentResource;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $asaasRepository;

    public function __construct(AsaasRepository $asaasRepository)
    {
        $this->asaasRepository = $asaasRepository;
    }

    public function index(Request $request)
    {
        $paymentData = $request->only('identificationField', 'dueDate', 'value', 'payId');
        return view('payment', compact('paymentData'));
    }

    public function confirmation(Request $request)
    {
        $linkTransaction = $request->only('linkTransaction');
        return view('confirmation', compact('linkTransaction'));
    }
    
    public function simulatePayment(Request $request)
    {
        return $this->asaasRepository->simulatePayment($request);
    }

    public function boletoPayment(BoletoPaymentRequest $request)
    {
        return new BoletoPaymentResource(
            $this->asaasRepository->boletoPayment($request)
        );
    }

    public function getQrCode(Request $request)
    {
        return new PixPaymentResource($this->asaasRepository->getQrCode($request));
    }

    public function pixPayment(PixPaymentRequest $request)
    {
        return new PixPaymentResource($this->asaasRepository->pixPayment($request));
    }

    public function cardPayment(CardPaymentRequest $request)
    {
        return new BoletoPaymentResource(
            $this->asaasRepository->cardPayment($request)
        );
    }
}

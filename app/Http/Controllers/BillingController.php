<?php

namespace App\Http\Controllers;

use App\Http\AsaasService\Repository\AsaasRepository;
use App\Http\Resources\BillingResource;
use Illuminate\Http\Request;

class BillingController extends Controller
{

    protected $asaasRepository;

    public function __construct(AsaasRepository $asaasRepository)
    {
        $this->asaasRepository = $asaasRepository;
    }

    public function createBilling(Request $request)
    {
        return new BillingResource($this->asaasRepository->createBilling($request));
    }
}

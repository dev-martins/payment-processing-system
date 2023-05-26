<?php

namespace App\Http\AsaasService\Repository;

use App\Http\AsaasService\Adapter\AsaasApiAdapter;

class AsaasRepository
{
    protected $apiAdapter;

    public function __construct(AsaasApiAdapter $apiAdapter)
    {
        $this->apiAdapter = $apiAdapter;
    }

    public function createBilling($request)
    {
        $endpoint = '/api/v3/payments';
        $data = [
            'billingType' => 'UNDEFINED',
            'customer' => env('CUSTOMER_ID'),
            'value' => $request->value,
            'dueDate' => $request->dueDate,
            'description' => $request->description,
        ];

        $response = $this->apiAdapter->post($endpoint, $data);

        if (isset($response['id'])) {
            unset($data);
            $data['id'] = $response['id'];
            $endpoint = '/api/v3/payments/' . $response['id'] . '/identificationField';
            $response = $this->apiAdapter->get($endpoint);
            $data['identificationField'] = $response['identificationField'];
            return $data;
        }

        return $response;
    }

    public function simulatePayment($request)
    {
        $endpoint = '/api/v3/bill/simulate';
        $data = [
            'identificationField' => $request->identificationField,
            'barCode' => preg_replace('/[\s.]+/', '', $request->identificationField),
        ];

        return $this->apiAdapter->post($endpoint, $data);
    }

    public function boletoPayment($request)
    {
        $endpoint = '/api/v3/bill';
        $data = [
            'identificationField' => $request->identificationField,
            'scheduleDate' => $request->scheduleDate,
            'description' => $request->description,
            'discount' => $request->discount,
            'dueDate' => $request->dueDate,
            'value' => $request->value,
        ];

        return $this->apiAdapter->post($endpoint, $data);
    }

    public function getQrCode($request)
    {
        $endpoint = '/api/v3/payments/' . $request->payId . '/pixQrCode';
        return $this->apiAdapter->get($endpoint);
    }

    public function pixPayment($request)
    {
        $endpoint = '/api/v3/pix/qrCodes/pay';
        $data = [
            'qrCode'    => [
                'payload'   => $request->qrCode['payload']
            ],
            'scheduleDate' => $request->scheduleDate,
            'description' => $request->description,
            'value' => $request->value,
        ];

        return $this->apiAdapter->post($endpoint, $data);
    }

    public function cardPayment($request)
    {
        $endpoint = '/api/v3/payments';
        $data = [
            'customer' => env('CUSTOMER_ID'),
            'billingType' => $request->billingType,
            'creditCard'    => [
                "holderName" => $request->creditCard['holderName'],
                "number" => $request->creditCard['number'],
                "expiryMonth" => $request->creditCard['expiryMonth'],
                "expiryYear" => $request->creditCard['expiryYear'],
                "ccv" => $request->creditCard['ccv']
            ],
            'creditCardHolderInfo'    => [
                "name" => $request->creditCardHolderInfo['name'],
                "email" => $request->creditCardHolderInfo['email'],
                "cpfCnpj" => $request->creditCardHolderInfo['cpfCnpj'],
                "postalCode" => $request->creditCardHolderInfo['postalCode'],
                "addressNumber" => $request->creditCardHolderInfo['addressNumber'],
                "addressComplement" => $request->creditCardHolderInfo['addressComplement'],
                "mobilePhone" => $request->creditCardHolderInfo['mobilePhone'],
            ],
            'value' => $request->value,
            'dueDate' => $request->dueDate,
        ];

        return $this->apiAdapter->post($endpoint, $data);
    }
}

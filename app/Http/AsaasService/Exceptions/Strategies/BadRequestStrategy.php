<?php

namespace App\Http\AsaasService\Exceptions\Strategies;

use App\Http\AsaasService\Exceptions\Contract\ErrorStrategyInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class BadRequestStrategy implements ErrorStrategyInterface
{
    public function handle($response)
    {
        throw new HttpResponseException(
            response()->json(
                json_decode($response->body()),
                $response->status()
            )
        );
    }
}

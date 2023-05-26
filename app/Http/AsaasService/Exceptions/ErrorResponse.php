<?php

namespace App\Http\AsaasService\Exceptions;

use App\Http\AsaasService\Exceptions\Strategies\BadRequestStrategy;
use Illuminate\Http\Exceptions\HttpResponseException;

class ErrorResponse
{
    private $strategies = [];
    protected $response;

    public function __construct($response)
    {
        $this->response = $response;
        $this->strategies = [
            400 => new BadRequestStrategy(),
        ];
    }

    public function generate()
    {
        $this->response->onError(function () {
            foreach ($this->strategies as $exceptionType => $strategy) {
                if ($this->response->status() == $exceptionType) {
                    return $strategy->handle($this->response);
                }
            }

            throw new HttpResponseException(
                response()->json(['message' => 'Erro de servidor'], 500)
            );
        });
    }
}

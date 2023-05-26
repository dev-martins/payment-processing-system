<?php

namespace App\Http\AsaasService\Exceptions\Contract;

interface ErrorStrategyInterface
{
    public function handle($exception);
}

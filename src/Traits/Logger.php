<?php

declare(strict_types=1);

namespace App\Traits;

trait Logger
{
    private function registrarLog(string $mensagem): void
    {
        error_log(sprintf('[Transportadora] %s %s', (new \DateTimeImmutable())->format('c'), $mensagem));
    }
}

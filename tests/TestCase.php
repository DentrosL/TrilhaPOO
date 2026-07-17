<?php

declare(strict_types=1);

namespace Tests;

use Throwable;

final class TestCase
{
    private int $assertions = 0;

    public function assertTrue(bool $condition, string $message): void
    {
        $this->assertions++;

        if (!$condition) {
            throw new \RuntimeException($message);
        }
    }

    public function assertSame(mixed $expected, mixed $actual, string $message): void
    {
        $this->assertions++;

        if ($expected !== $actual) {
            throw new \RuntimeException(sprintf('%s. Esperado: %s. Atual: %s.', $message, var_export($expected, true), var_export($actual, true)));
        }
    }

    public function assertThrows(string $exceptionClass, callable $callback, string $message): void
    {
        $this->assertions++;

        try {
            $callback();
        } catch (Throwable $exception) {
            if ($exception instanceof $exceptionClass) {
                return;
            }

            throw new \RuntimeException(sprintf('%s. Exceção recebida: %s.', $message, $exception::class), 0, $exception);
        }

        throw new \RuntimeException($message);
    }

    public function total(): int
    {
        return $this->assertions;
    }
}

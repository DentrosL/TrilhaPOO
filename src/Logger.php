<?php

trait Logger
{
    public function registrarLog(): void
    {
        echo "Log registrado.";
    }

    public function registrarErro(): void
    {
        echo "Erro registrado.";
    }
}
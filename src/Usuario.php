<?php

class Usuario implements Autenticavel
{
    public function autenticar(string $senha): bool
    {
        return $senha === "123456";
    }
}
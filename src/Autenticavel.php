<?php

interface Autenticavel
{
    public function autenticar(string $senha): bool;
}
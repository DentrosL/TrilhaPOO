<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Connection;
use PDO;

abstract class BaseRepository
{
    protected PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }
}

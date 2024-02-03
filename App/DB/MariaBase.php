<?php

namespace App\DB;

use PDO;

class MariaBase
{
    private $pdo, $table;

    public function __construct($table)
    {
        $host = 'localhost';
        $db   = 'school';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $options);
        $this->table = $table;
    }

    public function create(object $data): int
    {
        $sql = "
            INSERT INTO {$this->table} (role , name, lastname, email, password, deleted)
            VALUES(?, ?, ?, ?, ?, ?)
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user', $data->name, $data->lastname, $data->email,
            sha1($data->password), 0
        ]);

        return $this->pdo->lastInsertId();
    }

    public function update(int $id, object $data): bool
    {
        $sql = "
            UPDATE {$this->table}
            SET name = ?, lastname = ?, email = ?
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data->name,
            $data->lastname,
            $data->email,
            $id
        ]);
    }
    public function updatePassword(int $id, object $data): bool
    {
        $sql = "
            UPDATE {$this->table}
            SET password = ?
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            sha1($data->newpassword),
            $id
        ]);
    }

    public function deleteAccount(int $id): bool
    {
        $sql = "
            UPDATE {$this->table}
            SET deleted = ?
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            1,
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "
            DELETE FROM {$this->table}
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function show(int $id): object
    {
        $sql = "
        SELECT *
        FROM {$this->table}
        WHERE id = ?
    ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function showAll(): array
    {
        $sql = "
        SELECT *
        FROM {$this->table}
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }
}

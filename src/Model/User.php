<?php

namespace PashkevichSD\MvcExample\Model;

use PashkevichSD\MvcExample\Component\Database;
use PDO;

/**
 * Feel free to remove this model, it is just an example
 */
class User
{
    private int $id;
    private string $name;
    private string $surname;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getSurname(): string 
    {
        return $this->surname;
    }

    public static function getAll(bool $isObjectFormat = true): array
    {
        $db = Database::getConnection();

        $stmt = $db->query('SELECT * FROM users');

        if ($isObjectFormat) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);

            return $stmt->fetchAll();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("INSERT INTO users (name, surname, password) VALUES (?,?,?)");

        $stmt->execute([$data['name'], $data['surname'], hash('sha256', $data['password'])]);
    }

    public static function findById(int $id, bool $isObjectFormat = true)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare('SELECT * FROM users WHERE id=?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($isObjectFormat) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);

            $user = $stmt->fetch();
        } else {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $user;
    }

    public static function delete(int $id)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("DELETE FROM users WHERE id=?");

        $stmt->execute([$id]);
    }
}

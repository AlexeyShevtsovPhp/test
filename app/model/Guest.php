<?php

namespace app\model;

use PDO;
class Guest
{
    private PDO $db;

    function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=test", 'root', 'root', [
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    public function insertNewGuest(string $guest): int
    {
        $newGuest = $this->db->prepare("INSERT INTO guests (name) VALUES (:guest)");
        $this->db->exec("ALTER TABLE guests AUTO_INCREMENT = 1");
        $newGuest->execute(
            [
                'guest' => $guest,
            ]
        );

        return $this->db->lastInsertId();
    }
}

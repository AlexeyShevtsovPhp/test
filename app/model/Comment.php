<?php

namespace app\model;

use PDO;

/**
 * @property int $id
 * @property string $guest_id
 * @property string $content
 * @property string $created_at
 */
class Comment
{
    private const int PER_PAGE = 2;
    private PDO $db;

    function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=test", 'root', 'root', [
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    /**
     * @param int $page
     * @return array
     */
    function get(int $page): array
    {
        $result = $this->db->prepare("SELECT g.name AS user_name, c.content
                                      FROM comments c
                                      JOIN guests g ON c.guest_id = g.id
                                      LIMIT :limit OFFSET :offset");
        $result->execute(
            [
                'limit' => self::PER_PAGE,
                'offset' => $page * self::PER_PAGE,
            ]
        );

        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param int $guest_id
     * @param string $comment
     * @return bool
     */
    public function insert(int $guest_id, string $comment): bool
    {
        $put = $this->db->prepare("INSERT INTO comments (guest_id, content) VALUES (:guest_id, :comment)");
        $this->db->exec("ALTER TABLE guests AUTO_INCREMENT = 1");

        return $put->execute(
            [
                'guest_id' => $guest_id,
                'comment' => $comment,
            ]
        );
    }

    /**
     * @param string $guest
     * @return int
     */
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

    /**
     * @return int
     */
    function getTotalPages(): int
    {
        $nowPages = $this->db->prepare("SELECT COUNT(*) as total FROM comments");
        $nowPages->execute();
        $total = $nowPages->fetchColumn();

        return ceil($total / self::PER_PAGE);
    }
}

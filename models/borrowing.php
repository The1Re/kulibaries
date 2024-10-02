<?php

require_once('utils/database.php');

class Borrowing
{
    public $id, $userId, $staffId, $borrowingDate;

    public function __construct(
        int $id,
        int $userId,
        int $staffId,
        DateTime $borrowingDate,
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->staffId = $staffId;
        $this->borrowingDate = $borrowingDate;
    }

    /**
     * Get All methods
     * get all borrowing on database
     * 
     * @return Borrowing[] array of borrowing
     */
    public static function getAll(): array
    {
        $data = [];
        $sql = "SELECT * FROM borrowings";
        $result = Database::query($sql);
        while ($row = $result->fetch_assoc())
        {
            $data[] = new Borrowing(
                $row['borrowingId'],
                $row['userId'],
                $row['staffId'],
                new DateTime($row['borrowingDate'])
            );
        }
        return $data;
    }

    /**
     * Add borrowing methods
     * add borrowing to database
     * 
     * @param Borrowing $borrowing
     * @return bool if add success return true else false
     */
    public static function add(Borrowing $b): bool
    {
        $sql = "INSERT INTO borrrowing VALUES (?, ?, ?, ?)";
        $params = [$b->id, $b->userId, $b->staffId, $b->borrowingDate];
        $result = Database::query($sql, $params);
        return $result > 0;
    }

    /**
     * Delete borrowing methods
     * delete borrowing on database by id
     * 
     * @param int $id
     * @return bool if delete succss return true else false
     */
    public static function delete(int $id): bool
    {
        $sql = "DELETE FROM borrowings WHERE borrowingId = ?";
        $params = [$id];
        $result = Database::query($sql, $params);
        return $result > 0;
    }

    /**
     * Update borrowing methods
     * update borrowing on database by id
     * 
     * @param int $id
     * @param Borrowing $borrowing
     * @return bool if update success return true else false
     */
    public static function update(int $id, Borrowing $b): bool
    {
        $sql = "
            UPDATE borrowings 
            SET 
            WHERE borrowingId = ?
        ";
        $params = [];
        $result = Database::query($sql, $params);
        return $result > 0;
    }
}
<?php

require_once('utils/database.php');

class Borrowing
{
    public $id, $user, $staff, $borrowingDate;

    public function __construct(
        int $id,
        User $user,
        User $staff,
        DateTime $borrowingDate,
    ) {
        $this->id = $id;
        $this->user = $user;
        $this->staff = $staff;
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
            require_once('models/user.php');
            $data[] = new Borrowing(
                $row['borrowingId'],
                User::getById($row['userId']),
                User::getById($row['staffId']),
                new DateTime($row['borrowingDate'])
            );
        }
        return $data;
    }

    /**
     * Get borrowing by id methods
     * 
     * @param int $id
     * @return Borrowing 
     */
    public static function getById(int $id): Borrowing
    {
        $sql = "SELECT * FROM borrowings WHERE borrowingId = ?";
        $params = [$id];
        $result = Database::query($sql, $params);
        $row = $result->fetch_assoc();
        return new Borrowing(
            $row['borrowingId'],
            User::getById($row['userId']),
            User::getById($row['staffId']),
            new DateTime($row['borrowingDate'])
        );
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
        $params = [$b->id, $b->user->id, $b->staff->id, $b->borrowingDate];
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
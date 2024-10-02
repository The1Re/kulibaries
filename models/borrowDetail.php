<?php

require_once('utils/database.php');

class BorrowDetail
{
    public $id, $borrowing, $bookAvailableId, $status, $returnDate;

    public function __construct(
        int $id,
        Borrowing $borrowing,
        int $bookAvailableId, // change type!
        string $status,
        DateTime $returnDate
    ) {
        $this->id = $id;
        $this->borrowing = $borrowing;
        $this->bookAvailableId = $bookAvailableId;
        $this->status = $status;
        $this->returnDate = $returnDate;
    }

    public static function getAll()
    {
        $data = [];
        $sql = "SELECT * FROM borrowDetails";
        $result = Database::query($sql);
        while ($row = $result->fetch_assoc())
        {
            $data[] = new BorrowDetail(
                $row['borrowDetailId'],
                Borrowing::getById($row['borrowingId']),
                $row['bookAvailableId'],
                $row['status'],
                new DateTime($row['returnDate'])
            );
        }
        return $data;
    }
}
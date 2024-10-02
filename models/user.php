<?php

require_once('utils/database.php');


class User
{
    public $id, $firstname, $lastname, $username, $password, $registDate, $email, $phone, $role;

    public function __construct(
        int $id,
        string $firstname,
        string $lastname,
        string $username,
        string $password,
        DateTime $registDate,
        string $email,
        string $phone,
        string $role
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password = $password;
        $this->registDate = $registDate;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
    }

    /**
     * Get All methods
     * get all user on database
     * 
     * @return User[] array of user
     */
    public static function getAll(): array
    {
        $data = [];
        $sql = "SELECT * FROM user";
        $result = Database::query($sql);
        while ($row = $result->fetch_assoc())
        {
            $data[] = new User(
                $row['userId'],
                $row['firstname'], 
                $row['lastname'], 
                $row['username'], 
                $row['password'], 
                new DateTime($row['registDate']),
                $row['email'], 
                $row['phone'],
                $row['role']
            );
        }
        return $data;
    }

}
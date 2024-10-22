<?php

class User
{
    private $email;
    private $password;
    private $name;

    public function __construct($email = null, $password = null,$name=null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
       return $this->name ;
    }

    public function getUser($conn)
    {
        // SQL query to get user details
        $query = "SELECT * FROM users WHERE email='$this->email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $user = new User();
            $user->setEmail($row['email']);
            $user->setName($row['name']);
            return $user;
        }

        return null;
    }

    public function setSession($conn)
    {
        session_start();
        // Assuming getUser() returns a User object
        $user = $this->getUser($conn);
        if ($user) {
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['username'] = $user->getName();
        }
    }
}

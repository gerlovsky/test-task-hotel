<?php

namespace Hotel\Model;

class User
{
    protected $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function __toString()
    {
        return (string) $this->username;
    }
}
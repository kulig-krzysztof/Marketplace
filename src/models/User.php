<?php

class User
{
    private $email;
    private $password;
    private $name;
    private $surname;
    private $account_type;

    public function __construct(string $email,string $password,string $name,string $surname, int $account_type)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->account_type = $account_type;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getAccountType(): int
    {
        return $this->account_type;
    }

    public function setAccountType(int $account_type): void
    {
        $this->account_type = $account_type;
    }
}
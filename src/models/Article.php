<?php

class Article
{
    private $id;
    private $title;
    private $category;
    private $desc;
    private $phone;
    private $price;
    private $email;
    private $location;
    private $img;

    public function __construct($id, $title, $category, $desc, $phone, $price, $email, $location, $img)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->desc = $desc;
        $this->phone = $phone;
        $this->price = $price;
        $this->email = $email;
        $this->location = $location;
        $this->img = $img;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function setDesc(string $desc): void
    {
        $this->desc = $desc;
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): void
    {
        $this->phone = $phone;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location): void
    {
        $this->location = $location;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;
    }


}
<?php

class Article
{
    private $id;
    private $title;
    private $category;
    private $desc;
    private $price;
    private $email;
    private $location;
    private $img;

    public function __construct($id, $title, $category, $desc, $price, $email, $location, $img)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->desc = $desc;
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

    public function getDescription(): string
    {
        return $this->desc;
    }

    public function setDescription(string $desc): void
    {
        $this->desc = $desc;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->desc = $email;
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
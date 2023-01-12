<?php

class Article
{
    private $id;
    private $title;
    private $category;
    private $desc;
    private $price;
    private $email;
    private $img;
    private $lng;
    private $lat;
    private $city_name;
    private $size;

    public function __construct($id, $title, $category, $desc, $price, $email, $img, $lng, $lat, $city_name, $size)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->desc = $desc;
        $this->price = $price;
        $this->email = $email;
        $this->img = $img;
        $this->lng = $lng;
        $this->lat = $lat;
        $this->city_name = $city_name;
        $this->size = $size;
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

    public function getLng() : float
    {
        return $this->lng;
    }

    public function setLng($lng): void
    {
        $this->lng = $lng;
    }

    public function getLat() : float
    {
        return $this->lat;
    }

    public function setLat($lat): void
    {
        $this->lat = $lat;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    public function getLocation() : string
    {
        return $this->city_name;
    }

    public function setLocation(string $city_name): void
    {
        $this->city_name = $city_name;
    }

    public function getSize() : float
    {
        return $this->size;
    }

    public function setSize(float $size): void
    {
        $this->size = $size;
    }
}
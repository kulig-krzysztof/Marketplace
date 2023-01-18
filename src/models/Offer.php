<?php

class Offer
{
    private $id;
    private $offer_from_id;
    private $city_name;
    private $price;
    private $item_id;
    private $lng;
    private $lat;
    private $email;
    private $data;

    public function __construct($id, $offer_from_id, $city_name, $price, $item_id, $lng, $lat, $email, $data)
    {
        $this->id = $id;
        $this->offer_from_id = $offer_from_id;
        $this->city_name = $city_name;
        $this->price = $price;
        $this->item_id = $item_id;
        $this->lng = $lng;
        $this->lat = $lat;
        $this->email = $email;
        $this->data = $data;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getOfferFromId() : int
    {
        return $this->offer_from_id;
    }

    public function setOfferFromId(string $offer_from_id): void
    {
        $this->offer_from_id = $offer_from_id;
    }

    public function getCityName(): string
    {
        return $this->city_name;
    }

    public function setCityName(string $city_name): void
    {
        $this->city_name = $city_name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getItemId() : int
    {
        return $this->item_id;
    }

    public function setItemId(int $item_id): void
    {
        $this->item_id = $item_id;
    }

    public function getLng() : float {
        return $this->lng;
    }

    public function setLng(float $lng) : void {
        $this->lng = $lng;
    }

    public function getLat() : float {
        return $this->lat;
    }

    public function setLat(float $lat) : void {
        $this->lat = $lat;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function setEmail(string $email) : void {
        $this->email = $email;
    }

    public function getData() : string {
        return $this->data;
    }

    public function setData(string $data) : void {
        $this->data = $data;
    }
}
<?php

class Offer
{
    private $id;
    private $offer_from_email;
    private $location;
    private $price;
    private $item_id;

    public function __construct($id, $offer_from_email, $location, $price, $item_id)
    {
        $this->id = $id;
        $this->offer_from_email = $offer_from_email;
        $this->location = $location;
        $this->price = $price;
        $this->item_id = $item_id;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getOfferFromEmail() : string
    {
        return $this->offer_from_email;
    }

    public function setOfferFromEmail(string $offer_from_email): void
    {
        $this->offer_from_email = $offer_from_email;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
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


}
<?php

require_once 'Repository.php';

class PlaceRepository extends Repository
{

    public function getPlaces(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM places;
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);;
    }
}
<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/PlaceRepository.php';

class MapController extends AppController
{
    private PlaceRepository $placeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->placeRepository = new PlaceRepository();

    }

    public function map()
    {
        $this->render('add');
    }

    public function places()
    {
        $places= $this->placeRepository->getPlaces();

        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($places);
    }
}

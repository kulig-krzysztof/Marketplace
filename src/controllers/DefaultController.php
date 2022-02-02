<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('login');
    }

    public function actions() {
        $this->render('actions');
    }

    public function categories() {
        $this->render('categories');
    }

    public function add() {
        $this->render('add');
    }
    public function register() {
        $this->render('register');
    }
}
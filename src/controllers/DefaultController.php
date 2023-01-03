<?php

require_once 'AppController.php';
session_start();

class DefaultController extends AppController {
    public function index() {
        if(!isset($_SESSION['email'])) {
            $this->render('login');
        }
        else {
            $this->render('actions');
        }
    }

    public function actions() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('actions');
        }
    }

    public function categories() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('categories');
        }
    }

    public function add() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('add');
        }
    }
    public function register() {
        $this->render('register');
    }

    public function logout() {
        $this->render('login');
    }

    public function displayCategory() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('results');
        }
    }

    public function item() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('item');
        }
    }
}
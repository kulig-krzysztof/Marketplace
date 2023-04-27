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
    public function registerPage() {
        $this->render('register');
    }

    public function logout() {
        $this->render('login');
    }

    public function category() {
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

    public function info() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('info');
        }
    }

    public function updateUserData() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('updateUserData');
        }
    }

    public function updateDataSite() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('change-user-data');
        }
    }

    public function updateItemData() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('updateItemData');
        }
    }

    public function updateItemSite() {
        if(!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            $this->render('change-item-data');
        }
    }
}
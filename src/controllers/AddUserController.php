<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class AddUserController extends AppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function register()
    {


        if ($this->isPost() && $_POST['email'] != null && $_POST['password'] != null && $_POST['repeatPassword'] == $_POST['password'] && $_POST['name'] != null && $_POST['surname'] != null) {
            $user = new User($_POST['email'], md5($_POST['password']), $_POST['name'], $_POST['surname']);

            $email = $_POST['email'];
            $check = $this->userRepository->getUser($email);
            if ($check) {
                return $this->render('register', ['messages' => ['User with this email already exists!']]);
            }
            $this->userRepository->addUser($user);
            return $this->render('login', ['messages' => ['User added!']]);


        }
        elseif ($_POST['email'] == null || $_POST['password'] == null || $_POST['repeatPassword'] != $_POST['password'] || $_POST['name'] == null || $_POST['surname'] == null) {
            return $this->render('register', ['messages' => ['Wrong data!']]);
        }


        return $this->render('register');
    }
}
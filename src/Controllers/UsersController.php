<?php

namespace News\Controllers;

use News\Core\View;

class UsersController
{
    private $usersModel = null;
    private $auth = null;

    public function __construct($usersModel, $auth)
    {
        $this->usersModel = $usersModel;
        $this->auth = $auth;
    }

    public function create($fileName)
    {
        View::render($fileName);
    }

    public function createLogin($fileName)
    {
        View::render($fileName);
    }

    public function insert()
    {
        if (!$this->usersModel->userExists($_POST['email'])) {
            if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username'])) {
                $this->usersModel->insert(
                    htmlspecialchars($_POST['username']),
                    htmlspecialchars($_POST['email']),
                    htmlspecialchars($_POST['password'])
                );

                header('location: ' . BASE_URL . "index.php?page=news");
            }
        }
    }

    public function delete()
    {
        $this->usersModel->delete($_POST['id']);
    }

    public function logOut()
    {
        $this->auth->logOut();
    }

    public function logIn()
    {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $this->auth->logIn($email, $password);
    }
}

<?php

namespace App\Controllers;

use App\DTOs\UserDTO;
use App\Core\Controller;
use App\Repositories\UserRepository;
use App\Services\UserService;

class UserController extends Controller {

    public function login() {
        $this->checkNotAuth();

        $this->view('users/login');
    }

    public function authenticate() {
        $this->checkNotAuth();

        try {
            $dataLogin = new UserDTO($_POST);
            $userLogin = new UserService();
            $resultado = $userLogin->login($dataLogin);

        } catch (\Throwable $th) {
            $this->view('users/login', ['erros' => $th->getMessage()]);
            return;
        }

        $this->redirect('home/index');
    }

    public function create() {
        $this->checkNotAuth();
        
        $this->view('users/register');
    }

    public function store() {
        $this->checkNotAuth();

        try {
            $dataUser = new UserDTO($_POST);
            $userService = new UserService;
            $resultado = $userService->create_user($dataUser);

        } catch (\Throwable $th) {
            $this->view('users/register', [$th]);
            return;
        }

        $this->redirect('home/index');
    }

    public function profile() {
        $this->checkAuth();
        
        $this->view('users/profile');
    }

    public function update() {
        $this->checkAuth();

        $dataUser = new UserDTO($_POST);
        $updateUser = new UserService;
        $userId = $_SESSION['user_id'];
        $resultado = $updateUser->update_user($dataUser, $userId);

        $this->redirect('user/profile');

    }

    public function delete() {
        $this->checkAuth();

        session_start();
        $userId = $_SESSION['user_id'];
        $deletUser = new UserRepository();
        $resultado = $deletUser->delete_user($userId);

        session_unset();
        session_destroy();

        $this->redirect('user/login');
    }

    public function logout() {
        $this->checkAuth();

        session_start();
        session_unset();
        session_destroy();

        $this->redirect('user/login');
    }

}
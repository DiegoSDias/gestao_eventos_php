<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService {

    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function login(UserDTO $data) {
        $checkEmailExist = $this->repository->check_email($data->email);
        
        if (!$checkEmailExist) {
            throw new \Exception("Esse email e/ou senha estão incorretos.");
        }

        $checkPassowrd = password_verify($data->password, $checkEmailExist->password);

        if(!$checkPassowrd) {
            throw new \Exception("Esse email e/ou senha estão incorretos.");
        }
        $_SESSION['user_id'] = $checkEmailExist->id;
        $_SESSION['user_name'] = $checkEmailExist->name;
        $_SESSION['user_email'] = $data->email;

        return true;
    }
    
    public function create_user(UserDTO $data) {
        $senhaHash = password_hash($data->password, PASSWORD_DEFAULT);

        $checkEmailValid = $this->repository->check_email($data->email);

        if($checkEmailValid) {
            throw new \Exception("Este e-mail já está sendo usado por outro usuário.");
        }

        return $this->repository->save_user($data, $senhaHash);
    }

    public function update_user(UserDTO $data, $userId) {
        $currentUser = $this->repository->find_by_id($userId);

        if($data->email !== $currentUser['email']) {
            $checkEmailValid = $this->repository->check_email($data->email);
            if($checkEmailValid) {
                throw new \Exception("Este e-mail já está sendo usado por outro usuário.");
            }
        }
        
        if(!empty($data->password)) {
            $senhaHash = password_hash($data->password, PASSWORD_DEFAULT);
        } else {
            $senhaHash = $currentUser['password'];
        }

        $resultado = $this->repository->update_user($data, $userId, $senhaHash);
        
        if($resultado) {
            $_SESSION['user_name'] = $data->name;
            $_SESSION['user_email'] = $data->email;
        }

        return $resultado;
    }
}
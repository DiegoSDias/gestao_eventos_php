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

        $user = new User();
        $user->setName($checkEmailExist['name']);
        $user->setEmail($checkEmailExist['email']);
        $user->setPassword($checkEmailExist['password']);
        
        $checkPassowrd = password_verify($data->password, $user->getPassword());

        if(!$checkPassowrd) {
            throw new \Exception("Esse email e/ou senha estão incorretos.");
        }

        $_SESSION['user_id'] = $checkEmailExist['id'];
        $_SESSION['user_name'] = $user->getName();
        $_SESSION['user_email'] = $user->getEmail();

        return true;
    }
    
    public function create_user(UserDTO $data) {
        $senhaHash = password_hash($data->password, PASSWORD_DEFAULT);

        $checkEmailValid = $this->repository->check_email($data->email);

        if($checkEmailValid) {
            throw new \Exception("Este e-mail já está sendo usado por outro usuário.");
        }

        $user = new User;
        $user->setName($data->name);
        $user->setEmail($data->email);
        $user->setPassword($senhaHash);

        return $this->repository->save_user($user);
    }

    public function update_user(UserDTO $data, $userId) {
        $currentUser = $this->repository->find_by_id($userId);

        if($data->email !== $currentUser['email']) {
            $checkEmailValid = $this->repository->check_email($data->email);
            if($checkEmailValid) {
                throw new \Exception("Este e-mail já está sendo usado por outro usuário.");
            }
        }

        $user = new User();
        $user->setName($data->name);
        $user->setEmail($data->email);
        
        if(!empty($data->password)) {
            $user->setPassword(password_hash($data->password, PASSWORD_DEFAULT));
        } else {
            $user->setPassword($currentUser['password']);
        }

        $resultado = $this->repository->update_user($user, $userId);
        
        if($resultado) {
            $_SESSION['user_name'] = $user->getName();
            $_SESSION['user_email'] = $user->getEmail();
        }

        return $resultado;
    }
}
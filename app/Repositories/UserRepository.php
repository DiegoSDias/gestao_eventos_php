<?php

namespace App\Repositories;

use App\Core\Database;
use App\DTOs\UserDTO;
use App\Models\User;

class UserRepository {

    public function __construct()
    {
        
    }


    public function check_email($email) {

        try {
            if (!$email) {
                throw new \Exception("Esse email e/ou senha estão incorretos.");
            }

            $user = User::where('email', $email)
                    ->first();

            return $user ?: null;

        } catch (\Throwable $e) {
            echo 'Erro ao verificar no banco: ' . $e->getMessage();
        }
    }


    public function save_user(UserDTO $data, $senhaHash) {
        try {
            $userCreate = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => $senhaHash,
            ]);

            return $userCreate ?: null;
        } catch (\Throwable $e) {
            echo 'Erro ao salvar no banco: ' . $e->getMessage();
        }
        
    }

    public function find_by_id($id) {
        try {
            $user = User::find($id);

            return $user ?: null;

        } catch (\Throwable $e) {
            echo 'Erro ao buscar no banco: ' . $e->getMessage();
        }
        
    }

    public function update_user(UserDTO $data, $id, $senhaHash) {
        try {
            
            $userUpdate = User::find($id);

            $userUpdate->update([
                'name' => $data->name,
                'email' => $data->email,
                'password' => $senhaHash,
            ]);

            return $userUpdate ?: null;
        } catch (\Throwable $e) {
            echo 'Erro ao atualizar no banco: ' . $e->getMessage();
        }
    }

    public function delete_user($id) {
        try {
            $user = User::where('id', $id)
                    ->delete();

            return $user ?: null;
        } catch (\Throwable $e) {
            echo 'Erro ao deletar no banco: ' . $e->getMessage();
        }
    }
}


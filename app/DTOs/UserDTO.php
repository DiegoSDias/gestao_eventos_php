<?php

namespace App\DTOs;


class UserDTO {
    public string $name;
    public string $email;
    public string $password;

    public function __construct($dados)
    {
        $this->name = $dados['name'] ?? '';
        $this->email = $dados['email'] ?? '';
        $this->password = $dados['password'] ?? '';
    }
}
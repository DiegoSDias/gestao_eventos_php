<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    
    public function index() {
        $this->checkAuth();
        
        $this->view('dashboard', [
            'nome' => $_SESSION['user_name']
        ]);
    }
}
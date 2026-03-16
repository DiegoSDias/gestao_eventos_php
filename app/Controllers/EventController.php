<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class EventController extends Controller {

    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create() {
        $this->view('events/create');
    }
}
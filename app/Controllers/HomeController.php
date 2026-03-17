<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\EventRepository;

class HomeController extends Controller {
    
    public function index() {
        $this->checkAuth();

        $events = new EventRepository();
        $myEvents = $events->my_events($_SESSION['user_id']);
        $allEvents = $events->all_events($_SESSION['user_id']);
        $allEventsInscribe = $events->all_events_inscribe($_SESSION['user_id']);
        
        $this->view('dashboard', [
            'myEvents' => $myEvents,
            'allEvents' => $allEvents,
            'allEventsInscribe' => $allEventsInscribe,
        ]);
    }
}
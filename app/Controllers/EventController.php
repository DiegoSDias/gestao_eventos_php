<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\DTOs\EventDTO;
use App\Repositories\EventRepository;
use App\Services\EventService;

class EventController extends Controller {

    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create() {
        $this->checkAuth();

        $this->view('events/create');
    }

    public function store() {
        $this->checkAuth();

        $eventData = new EventDTO($_POST);
        $eventService = new EventService();
        $resultado = $eventService->create_event($eventData);
        
        $this->redirect('home/index');
    }

    public function show($id) {
        $this->checkAuth();

        $eventUser = new EventRepository();
        $eventShow = $eventUser->find_by_id($id);
        
        $this->view('events/show', [
            'event' => $eventShow
        ]);
    }

    public function edit($id) {
        $this->checkAuth();

        $eventUser = new EventRepository();
        $eventEdit = $eventUser->find_by_id($id);
        
        $this->view('events/edit', [
            'event' => $eventEdit
        ]);
    }

    public function update() {
        $this->checkAuth();

        $eventData = new EventDTO($_POST);
        $eventService = new EventService();
        $id = $_POST['id'];
        $resultado = $eventService->update_event($eventData, $id);

        $this->redirect('home/index');
    }

    public function delete($id) {
        $this->checkAuth();

        $eventUser = new EventRepository();
        $eventEdit = $eventUser->delete_event($id);
        
        $this->redirect('home/index');
    }

    public function inscribe($id) {
        $this->checkAuth();
        $userId = $_SESSION['user_id'];
        $eventUser = new EventRepository();
        $eventInscribe = $eventUser->inscribe_event($id, $userId);
        
        $this->redirect('home/index');
    }

    public function cancel_inscribe($id) {
        $this->checkAuth();

        $userId = $_SESSION['user_id'];
        $eventUser = new EventRepository();
        $eventInscribe = $eventUser->cancel_inscribe($id, $userId);
        
        $this->redirect('home/index');
    }
}
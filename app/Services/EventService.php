<?php

namespace App\Services;

use App\DTOs\EventDTO;
use App\Models\Event;
use App\Repositories\EventRepository;

class EventService {

    private $repositoryEvent;

    public function __construct()
    {
        $this->repositoryEvent = new EventRepository();
    }

    public function create_event(EventDTO $data) {

        return $this->repositoryEvent->save_event($data);
    }

    public function update_event(EventDTO $data, $idEvent) {

        return $this->repositoryEvent->update_event($data, $idEvent);
    }
}
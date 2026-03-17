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
        $event = new Event();
        $event->setTitle($data->title);
        $event->setDescription($data->description);
        $event->setEventDate($data->event_date);
        $event->setLocation($data->location);
        $event->setCreatedBy($_SESSION['user_id']);

        return $this->repositoryEvent->save_event($event);
    }

    public function update_event(EventDTO $data, $idEvent) {

        $event = new Event();
        $event->setTitle($data->title);
        $event->setDescription($data->description);
        $event->setEventDate($data->event_date);
        $event->setLocation($data->location);
        $event->setCreatedBy($_SESSION['user_id']);

        return $this->repositoryEvent->update_event($event, $idEvent);
    }
}
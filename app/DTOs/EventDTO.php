<?php

namespace App\DTOs;

class EventDTO{
    public string $title;
    public string $description;
    public string $event_date;
    public string $location;

    public function __construct($dados)
    {
        $this->title = $dados['title'];
        $this->description = $dados['description'];
        $this->event_date = $dados['event_date'];
        $this->location = $dados['location'];
    }
}
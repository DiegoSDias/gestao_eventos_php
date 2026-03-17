<?php

namespace App\Models;

class Event {
    private $id;
    private $title;
    private $description;
    private $event_date;
    private $location;
    private $created_by;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = trim($title);
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getEventDate() {
        return $this->event_date;
    }

    public function setEventDate($event_date) {
        $this->event_date = $event_date;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function getCreatedBy() {
        return $this->created_by;
    }

    public function setCreatedBy($created_by) {
        $this->created_by = $created_by;
    }
}
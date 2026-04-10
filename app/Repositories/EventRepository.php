<?php

namespace App\Repositories;

use App\DTOs\EventDTO;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Database\Capsule\Manager as DB;

class EventRepository {

    public function __construct()
    {
        
    }

    public function save_event(EventDTO $data) {
        try {
            $event = Event::create([
                'title' => $data->title,
                'description' => $data->description,
                'event_date' => $data->event_date,
                'location' => $data->location,
                'created_by' => $_SESSION['user_id'],
            ]);
            
            return $event ?: null;

        } catch (\Throwable $e) {
            echo 'Erro ao criar no banco de dados: '. $e->getMessage();
        }
    }

   public function update_event(EventDTO $data, $idEvent) {
        try {

            $eventUpdate = Event::where('id', $idEvent)
                            ->where('created_by', $_SESSION['user_id'])
                            ->update([
                                'title' => $data->title, 
                                'description' => $data->description, 
                                'event_date' => $data->event_date, 
                                'location' => $data->location
                            ]);;
            

            return $eventUpdate ?: null;

        } catch (\Throwable $e) {
            echo 'Erro ao atualizar no banco de dados: '. $e->getMessage();
        }
   }

   public function delete_event($idEvent) {
        try {
            $eventDelete = Event::find($idEvent)->delete();
   
            return $eventDelete ?: null;

        } catch (\Throwable $e) {
            echo 'Erro ao deletar no banco de dados: '. $e->getMessage();
        }
   }

    public function my_events($userId) {
        try {

            $myEvents = Event::where('created_by', $userId)->orderBy('event_date', 'asc')->get();
            return $myEvents ?: null;

        } catch (\Throwable $e) {
            echo 'Erro ao buscar no banco de dados: '. $e->getMessage();
        }
    }

    public function all_events($userId) {
        try {

            $allEvents = Event::where('created_by', '!=', $userId)
                    ->whereDoesntHave('registrations', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    })
                    ->orderBy('event_date', 'asc')
                    ->get();
            
            return $allEvents ?: null;

        } catch (\Throwable $e) {
            echo 'Erro ao buscar no banco de dados: '. $e->getMessage();
        }
    }

    public function all_events_inscribe($userId) {
        try {
            $eventsInscribe = Event::whereHas('registrations', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('event_date', 'asc')
            ->get();

            return $eventsInscribe ?: null;

        } catch (\Throwable $e) {
            echo 'Erro ao buscar no banco de dados: '. $e->getMessage();
        }
    }

    public function find_by_id($id) {
        try {
            $event = Event::find($id);
            
            return $event ?: null;

        } catch (\Throwable $e) {
            echo 'Erro ao buscar no banco de dados: '. $e->getMessage();
        }
    }

   public function inscribe_event($id, $userId) {
        try {
            DB::beginTransaction();

            Registration::create([
                'event_id' => $id,
                'user_id' => $userId,
                'registration_date' => date('Y-m-d H:i:s')
            ]);

            Event::where('id', $id)->increment('number_registrations');

            return DB::commit(); 

        } catch (\Throwable $e) {
                DB::rollBack();

            echo 'Erro ao criar ou atualizar no banco de dados: '. $e->getMessage();
            return false;
        }
    }

   public function cancel_inscribe($id, $userId) {
        try {
            DB::beginTransaction();
            
            $deleted = Registration::where('event_id', $id)
                                    ->where('user_id', $userId)
                                    ->delete();

            if ($deleted) {
                Event::where('id', $id)
                    ->where('number_registrations', '>', 0)
                    ->decrement('number_registrations');
            }

            return DB::commit(); 

        } catch (\Throwable $e) {
            if (DB::inTransaction()) {
                DB::rollBack();
            }

            echo 'Erro ao deletar ou atualizar no banco de dados: '. $e->getMessage();
            return false;
        }
    }
}
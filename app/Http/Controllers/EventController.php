<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\User;

class EventController extends Controller
{
    public function index() {

        $search = request('search');

        if ($search) {
            $events = Events::where([['title','like', '%'.$search.'%']])->get();
        }else {
            $events = Events::all();

        }


        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        $event = new Events;
        $user= auth()->user();

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        $event->user_id = $user->id;

        //Upload image
        if ($request->hasFile('image') && $request->file('image')->isValid() ) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension ;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;

        }else {
            $event->image = '';
        }



        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {
        $event = Events::findOrFail($id);
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();
        
        //Verificar se o usuário já estáparticipando do evento
        $user = auth()->user();
        $hasUserJoined = false;

        if ($user) {
            $userEvents = $user->eventsAsParticipant->toarray();
            foreach ($userEvents as $userEvent) {
                if($userEvent['id'] == $id ) {
                    $hasUserJoined = true;
                }
            }
        }

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard() {
        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard' , ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant] );
    }

    public  function destroy($id) {
        Events::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso!');
    }

    public function edit($id) {
        $user = auth()->user();

        $event = Events::findOrFail($id);
        
        if ($user->id != $event->user_id) {
            return redirect('/dashboard');
        }

        return view('/events/edit', ['event' =>$event]);
    }

    public function update(Request $request) {
        $data = $request->All();

        //Upload image
        if ($request->hasFile('image') && $request->file('image')->isValid() ) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension ;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;

        }

        Events::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento Editado com Sucesso!');
    }

    public function joinEvent($id) {
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Events::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confimada no evento ' . $event->title);
    }

    public function leaveEvent($id) {
        $user = auth()->user();

        $event = Events::findOrfail($id);

        $user->eventsAsParticipant()->detach($id);

        return redirect('/dashboard')->with('msg', 'Presença no cancelada com sucesso no evento ' . $event->title . '!');
    }
}

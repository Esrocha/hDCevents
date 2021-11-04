@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
        <table class="table">
            <thead>
                <th scope="col" >#</th>
                <th scope="col" >Nome</th>
                <th scope="col" >Participantes</th>
                <th scope="col" >Ações</th>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td scropt="row"> {{ $loop->index + 1}} </td>
                    <td> <a href="/events/{{ $event->id }}"> {{ $event->title }} </a></td>
                    <td> {{count($event->users) }} </td>
                    <td>
                        <a href="/events/edit/{{$event->id}}" class="btn btn-info edit-btn" >Editar</a>
                        <form action="/events/{{$event->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h3>Você não tem eventos! <a href="/events/create">criar evento.</a> </h3>
    @endif
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Eventos que estou participando</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsasparticipant) > 0)
        <table class="table">
            <thead>
                <th scope="col" >#</th>
                <th scope="col" >Nome</th>
                <th scope="col" >Participantes</th>
                <th scope="col" >Ações</th>
            </thead>
            <tbody>
                @foreach($eventsasparticipant as $event)
                <tr>
                    <td scropt="row"> {{ $loop->index + 1}} </td>
                    <td> <a href="/events/{{ $event->id }}"> {{ $event->title }} </a></td>
                    <td> {{count($event->users) }} </td>
                    <td>
                        <form action="/events/leave/ {{$event->id}} " method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-secondary">
                                <ion-icon name="trash-outline" ></ion-icon>
                                Sair do Evento
                            </button>
                            
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h3>Você não está em nenhum evento! <a href="/">Ver eventos.</a> </h3>
    @endif
</div>


@endsection

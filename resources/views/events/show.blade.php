
@extends('layouts.main')

@section('title', $event->title)

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{$event->image}} " class="img-fluid" alt="$event->title">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{$event->title}}</h1>
                <p class="event-owner"><ion-icon  name="calendar-outline"></ion-icon> {{date('d/m/Y', strtotime($event->date))}}</p>
                <p class="event-city"><ion-icon name="location-outline" ></ion-icon> {{$event->city}} </p>
                <p class="event-participants"><ion-icon name='people-outline' ></ion-icon> {{count($event->users) }} Participantes</p>
                <p class="event-owner"><ion-icon  name="star-outline"></ion-icon> {{$eventOwner['name']}}</p>
                <p class="event-owner"><ion-icon  name="create-outline"></ion-icon> Atualizado em: {{date('d/m/Y', strtotime($event->updated_at))}}</p>
                <div class="items">
                    <br>
                    <h3>Haverá:</h3>
                    @foreach($event->items as $item)
                        <ion-icon style="color: green" name='checkmark-outline' ></ion-icon>{{$item}}<br>
                    @endforeach
                </div>
                <form action="/events/join/ {{$event->id}} " method="POST">
                    @csrf
                    @if(!$hasUserJoined)
                        <a href="/events/join/ {{$event->id}} " 
                            class="btn btn-primary" id="event-submit" 
                            onclick="event.preventDefault(); 
                            this.closest('form').submit(); ">
                            Confirmar Presença
                        </a>
                    @else
                        <div class="alert alert-primary mt-3 mb-3 shadow-sm bold"  role="alert">
                            <span class="col-md-6 offset-md-3">Você já confirmou presença neste evento!</span> 
                        </div>
                    @endif
                </form>
            </div>
            <div class="col-md-12">
                <h3>Sobre o Evento:</h3>
                <p class="event-description"> {{$event->description}} </p>
            </div>
        </div>
    </div>

@endsection

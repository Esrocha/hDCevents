
@extends('layouts.main')

@section('title', 'hDC Events')

@section('content')

    <div id="search-container" class="col-md-12">
        <h1>Busque um Evento</h1>
        <form action="/" method="get">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procurar" >
        </form>
    </div>
    <div id="events-container" class="col-md-12">
        @if($search)
        <h2>Buscando por: {{$search}} </h2>
        @else
        <h2>Próximos Eventos</h2>
        <p>Veja os Eventos dos Próximos dias</p>
        @endif
        <div id="cards-container" class="row">
            @if(count($events) > 0)

                @foreach($events as $event)
                    <div class="card col-md-3">
                        <img src="/img/events/{{$event->image}}" alt="{{ $event->title }}">
                        <div class="card-body">
                            <p class="card-date"> {{date('d/m/Y', strtotime($event->date))}} </p>
                            <h5 class="card-title"> {{ $event->title }} </h5>
                            <p class="card-participants">{{count($event->users) }} Participantes</p>
                            <a href="/events/{{$event->id}}" class="btn btn-primary">Saber Mais</a>
                        </div>
                    </div>
                @endforeach
            @else
                    @if(count($events) == 0 && ($search))
                        <h3>Nenum evento econtrado com {{$search}}. </h3>
                    @elseif(count($events) == 0)
                        <h3>Não há eventos disponíveis</h3>
                    @endif
            @endif
        </div>
    </div>
@endsection

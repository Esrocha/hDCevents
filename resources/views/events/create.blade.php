
@extends('layouts.main')

@section('title', 'hDC Events - Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Imagem do evento:</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Evento">
        </div>
        <div class="form-group">
            <label for="date">Data:</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Data do Evento">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do Evento">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?:</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que acontecerá no evento?"></textarea>
        </div>
        <div class="form-group">
            <h3>Itens inclusos no  Evento:</h3>
            <input type="checkbox" name="items[]" value="Cadeira"> Cadeira
        </div>
        <div class="form-group">
            <input type="checkbox" name="items[]" value="Palco"> Palco 
        </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food"> Open Food
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Bar"> Open Bar
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes 
            </div>
        <input type="submit" class="btn btn-primary" value="criar evento">
    </form>
</div>


@endsection

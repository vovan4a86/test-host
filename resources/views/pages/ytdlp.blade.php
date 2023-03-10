@extends('template')

@section('title', 'Скачать аудио с YT')

@section('content')
    <h1 class="mt-3">Скачать аудио с YT</h1>
    <div class="mb-3 mt-5">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="switchUrl" onclick="clearInfo()">
            <label class="form-check-label" for="switchUrl" onclick="clearInfo()">ID вместо ссылки</label>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control d-block my-3" id="yt" value="" onchange="getImage(this)">
            <div id="error" class="text-danger"></div>
            <div id="name" class="text-success"></div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary mt-2" type="button" disabled
                        onclick="getFileFromUrl()">
                    Получить файл
                </button>
                <button type="button" class="btn btn-danger mt-2" aria-label="Очистить"
                        onclick="clearInfo()">Очистить
                </button>
            </div>
        </div>
        <div id="res"></div>
    </div>
@endsection



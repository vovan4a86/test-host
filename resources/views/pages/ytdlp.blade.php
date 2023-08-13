@extends('template')

@section('title', 'Скачать аудио с YT')

@section('content')
    <h3 class="mt-3 text-center text-white">Скачать аудио с YT:</h3>
    <div class="mb-3 mt-3">
        <div class="d-flex justify-content-between">
            <div class="form-check form-switch d-flex align-items-center">
                <input class="form-check-input mb-1" type="checkbox" role="switch"
                       id="switchUrl" onclick="clearInfo()">
                <label class="form-check-label mx-2 text-white"
                       for="switchUrl" onclick="clearInfo()">ID вместо ссылки</label>
            </div>
            <button type="button" class="btn btn-danger" aria-label="Очистить"
                    onclick="clearInfo()">Очистить
            </button>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control d-block my-3" id="yt" value=""
                   oninput="checkUrl(this)">
            <div id="error" class="text-danger"></div>
            <div id="name" class="text-success"></div>
            <button class="btn btn-primary mt-2" type="button" disabled
                    onclick="getFileFromUrl()">
                Получить файл
            </button>
        </div>
        <div id="res" class="text-center text-lg-start"></div>
    </div>
@endsection



@extends('template')

@section('title', 'Скачать аудио с YT')

@section('content')
    <h1 class="mt-3">Скачать аудио с YT</h1>
    <div class="mb-3 mt-5">
        <label for="url" class="form-label">Ссылка:</label>
        <div class="mb-3">
            <input type="text" class="form-control d-block" id="yt" value="">
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary mt-2" type="button" onclick="getFileFromUrl(event)">
                    Получить файл
                </button>
                <button type="button" class="btn btn-danger btn-close mt-2" aria-label="Очистить"
                        onclick="clearInfo()">Очистить
                </button>
            </div>
        </div>
        <div id="res"></div>
    </div>
@endsection



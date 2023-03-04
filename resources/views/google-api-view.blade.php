<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Google Api</title>
</head>
<body>
<div class="container">
    <div class="mb-3 mt-5">
        <label for="url" class="form-label">URL</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="url">
            <button class="btn btn-secondary" type="button" id="get-status">Получить статус</button>
            <div class="invalid-feedback"></div>
        </div>
        <button type="button" class="btn btn-primary" id="update">Обновление URL</button>
        <button type="button" class="btn btn-danger" id="delete">Удаление URL</button>
    </div>
    <div class="alert alert-info">
        <h4>Результат:</h4>
        <div id="result">...</div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"--}}
{{--        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"--}}
{{--        crossorigin="anonymous"></script>--}}
<script src="/js/main.js" defer></script>
</body>
</html>

let res = $('#res');
let btn = $('button.btn.btn-primary');
let err = $('#error');
let nameDiv = $('#name');
let urlInput = $('#yt');
let switchUrl = $('#switchUrl');
let url = '';

function getFileFromUrl() {
    $.ajax({
        url: "/get-file",
        type: "POST",
        contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            url: url,
        },
        beforeSend: function () {
            btn.prop('disabled', true);
            btn.html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' +
                ' Скачивние...'
            );
            res.empty();
        },
        success: function (response) {
            btn.prop('disabled', false);
            btn.html('Получить файл');
            let img = '';
            if (response.webp) {
                img = `
                      <picture>
                      <source type="image/webp" srcset="${response.thumb}">
                      <img class="d-block mx-auto mx-lg-0" src="${response.thumb}"
                           width="360" height="203" style="border-radius: 12px;">
                      </picture>`;
            } else {
                img = `
                    <img class="d-block" src="${response.thumb}"
                         width="360" height="203" style="border-radius: 12px;">`;
            }

            const name = `<div class="mt-2">${response.name}</div>
                          <a href="${response.file}" type="audio/mp3" download class="btn btn-success mt-2 btn-lg">Скачать</a>`
            res.append(img);
            res.append(name);
        },
        error: function (request, status, error) {
            btn.prop('disabled', true);
            btn.html('Получить файл');
            const name = `<div class="text-danger">
                          <p>Error!</p>
                          <p class="text-info">${request.responseText}</p></div>`
            res.append(name);
            console.log(request.responseText);
            console.log(status);
        }
    });
}

function getNameFromUrl() {
    $.ajax({
        url: "/get-name",
        type: "POST",
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            url: url,
        },
        beforeSend: function () {
            nameDiv.html('<div class="spinner-grow spinner-grow-sm text-primary" role="status">\n' +
                         '  <span class="visually-hidden"></span>\n' +
                         '</div>')
            res.empty();
        },
        success: function (response) {
            btn.prop('disabled', false);
            nameDiv.empty();
            nameDiv.html(response.text);
        },
        error: function (request, status, error) {
            nameDiv.html('Не удалось получить имя');
            console.log(request.responseText);
        }
    })
}

function checkUrl(elem) {
    err.empty();
    btn.prop('disabled', true);
    if(!switchUrl.is(':checked')) {
        const result = $(elem).val().startsWith("https://youtu.be/");
        if(!result) {
            nameDiv.empty();
            err.text('Ссылка должна начинаться с https://youtu.be/')
            btn.prop('disabled', true);
            return
        }
        btn.prop('disabled', false);
        url = $(elem).val();
    } else {
        if(urlInput.val().length < 5) {
            nameDiv.empty();
            err.text('Проверьте ID видео');
            btn.prop('disabled', true);
            return;
        }
        url = 'https://youtu.be/' + $(elem).val();
        btn.prop('disabled', false);
    }
    getNameFromUrl();
}
//https://youtu.be/r1y_8HrOf5Q
//https://youtu.be/r1y_8HrOf5Q

function clearInfo() {
    urlInput.val('');
    err.empty();
    res.empty();
    nameDiv.empty();
}



function sendIndexNow() {
    const token = $('meta[name="csrf-token"]').attr('content');

    // console.log(token);
    $.ajax({
        url: "/send-index-now",
        type: "POST",
        data: {
            "_token": token,
        },
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.log("Error!" + xhr.status);
            console.log("Error!" + error);
        },
    });


}

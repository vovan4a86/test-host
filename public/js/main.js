function getFileFromUrl(e) {
    e.preventDefault();
    let res = $('#res');
    let btn = $('button.btn.btn-primary');

    const url = $('#yt').val();

    $.ajax({
        url: "/get-file",
        type: "POST",
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            url: url,
        },
        beforeSend: function() {
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
            const name = `<img class="d-block" src="/output/${response.name}.jpg" width="360" height="203" style="border-radius: 12px;">
                          <div>${response.name}</div>
                          <a href="${response.file}" type="audio/mp3" download class="btn btn-success mt-2 btn-lg">Скачать</a>`
            res.append(name);
        },
        error: function (request, status, error) {
            btn.prop('disabled', false);
            btn.html('Получить файл');
            const name = `<div class="text-danger"><p>Error!</p><p class="text-info">${request.responseText}</p></div>`
            res.append(name);
            console.log(request.responseText);
        }
    });
}

function clearInfo() {
    $('#yt').val('');
    $('#res').empty();
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

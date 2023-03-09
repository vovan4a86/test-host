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
            btn.html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' +
                ' Fetching...'
            );
        },
        success: function (response) {
            btn.html('Get File');
            const name = `<div>${response.name}</div>`
            const link = `<a href="${response.file}" type="audio/mp3" download class="btn btn-success">Download</a>`
            res.append(name);
            res.append(link);
        },
        error: function (request, status, error) {
            btn.html('Get File');
            console.log(request.responseText);
        }
    });
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

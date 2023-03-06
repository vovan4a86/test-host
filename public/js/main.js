// const getURLStatus = async(url, action = 'get') => {
//     try {
//         const data = new FormData();
//         data.append('url', url);
//         data.append('action', action);
//         let response = await fetch('/api-send.php', {
//             method: 'post',
//             body: data
//         });
//         document.querySelector('#result').innerHTML = '';
//         document.querySelector('#url').classList.remove('is-invalid');
//         document.querySelector('.invalid-feedback').textContent = '';
//         if (response.ok) {
//             let result = await response.json();
//             if (result['result'] === 'error') {
//                 const error = result['error'];
//                 document.querySelector('#url').classList.add('is-invalid');
//                 document.querySelector('.invalid-feedback').textContent = error;
//             } else {
//                 document.querySelector('#result').innerHTML = `<pre class="mb-0">${result.body}</pre>`;
//             }
//         }
//     } catch (error) {
//         document.querySelector('#result').innerHTML = error;
//     }
// }
//
// document.querySelector('#get-status').onclick = () => {
//     getURLStatus(document.querySelector('#url').value);
// }
//
// document.querySelector('#update').onclick = () => {
//     getURLStatus(document.querySelector('#url').value, 'update');
// }
//
// document.querySelector('#delete').onclick = () => {
//     getURLStatus(document.querySelector('#url').value, 'delete');
// }
//
// function onSignIn(googleUser) {
//     var profile = googleUser.getBasicProfile();
//     console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
//     console.log('Name: ' + profile.getName());
//     console.log('Image URL: ' + profile.getImageUrl());
//     console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
// }

function getFileFromUrl(e) {
    e.preventDefault();
    // const url = document.querySelector('#yt').value;
    const url = $('#yt').value;

    $.ajax({
        url: "/get-file",
        type:"POST",
        data:{
            "_token": $('meta[name="csrf-token"]').attr('content'),
            url:url,
        },
        success:function(response){
            console.log(response);
        },
    });
}

function sendIndexNow(elem, e) {
    const url = $(elem).attr('href');
    let res = $('#res');

    console.log('123')

    // $.ajax({
    //     url: "/send-index-now",
    //     type: "POST",
    //     data:{
    //         "_token": $('meta[name="csrf-token"]').attr('content'),
    //         url:url,
    //     },
    //     success:function(response){
    //         console.log(response);
    //     },
    // });
}

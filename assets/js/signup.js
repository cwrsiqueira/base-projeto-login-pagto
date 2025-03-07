var showPass = document.querySelector("#showPass");
var showPassConfirm = document.querySelector("#showPassConfirm");
var passField = document.querySelector('#password');
var passFieldConfirm = document.querySelector('#password_confirm');

showPass.addEventListener("click", function () {
    var type = passField.getAttribute('type');

    document.querySelector('#eye').classList.toggle('d-none');
    document.querySelector('#eye_slash').classList.toggle('d-none');

    if (type === 'password') {
        passField.setAttribute('type', 'text');
    } else {
        passField.setAttribute('type', 'password');
    }
});

showPassConfirm.addEventListener("click", function () {
    var type = passFieldConfirm.getAttribute('type');

    document.querySelector('#eye_confirm').classList.toggle('d-none');
    document.querySelector('#eye_slash_confirm').classList.toggle('d-none');

    if (type === 'password') {
        passFieldConfirm.setAttribute('type', 'text');
    } else {
        passFieldConfirm.setAttribute('type', 'password');
    }
});
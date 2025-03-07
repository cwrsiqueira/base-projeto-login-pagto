var showPass = document.querySelector("#showPass");
var passField = document.querySelector('#password');

showPass.addEventListener("click", function () {
    var type = passField.getAttribute('type');

    document.querySelector('.fa-eye').classList.toggle('d-none');
    document.querySelector('.fa-eye-slash').classList.toggle('d-none');

    if (type === 'password') {
        passField.setAttribute('type', 'text');
    } else {
        passField.setAttribute('type', 'password');
    }
});
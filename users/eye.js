let eyeicon = document.getElementById("eye0");
let password = document.getElementById("pwd");

let eyeicon1 = document.getElementById("eye1");
let password1 = document.getElementById("spwd");

eyeicon.onclick = function () {
    if (password.type == "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}

eyeicon1.onclick = function () {
    if (password1.type == "password") {
        password1.type = "text";
    } else {
        password1.type = "password";
    }
}
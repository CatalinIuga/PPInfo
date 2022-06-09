$(document).foundation()

function login() {
    location.href = 'loginregister.html';
}

function validateForm_1() {
    let nume = document.forms["login_f"]["nume"].value;
    let pass = document.forms["login_f"]["parola"].value;
    if (nume == "") {
        alert("Ai uitat sa specifici numele contului!");
        return false;
    }
    if (pass == "") {
        alert("Trebuie sa introduci o parola!");
        return false;
    }
}

function validateForm_2() {
    let nume2 = document.forms["register_f"]["username"].value;
    let email2 = document.forms["register_f"]["mail"].value;
    let scoala2 = document.forms["register_f"]["school"].value;
    let pass2 = document.forms["register_f"]["password"].value;
    if (nume2 == "") {
        alert("Ai uitat sa specifici numele!");
        return false;
    }
    if (pass2 == "") {
        alert("Trebuie sa introduci o parola!");
        return false;
    }

    if (scoala2 == "") {
        alert("Completeaza scoala la care esti tu!");
        return false;
    }
    if (email2 == "") {
        alert("Ai uitat de mail!");
        return false;
    }
    if (email2.indexOf("@", 0) < 0) {
        window.alert("Email invalid!");
        email2.focus();
        return false;
    }

    if (email2.indexOf(".", 0) < 0) {
        window.alert("Email invalid!");
        email2.focus();
        return false;
    }
    return true;
}
document.getElementById("login-form").onsubmit = function (e) {
    e.preventDefault();
    checkLoginFormInputs();
}

function checkLoginFormInputs() {
    const loginEmail = document.getElementById('login-email');
    const loginPassword = document.getElementById('login-password');

    const loginEmailValue = loginEmail.value.trim();
    const loginPasswordValue = loginPassword.value.trim();

    if (loginEmailValue === '') {
        setErrorFor(loginEmail, 'Email is required');
    } else {
        setSuccessFor(loginEmail);
    }

    if(loginPasswordValue === '') {
        setErrorFor(loginPassword, 'Password is required');
    } else {
        setSuccessFor(loginPassword);
    }

}


function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
   
}




function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}

var el = document.getElementById('login-password');

alert(hasClass(el, 'succrss'));



function clearFields(){

}


var showPass = document.getElementById('password');

function showPassword(){
    if (showPass.type === 'password'){
        showPass.type = 'text';
    } else {
        showPass.type = 'password';
    }
}

var showConPass = document.getElementById('confirm-password');

function showConfirmPassword(){
    if (showConPass.type === 'password'){
        showConPass.type = 'text';
    } else {
        showConPass.type = 'password';
    }
}

var userName = document.getElementById('username');
var email = document.getElementById('email');

function clearFields(){
    userName.value = '';
    showPass.value = '';
    showConPass.value = '';
    email.value = '';
}

window.onload = clearFields;


//email validation
function validateEmail(){
    document.getElementById('email-message').style.display ="block";

    if(!email.value.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)){
        document.getElementById('email-error').classList.add('invalid');
        document.getElementById('email-error').classList.remove('valid');
    } else {
        document.getElementById('email-error').classList.add('valid');
        document.getElementById('email-error').classList.remove('invalid');
    }
}


email.onkeydown = validateEmail;

//password validation


var passInput = document.getElementById('password');
var letter = document.getElementById('letter');
var capital = document.getElementById('capital');
var number = document.getElementById('number');
var length = document.getElementById('length');

passInput.onfocus = function(){
    document.getElementById('password-message').style.display = "block";
}




passInput.onkeyup = function(){
    var lowerCaseLetters = /[a-z]/g;

    if(passInput.value.match(lowerCaseLetters)){
        letter.classList.remove('invalid');
        letter.classList.add('valid');
    } else {
        letter.classList.remove('valid');
        letter.classList.add('invalid');
    }

    var upperCaseLetter = /[A-Z]/g;

    if(passInput.value.match(upperCaseLetter)){
        capital.classList.remove('invalid');
        capital.classList.add('valid');
    } else {
        capital.classList.remove('valid');
        capital.classList.add('invalid');
    }

    var numbers = /[0-9]/g;

    if(passInput.value.match(numbers)){
        number.classList.remove('invalid');
        number.classList.add('valid');
    } else {
        number.classList.remove('valid');
        number.classList.add('invalid');
    }

    if(passInput.value.length >= 8){
        length.classList.remove('invalid');
        length.classList.add('valid');
    } else {
        length.classList.remove('valid');
        length.classList.add('invalid');
    }
}


//confirm password

var confirmInput = document.getElementById('confirm-password');

confirmInput.onfocus = function(){
    document.getElementById('confirm-message').style.display = "block";
}

confirmInput.onkeyup = function(){
    if(passInput.value === confirmInput.value){
        document.getElementById('passmatch').classList.remove('invalid');
        document.getElementById('passmatch').classList.add('valid');
    } else {
        document.getElementById('passmatch').classList.remove('valid');
        document.getElementById('passmatch').classList.add('invalid');
    }
}



//php message display

var submitBtn = document.getElementById('submit');
var formToggle = document.getElementById('checkPHP');

submitBtn.onclick = function(){
    if(formToggle.value == 'success'){
        document.getElementById('register').style.display = 'none';
        document.getElementById('success-message').style.display = 'block';
    } else {
        document.getElementById('register').style.display = 'flex';
    }
}
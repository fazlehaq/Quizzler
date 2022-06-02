let showPass=false;

const checkBox = document.querySelector('#showpassword');
const password = document.querySelector('#password');
const cPassword = document.querySelector('#cPassword');

checkBox.onchange = function(){
    if(checkBox.checked)
    {
        password.type='text';
        cPassword.type='text';
    }

    else{
        password.type='password';
        cPassword.type='password';
    }
}
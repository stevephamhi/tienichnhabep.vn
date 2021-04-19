import Validation from '../lib/validation.js';

let validation = new Validation;

const usernameEl = document.getElementById("username");
const passwordEl = document.getElementById("password");
const error_usernameEl = document.querySelector(".error_username");
const error_passwordEl = document.querySelector(".error_password");
const formLoginEl = document.getElementById("formLogin");
const errorLogin = document.querySelector(".statusLogin");
var errorStatus = true;

usernameEl.addEventListener('keyup', function() {
    errorLogin.innerHTML = '';
    checkusername(this.value);
});

function checkusername(vl_username) {
    let errorTxt = undefined;
    if(vl_username.length === 0) {
        errorStatus = true;
        errorTxt = "Không được để trống";
    } else {
        if(vl_username.length >= 6) {
            if(!(validation.is_username(vl_username))) {
                errorStatus = true;
                errorTxt = "Tên đăng nhập không hợp lệ";
            } else {
                errorTxt = '';
                errorStatus = false;
            }
        } else {
            errorStatus = true;
            errorTxt = 'Tên đăng nhập >= 6 ký tự';
        }
    }
    error_usernameEl.innerHTML = errorTxt;
}

passwordEl.addEventListener('keyup', function() {
    errorLogin.innerHTML = '';
    checkpassword(this.value);
});

function checkpassword(vl_password) {
    let errorTxt = undefined;
    if(vl_password.length === 0) {
        errorStatus = true;
        errorTxt = "Không được để trống";
    } else {
        if(vl_password.length >= 6) {
            if(!(validation.is_password(vl_password))) {
                errorStatus = true;
                errorTxt = "Mật khẩu không hợp lệ";
            } else {
                errorTxt = '';
                errorStatus = false;
            }
        } else {
            errorStatus = true;
            errorTxt = 'Mật khẩu >= 6 ký tự';
        }
    }
    error_passwordEl.innerHTML = errorTxt;
}

formLoginEl.addEventListener('submit', function() {
    checkusername(usernameEl.value);
    checkpassword(passwordEl.value);
    if(errorStatus) {
        event.preventDefault();
    }
});
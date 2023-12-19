const email = document.querySelector("#email");
const password = document.querySelector("#password");
const phone = document.querySelector("#phone");
const fname = document.querySelector("#firstname");
const lname = document.querySelector("#lastname");
const error_e = document.querySelector(".email-error");
const error_p = document.querySelector(".password-error");
const error_fn = document.querySelector(".fname-error");
const error_ln = document.querySelector(".lname-error");
const error_ph = document.querySelector(".phone-error");
email.onblur = ()=>{
    if(email.value.trim() == ''){
        email.style.border = '2px solid red';
        error_e.innerHTML = 'Fill the email input!'
    }
    else if(!email.value.includes('@')){
        email.style.border = '2px solid red';
        error_e.innerHTML = 'email is invalid!'
    }
    else{
        email.style.border = '2px solid green';
        error_e.innerHTML = '';
    }
}
password.onblur = ()=>{
    if(password.value.trim() == ''){
        password.style.border = '2px solid red';
        error_p.innerHTML = 'Fill the password input!'
    }
    else{
        password.style.border = '2px solid green';
        error_p.innerHTML = '';
    }
}

phone.onblur = ()=>{
    if(phone.value.trim() == ''){
        phone.style.border = '2px solid red';
        error_ph.innerHTML = 'Fill the phone input!'
    }
    else{
        phone.style.border = '2px solid green';
        error_ph.innerHTML = '';
    }
}

fname.onblur = ()=>{
    if(fname.value.trim() == ''){
        fname.style.border = '2px solid red';
        error_fn.innerHTML = 'Fill the firstname input!'
    }
    else{
        fname.style.border = '2px solid green';
        error_fn.innerHTML = '';
    }
}

lname.onblur = ()=>{
    if(lname.value.trim() == ''){
        lname.style.border = '2px solid red';
        error_ln.innerHTML = 'Fill the lastname input!'
    }
    else{
        lname.style.border = '2px solid green';
        error_ln.innerHTML = '';
    }
}

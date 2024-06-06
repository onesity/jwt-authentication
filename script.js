import { success_modal,validateUsername,validateEmail, validatePassword} from './functions.js';
window.addEventListener('load', () => {
    
    const signup_btn = document.getElementById('signup');

    const username = document.getElementById('username');
    const username_error = document.getElementById('username_error');

    const email = document.getElementById('email');
    const email_error = document.getElementById('email_error');

    const password = document.getElementById('password');
    const password_error = document.getElementById('password_error');
    
    signup_btn.addEventListener('click', () => {
            let errors = [];
           var usernameRes=validateUsername(username.value);

            if(usernameRes.status==true){
                username_error.style.display = 'none';
                username.style.border = '1px solid green';
            }else{
                username_error.innerHTML = usernameRes.message;
                username.style.border = '1px solid red';
                username_error.style.display = 'block';
                errors['username']='username_error';
            }
            
            var emailRes=validateEmail(email.value)
            if(emailRes.status==true){
                email_error.style.display = 'none';
                email.style.border = '1px solid green';
            }else{
                email_error.innerHTML = emailRes.message;
                email.style.border = '1px solid red';
                email_error.style.display = 'block';
                errors['email']='email_error';
            }
            
            var passswordRes= validatePassword(password.value);
            if(passswordRes.status==true){
                password_error.style.display = 'none';
                password.style.border = '1px solid green';
            }else{
                password_error.innerHTML = passswordRes.message;
                password.style.border = '1px solid red';
                password_error.style.display = 'block';
                errors['password']='password_error';
            }
            
            var data = { username: username.value, email: email.value, password: password.value, action: 'signup' };
            if(Object.keys(errors).length == 0){
                
                fetch('http://localhost/jwt_authentication/ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                }
                ).then(function (res) {
                    return res.json();
                }).then((response) => {
                    if (response.success == true) {
                        success_modal(response.msg);
                        setTimeout(() => {
                            window.location.href = "http://localhost/jwt_authentication/login.php";
                        }, 3000)
                    }else{
                        email_error.innerHTML = response.msg;
                        email.style.border = '1px solid red';
                        email_error.style.display = 'block';
                    }
                })
            }
        })
})






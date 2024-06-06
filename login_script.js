import { success_modal,validateUsername,validateEmail, validatePassword} from './functions.js';
window.addEventListener('load',()=>{

    const login_btn = document.getElementById('login');

    const email = document.getElementById('email');
    const email_error = document.getElementById('email_error');

    const password = document.getElementById('password');
    const password_error = document.getElementById('password_error');
    const login_msg = document.getElementById('login_msg');
    const msg_div = document.getElementById('msg_div');

    login_btn.addEventListener('click', ()=>{
        let errors = [];
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



            if(Object.keys(errors).length == 0){
                var data = { email: email.value, password: password.value,action:'login' };
        
                fetch('http://localhost/jwt_authentication/ajax.php',{
                    method:'POST',
                    headers:{
                        'Content-Type':'application/json'
                    },
                    body:JSON.stringify(data)
                }).then(function(res){
                    return res.json();
                }).then(function(data){
                    if(data.login==true){
                        success_modal(data.msg);
                        setTimeout(() => {
                            window.location.href = "http://localhost/jwt_authentication/index.php";
                        }, 3000)
                    }else{
                        // login_msg.style.display = 'block';
                        msg_div.style.display = 'block';
                    
                        login_msg.innerHTML=data.msg;


                    }
                })

            }


    })

})
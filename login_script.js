import { success_modal, validateUsername, validateEmail, validatePassword } from './functions.js';
window.addEventListener('load', () => {

    const login_btn = document.getElementById('login');

    const email = document.getElementById('email');
    const email_error = document.getElementById('email_error');

    const password = document.getElementById('password');
    const password_error = document.getElementById('password_error');
    const login_msg = document.getElementById('login_msg');
    const msg_div = document.getElementById('msg_div');

    login_btn.addEventListener('click', () => {
        let errors = [];
        var emailRes = validateEmail(email.value)
        if (emailRes.status == true) {
            email_error.style.display = 'none';
            email.style.border = '1px solid green';
        } else {
            email_error.innerHTML = emailRes.message;
            email.style.border = '1px solid red';
            email_error.style.display = 'block';
            errors['email'] = 'email_error';
        }

        var passswordRes = validatePassword(password.value);
        if (passswordRes.status == true) {
            password_error.style.display = 'none';
            password.style.border = '1px solid green';
        } else {
            password_error.innerHTML = passswordRes.message;
            password.style.border = '1px solid red';
            password_error.style.display = 'block';
            errors['password'] = 'password_error';
        }



        if (Object.keys(errors).length == 0) {
            var data = { email: email.value, password: password.value, action: 'login' };

            fetch('http://localhost/travel_booking_system/travel_booking_system/ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(function (res) {
                return res.json();
            }).then(function (data) {
                if (data.login == true) {
                    success_modal(data.msg);
                    setTimeout(() => {
                        window.location.href = "http://localhost/travel_booking_system/travel_booking_system/index.php";
                    }, 3000)
                } else {
                    // login_msg.style.display = 'block';
                    msg_div.style.display = 'block';
                    login_msg.innerHTML = data.msg;
                }
            })

        }


    })
    const form_div = document.querySelector('.form-div');
    forgot_password_link.addEventListener('click', () => {
        form_div.innerHTML = '<h2 id="form-heading">Reset Password</h2><div id="msg_div"> <span id="login_msg">sdfs f sdfsd fsd fsdfsdf</span></div><input type="text" placeholder="email" name="email" id="email"><span id="email_error">email error</span><br><br><br><input type="button" id="send_otp_btn" value="Send OTP"> <br><br><span id="login-link"></span><a href="login.php"> Back to login</a> / <a href="signup.php"> Signup</a>';

        const email = document.getElementById('email');
        const email_error = document.getElementById('email_error');
        const send_otp_btn = document.getElementById('send_otp_btn');

        send_otp_btn.addEventListener('click', () => {
            var emailRes = validateEmail(email.value)

            if (emailRes.status == true) {
                var reset_password_data = { action: 'reset_password', email: email.value }
                email_error.style.display = 'none';
                fetch('http://localhost/travel_booking_system/travel_booking_system/ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/json'
                    },
                    body: JSON.stringify(reset_password_data)
                }).then((r) => {
                    return r.json();
                }).then((res) => {
                    if (res.success == true) {
                        const form_div = document.querySelector('.form-div');
                        const otp_field = document.createElement('input');
                        const otp_submit_btn = document.createElement('button');
                        const otp_msg = document.createElement('h3');
                        const otp_error = document.createElement('h5');
                        const resend_otp_btn = document.createElement('a');

                        otp_field.setAttribute('type', 'number');
                        otp_field.setAttribute('id', 'otp_field');
                        otp_field.setAttribute('size', '6');
                        otp_field.setAttribute('placeholder', 'Enter OTP');

                        otp_submit_btn.setAttribute('id', 'otp_submit_btn');
                        otp_msg.setAttribute('id', 'otp_msg');
                        otp_error.setAttribute('id', 'otp_error');
                        resend_otp_btn.setAttribute('id', 'resend_otp_btn');
                        resend_otp_btn.innerHTML = 'Resend OTP'
                        otp_submit_btn.innerHTML = 'Submit';
                        otp_msg.innerText = res.msg;

                        form_div.innerHTML = '';
                        form_div.append(otp_msg);
                        form_div.append(otp_field);
                        form_div.append(otp_error);
                        form_div.append(otp_submit_btn);
                        form_div.append(resend_otp_btn);
                        otp_submit_btn.addEventListener('click', () => {
                            if (otp_field.value.length != 6) {
                                otp_error.style.display = "block";
                                otp_error.innerHTML = 'Please enter correct OTP!'
                            } else {
                                otp_error.style.display = "none";
                                var otp_data = { action: 'verify_otp', otp: otp_field.value }
                                fetch('http://localhost/travel_booking_system/travel_booking_system/ajax.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(otp_data)

                                }).then((res) => {
                                    return res.json();
                                }).then((response) => {
                                    if (response.success == true) {
                                        form_div.innerHTML = '<h2 id="form-heading">Set New Password</h2><input type="text" placeholder="Enter new password" id="password"><br><span id="password_error">password error</span><br><br> <input type="text" placeholder="Enter agin password" id="password1"><br><span id="password_error1">password error</span><br><br><input type="button" id="restet_password_btn" value="Update Password"> <br><br><span id="login-link"></span><a href="login.php"> Back to login</a> / <a href="signup.php"> Signup</a>';
                                        // success_modal(response.msg);
                                        // setTimeout(() => {
                                        //     window.location.href = "http://localhost/travel_booking_system/travel_booking_system/login.php";
                                        // }, 3000)
                                        const restet_password_btn = document.getElementById("restet_password_btn");
                                        const password = document.getElementById("password");
                                        const password1 = document.getElementById("password1");
                                        const password_error = document.getElementById("password_error");
                                        const password_error1 = document.getElementById("password_error1");
                                        restet_password_btn.addEventListener('click', () => {
                                            var isPasswordMatched = false;
                                            var passswordRes = validatePassword(password.value);
                                            if (passswordRes.status == true) {
                                                password_error.style.display = 'none';
                                                if (password1.value.length != 0) {
                                                    if (password.value == password1.value) {
                                                        password_error1.style.display = 'none';
                                                        password.style.border = '2px solid green';
                                                        password1.style.border = '2px solid green';
                                                        isPasswordMatched = true;
                                                    } else {
                                                        password_error1.style.display = 'block';
                                                        password_error1.innerHTML = 'Both password not matched!';
                                                        password.style.border = '1px solid red';
                                                        password1.style.border = '1px solid red';

                                                    }
                                                } else {
                                                    password_error1.style.display = 'block';
                                                    password_error1.innerHTML = 'Please again enter password';
                                                }
                                            } else {
                                                password_error.innerHTML = passswordRes.message;
                                                password.style.border = '1px solid red';
                                                password_error.style.display = 'block';
                                            }
                                            if (isPasswordMatched == true) {
                                                var udatePasswordData = { action: 'upadte_password', password: password.value };
                                                fetch('http://localhost/travel_booking_system/travel_booking_system/ajax.php', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json'
                                                    },
                                                    body: JSON.stringify(udatePasswordData)
                                                }).then((res) => {
                                                    return res.json();
                                                }).then((response) => {
                                                    if (response.success == true) {
                                                        success_modal(response.msg);
                                                        setTimeout(() => {
                                                            window.location.href = "http://localhost/travel_booking_system/travel_booking_system/login.php";
                                                        }, 5000)

                                                    }
                                                })
                                            }
                                        })

                                    } else {
                                        otp_error.style.display = "block";
                                        otp_error.innerHTML = response.msg;
                                    }

                                })
                            }
                        })
                        resend_otp_btn.addEventListener('click', () => {
                            var resend_otp_data = { action: 'resend_otp' };
                            fetch('http://localhost/travel_booking_system/travel_booking_system/ajax.php', {
                                method: 'POST',
                                header: {
                                    'Content-Type': 'application/JSON'
                                },
                                body: JSON.stringify(resend_otp_data)
                            }).then((r) => {
                                return r.json();
                            }).then((res) => {
                                if (res.success == true) {
                                    otp_msg.innerText = res.msg;
                                }
                            })
                        })
                    } else {
                        email_error.innerHTML = res.msg;
                        email.style.border = '1px solid red';
                        email_error.style.display = 'block';

                    }
                })
            } else {
                email_error.innerHTML = emailRes.message;
                email.style.border = '1px solid red';
                email_error.style.display = 'block';
            }
        })
    })


})
export function success_modal(message) {
    const form_div = document.querySelector('.form-div');
    let msg = document.createElement('h2');
    form_div.innerHTML = '';
    msg.textContent = message;
    msg.id = 'success_msg';
    form_div.append(msg);
}

// export function validateUsername(username) {
//     const pattern = /^[A-Z][A-Za-z0-9_]*$/;
//     return pattern.test(username);
// }


export function validateUsername(username) {
    if (username.length === 0) {
        return { status: false, message: "Please enter username." };
    }

    if (!username.match(/^[a-z_]/)) {
        return { status: false, message: "Username must start with a lowercase alphabet or an underscore." };
    }

    const invalidCharMatch = username.match(/[^a-z0-9_]/);
    if (invalidCharMatch) {
        return { status: false, message: `Invalid character detected: '${invalidCharMatch[0]}'. Username can only contain lowercase letters, numbers, and underscores.` };
    }

 
    const containsAlphabet = username.match(/[a-z]/);
    if (!containsAlphabet) {
        return { status: false, message: "Username must contain at least one lowercase alphabet." };
    }

    if (username.length < 3) {
        return { status: false, message: "Username must be at least 3 characters long." };
    }
    if (username.length > 20) {
        return { status: false, message: "Username cannot be longer than 20 characters." };
    }

    return { status: true };
}



export function validateEmail(email) {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    if (!email) {
        return { status: false, message: "Please enter email." };
    }
    if(email.length>55){
        return { status: false, message: "Email cannot be longer than 55 characters." };
     
    }
    

    if (!emailRegex.test(email)) {
        return { status: false, message: "Invalid email format." };
    }
    
  
    const [localPart, domain] = email.split('@');
    
 
    if (localPart.startsWith('.') || localPart.endsWith('.')) {
        return { status: false, message: "Local part of the email cannot start or end with a dot." };
    }
    
 
    if (localPart.includes('..')) {
        return { status: false, message: "Local part of the email cannot contain consecutive dots." };
    }
    

    const domainParts = domain.split('.');
    if (domainParts.length < 2) {
        return { status: false, message: "Domain part must contain a dot." };
    }
    

    for (const part of domainParts) {
        if (!/^[a-zA-Z0-9-]+$/.test(part)) {
            return { status: false, message: `Invalid character in domain part: '${part}'.` };
        }
    }
    
 
    const tld = domainParts[domainParts.length - 1];
    if (tld.length < 2 || tld.length > 6) {
        return { status: false, message: "Invalid top-level domain (TLD)." };
    }
    
    return { status: true };
}


export function validatePassword(password) {
  
    const uppercaseRegex = /[A-Z]/;
    const lowercaseRegex = /[a-z]/;
    const numberRegex = /[0-9]/;
    const specialCharRegex = /[!@#$%^&*()-=_+{};':"\\|,.<>?/]/;

   
    if (password=='') {
        return { status: false, message: "Please enter password." };
    }
    if (password.length < 8 || password.length > 16) {
        return { status: false, message: "Password must be between 8 and 16 characters long." };
    }

    if (!uppercaseRegex.test(password[0])) {
        return { status: false, message: "Password must start with an uppercase letter." };
    }

    if (!lowercaseRegex.test(password) || !numberRegex.test(password) || !specialCharRegex.test(password)) {
        return { status: false, message: "Password must contain at least one lowercase letter, one number, and one special character." };
    }

    return { status: true, message: "Password is valid." };
}

export function closeModal(selector) {
    selector.style.display = 'none';
}

export function openModal(selector) {
    selector.style.display = 'block';
}
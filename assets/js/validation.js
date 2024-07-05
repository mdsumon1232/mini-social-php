const form = document.getElementById('form');
let messageBox = document.getElementById('messageBox');

form.addEventListener('submit' , e=>{
    e.preventDefault();
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value
    const password = document.getElementById('password').value;
    const confirm_password = document.getElementById('confirm_password').value;
    
    

    if(password.length <6){
    return messageBox.innerText = "password must 6 character ";
   }
   else{
    if(password === confirm_password){
    }
    else{
        messageBox.innerText = "password does not match";
    }
   }

})
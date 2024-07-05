let password = document.getElementById('password');
let confirm_password = document.getElementById('confirm_password');
let show = document.getElementById('show');
let hidden = document.getElementById('hidden');
let show_confirm = document.getElementById('show_con');
let hidden_confirm = document.getElementById('hidden_con');

password.addEventListener('focus' , ()=>{
    show.style = 'display:block'; 

})

confirm_password && confirm_password.addEventListener('focus' , ()=>{
    show_confirm.style='display:block';
})


show.addEventListener('click' ,  ()=>{
  show.style = 'display:none';
  hidden.style = 'display:block';
password.type = 'text';

})


hidden.addEventListener('click' ,  ()=>{
  hidden.style = 'display:none';
  show.style = 'display:block';
password.type = 'password';

})



show_confirm && show_confirm.addEventListener('click' ,  ()=>{
  show_confirm.style = 'display:none';
  hidden_confirm.style = 'display:block';
  confirm_password.type = 'text';

})


hidden_confirm && hidden_confirm.addEventListener('click' ,  ()=>{
  hidden_confirm.style = 'display:none';
  show_confirm.style = 'display:block';
confirm_password.type = 'password';

})
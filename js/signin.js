import { showPassword, hidePassword, login } from "./utils";
import { isStringMatchRegEx } from "./forms-validation";

const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

document.addEventListener("DOMContentLoaded", () => {
  const eyeIcon = document.querySelector(".eye-icon"); //show password icons
  const hidePasswordIcon = document.querySelector(".hide-password"); //hide password icons
  showPassword(eyeIcon); //show password
  hidePassword(hidePasswordIcon) //hide password
  const signinForm = document.getElementById('signin-form')
  const passwordInput = document.getElementById("password");
  const emailInput = document.getElementById('email');
  const alertDanger = document.querySelector('.alert-danger');
  signinForm.addEventListener('submit', async (e)=>{
    e.preventDefault()
    const email = emailInput.value;
    const password = passwordInput.value;
    try{
      const isAuthenticated = await login(email, password)
      const responseStatus = isAuthenticated.status;
      const messageResponse = isAuthenticated.message
      if (responseStatus === 'error') {
        alertDanger.style.display = 'block';
        alertDanger.querySelector('p').textContent = messageResponse;
        alertDanger.classList.add('alert-show');
      }else{
        window.location.href = `http://localhost/super-car/supercar/essai`;
      }
    }catch(e){
      console.error(e);
    }
  })
  //hide alert message 
  const alert = document.querySelector('.alert');
  setTimeout(() => {
    alert.style.display = 'none';
    alert.classList.remove('alert-show');
  }, 6800);

  //hide alert message
  document.querySelector('.close-alert-danger').addEventListener('click', function(){
      this.parentNode.style.display = 'none';
      this.parentNode.classList.remove('alert-show');
      })
});
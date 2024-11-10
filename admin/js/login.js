import { showPassword, hidePassword} from "../../js/utils";
import { login_admin } from "./utils";

document.addEventListener('DOMContentLoaded', ()=>{
  const eyeIcon = document.querySelector(".eye-icon"); //show password icons
  const hidePasswordIcon = document.querySelector(".hide-password"); //hide password icons
  const loginForm = document.querySelector(".login-form");
  const loginButton = document.querySelector(".btn-login");
  const loginInputemail = document.querySelector(".login-input-email");
  const loginPassword = document.querySelector(".passwordField");
  const alertSuccess = document.querySelector(".alert-success");
  const alertDanger = document.querySelector(".alert-danger");
  const action = 'login';
  const loginOverlay = document.querySelector('.overlay');
  const sipinner = document.querySelector('.spinner');
  function showAndHideSpinnerAndOverlay(){
    sipinner.classList.toggle('d-none');
    loginOverlay.classList.toggle('d-none');
  }
  showPassword(eyeIcon); //show password
  hidePassword(hidePasswordIcon) //hide password
  loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = loginInputemail.value;
    const password = loginPassword.value;
    // Show the spinner
    showAndHideSpinnerAndOverlay();
    try {
        const isAuthenticated = await login_admin(email, password);
        const responseStatus = isAuthenticated.status;
        const messageResponse = isAuthenticated.message;
        setTimeout(() => {
            // Hide the spinner
            showAndHideSpinnerAndOverlay();
            if (responseStatus === 'error') {
                // Display error alert
                alertDanger.textContent = messageResponse;
                alertDanger.classList.remove('d-none'); // Show the error alert
                alertSuccess.classList.add('d-none');  // Hide the success alert
            } else {
                // Hide error alert and display success alert
                alertDanger.classList.add('d-none');
                alertSuccess.textContent = messageResponse;
                alertSuccess.classList.remove('d-none'); // Show the success alert
                setTimeout(() => {
                    alertSuccess.classList.add('d-none'); // Hide the success alert
                    window.location.href = `http://localhost/super-car/admin`;
                }, 2000);
            }
        }, 3000);

    } catch (error) {
        console.error("Authentication error:", error);
        // Hide the spinner in case of error
        showAndHideSpinnerAndOverlay();
        alertDanger.textContent = "An error occurred. Please try again.";
        alertDanger.classList.remove('d-none'); // Show the error alert
    }
  });

})
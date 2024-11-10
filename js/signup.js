import { showPassword, hidePassword, createUser, resetForm } from "./utils";

import {
  isStringLengthGreaterThan,
  isStringMatchRegEx,
  controlField,
  fullNameAndAdressValid,
  passwordsFieldValid,
} from "./forms-validation";

const regexPasswordMedium = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\s])(?=.{8,12}$)/;
const regexStrongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\s]).{13,}$/;
const regexBlacklist = /[\*\=\'\"\-\/\\\,]/;
const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const regexPhoneNumber =
  /^(?:\+|00|0)[1-9]\d{0,2}\s?(\d{1,4}\s?[\d\s\-]{5,14}|\(\d{1,4}\)\s?[\d\s\-]{5,14})$/;

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("signupForm");
  const firstNameInput = document.getElementById("firstName");
  const lastNameInput = document.getElementById("lastName");
  const addressInput = document.getElementById("address");
  const fullNameAndAdress = [firstNameInput, lastNameInput, addressInput];
  const phoneInput = document.getElementById("phone");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const passwordConfirmInput = document.getElementById("confirmPassword");
  const passwordInputsFields = [passwordInput, passwordConfirmInput];
  const readOnlyFirstName = document.getElementById("readonly-firstName");
  const readOnlyLastName = document.getElementById("readonly-lastName");
  const readOnlyAddress = document.getElementById("readonly-address");
  const readOnlyPhone = document.getElementById("readonly-phone");
  const readOnlyEmail = document.getElementById("readonly-email");
  const submitSignupFormButton = document.getElementById("submitSignup");
  const passwordsMessageText = document.querySelector(".passwordMessage");
  const validationMessage = document.querySelector(".validation-message");
  const action = 'create'
  const allInputs = form.querySelectorAll("input");
  const alertSuccess = document.querySelector('.alert-success');
  const alertDanger = document.querySelector('.alert-danger');
  
  function allFiledsValid() {
    return (
      isStringMatchRegEx(regexEmail, emailInput.value) &&
      isStringMatchRegEx(regexPhoneNumber, phoneInput.value) &&
      fullNameAndAdressValid(fullNameAndAdress) &&
      passwordsFieldValid(passwordInputsFields)
    );
  }
  // disabled the signup button while at least on of the fields is not field or is not valid
  submitSignupFormButton.disabled = !allFiledsValid();
  // check if all field are filled and are valid
  allInputs.forEach((input) => {
    input.addEventListener("input", (e) => {
      submitSignupFormButton.disabled = !allFiledsValid();
      if (allFiledsValid()) {
        validationMessage.textContent = "Tous les sont correctement remplis";
        validationMessage.classList.remove("text-danger");
        validationMessage.classList.add("text-success");
      } else {
        validationMessage.textContent =
          "Le bouton d'inscription restera désactivé jusqu'à ce que tous les champs soient correctement remplis";
        validationMessage.classList.remove("text-success");
        validationMessage.classList.add("text-danger");
      }
    });
  });

  //script for intelinput
  window.intlTelInput(phoneInput, {
    utilsScript:
      "https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/js/utils.js",
  });

  //show and hide password
  const eyeIcons = document.querySelectorAll(".eye-icon"); //show password icons
  const hidePasswordIcons = document.querySelectorAll(".hide-password"); //hide password icons
  eyeIcons.forEach((eyeIcon) => showPassword(eyeIcon)); //show password
  hidePasswordIcons.forEach((hidePasswordIcon) =>
    hidePassword(hidePasswordIcon)
  ); //hide password

  //populate the readOnly inputs of the firstModal with form data
  submitSignupFormButton.addEventListener("click", function () {
    const first_name = firstNameInput.value;
    const last_name = lastNameInput.value;
    const address = addressInput.value;
    const phone = phoneInput.value;
    const email = emailInput.value;
    readOnlyFirstName.setAttribute("value", first_name);
    readOnlyLastName.setAttribute("value", last_name);
    readOnlyAddress.setAttribute("value", address);
    readOnlyEmail.setAttribute("value", phone);
    readOnlyPhone.setAttribute("value", email);
  });

  //check the length of firstName field, lastName field and address
  fullNameAndAdress.forEach((input) => {
    input.addEventListener("input", function () {
      const minLength = parseInt(input.getAttribute("data-minLength"), 10);
      if (!isStringLengthGreaterThan(input.value, minLength)) {
        input.style.outline = "solid 2px red";
        input.nextElementSibling.style.display = "block";
      } else {
        input.style.outline = "solid 2px #09CD1C";
        input.nextElementSibling.style.display = "none";
      }
    });
  });

  //check if phone field is valid
  phoneInput.addEventListener("input", () => {
    if (isStringMatchRegEx(regexPhoneNumber, phoneInput.value)) {
      phoneInput.style.outline = "solid 2px #09CD1C";
      document.querySelector(".error").style.display = "none";
    } else {
      phoneInput.style.outline = "solid 2px red";
      document.querySelector(".error").style.display = "block";
    }
  });

  //check if email field is valid
  emailInput.addEventListener("input", () => {
    if (isStringMatchRegEx(regexEmail, emailInput.value)) {
      emailInput.style.outline = "solid 2px #09CD1C";
      emailInput.nextElementSibling.style.display = "none";
    } else {
      emailInput.style.outline = "solid 2px red";
      emailInput.nextElementSibling.style.display = "block";
    }
  });

  //check if password field is valid
  passwordInput.addEventListener("input", function () {
    //password contains prohibited characters
    if (isStringMatchRegEx(regexBlacklist, passwordInput.value)) {
      const message = 'caractères interdits: *, /, \\, =, ", -,  ,';
      controlField(
        passwordInput,
        "block",
        passwordsMessageText,
        message,
        "red",
        "solid 2px red"
      );
    } else {
      passwordsMessageText.textContent = "";
      //password length is less tha 8 characters
      if (
        passwordInput.value.trim().length > 0 &&
        !isStringLengthGreaterThan(passwordInput.value, 5)
      ) {
        const message =
          "Votre mot de passe n'est pas acceptable. choisissez un mot de passe d'au moin 5 caractères";
        controlField(
          passwordInput,
          "block",
          passwordsMessageText,
          message,
          "red",
          "solid 3px red"
        );
      } else if (
        isStringLengthGreaterThan(passwordInput.value, 5) &&
        !isStringLengthGreaterThan(passwordInput.value, 8)
      ) {
        //password length is between 5 and 7
        const message =
          "Votre mot de passe est très vulnérable. ignorez ce message si vous voulez continuer a utiliser ce mot de passe";
        controlField(
          passwordInput,
          "block",
          passwordsMessageText,
          message,
          "#fd7e14",
          "solid 3px #fd7e14"
        );
      } else {
        const message =
          "pour un mot de passe fort, minimum: 8 caractères, 1 lettre majuscule, 1 lettre miniscule, un chiffre, 1 caractère spéciale";
        controlField(
          passwordInput,
          "block",
          passwordsMessageText,
          message,
          "black"
        );
        //password contains al least 8 characters and a maximum of 12 characters with the least 1 capital letter, 1 on lowercase letter, a number and special char
        if (
          passwordInput.value.trim().length > 0 &&
          isStringMatchRegEx(regexPasswordMedium, passwordInput.value)
        ) {
          const message = "votre mot de passe est fort";
          controlField(
            passwordInput,
            "block",
            passwordsMessageText,
            message,
            "#0d6efd",
            "solid 3px #0d6efd"
          );
        } else if (
          //password contains al least 13 with the least 1 capital letter, 1 on lowercase letter, a number and special char
          passwordInput.value.trim().length > 0 &&
          isStringMatchRegEx(regexStrongPassword, passwordInput.value)
        ) {
          const message = "votre mot de passe est très fort";
          controlField(
            passwordInput,
            "block",
            passwordsMessageText,
            message,
            "#28a745",
            "solid 3px #28a745"
          );
        } else if (
          //password length is greather or equal to 8 characters but doesn't contain capital and lowercase letter(s), on number, and one special char
          passwordInput.value.trim().length > 0 &&
          passwordInput.value.trim().length >= 8
        ) {
          const message =
            "votre mot de passe est assez long mais pas très complexe";
          controlField(
            passwordInput,
            "block",
            passwordsMessageText,
            message,
            "#D7CE00",
            "solid 3px #D7CE00"
          );
        }
      }
    }
  });

  //handle password confirm
  passwordConfirmInput.addEventListener("input", function () {
    passwordsMessageText.textContent =
      "les deux mot de passe doivent être identiques";
    if (isStringMatchRegEx(regexBlacklist, passwordConfirmInput.value)) {
      passwordsMessageText.style.color = "red";
      passwordsMessageText.textContent =
        'caractères interdits: *, /, \\, =, ", -,  ,';
      passwordConfirmInput.style.outline = "solid 2px red";
    } else {
      passwordsMessageText.style.color = "black";
      passwordConfirmInput.style.outline = "none";
      if (isStringLengthGreaterThan(passwordInput.value, 1) && 
      isStringLengthGreaterThan(passwordConfirmInput.value, 1) && 
      passwordInput.value.trim() === passwordConfirmInput.value.trim()) {
        passwordsMessageText.textContent =
          "Les deux mot de passe sont identiques";
        passwordsMessageText.style.color = "#28a745";
      }
    }
  });

  // Handle review confirmation
  document
    .getElementById("confirmReviewButton")
    .addEventListener("click", function () {
      // Close the first modal
      const reviewModal = bootstrap.Modal.getInstance(
        document.getElementById("reviewModal")
      );
      reviewModal.hide();
      // Wait for the first modal to finish closing before opening the second one
      document.getElementById("reviewModal").addEventListener(
        "hidden.bs.modal",
        function () {
          const consentModal = new bootstrap.Modal(
            document.getElementById("consentModal")
          );
          consentModal.show();
        },
        { once: true }
      );
    });

  // Enable the final confirm button only if the consent checkbox is checked
  document
    .getElementById("consentCheckbox")
    .addEventListener("change", function () {
      document.getElementById("finalConfirmButton").disabled = !this.checked;
    });

  // Handle final confirmation
  document
    .getElementById("finalConfirmButton")
    .addEventListener("click", async function () {
      // Close the second modal
      const consentModal = bootstrap.Modal.getInstance(
        document.getElementById("consentModal")
      );
      consentModal.hide();
      //user date
      const userData = [
        firstNameInput.value,
        lastNameInput.value,
        addressInput.value,
        phoneInput.value,
        emailInput.value,
        passwordInput.value,
        action,
      ];
      try{
        const createUserResponse = await createUser(...userData)
        const responseStatus = createUserResponse.status;
        const messageResponse = createUserResponse.message
        if (responseStatus === 'error') {
          alertDanger.style.display = 'block';
          alertDanger.querySelector('p').textContent = messageResponse;
          alertDanger.classList.add('alert-show');
        }else if(responseStatus === 'success'){
          alertSuccess.style.display = 'block';
          alertSuccess.querySelector('p').textContent = messageResponse;
          alertSuccess.classList.add('alert-show');
        }
      }catch(e){
        console.error(e);
      }

      //hide alert message 
      document.querySelectorAll('.alert').forEach((alert)=>{
        setTimeout(() => {
          alert.style.display = 'none';
          alert.classList.remove('alert-show');
          }, 6800);
      })

      //hide alert message
      document.querySelectorAll('.close-alert-success, .close-alert-danger').forEach((svg)=>{
        svg.addEventListener('click', function(){
          this.parentNode.style.display = 'none';
          this.parentNode.classList.remove('alert-show');
          })
      })
      // reset signup form
      resetForm(
        firstNameInput,
        lastNameInput,
        addressInput,
        phoneInput,
        emailInput,
        passwordInput,
        passwordConfirmInput
      );
      validationMessage.textContent =
        "Le bouton d'inscription restera désactivé jusqu'à ce que tous les champs soient correctement remplis";
      validationMessage.style.color = "red";
      passwordsMessageText.textContent =
        "pour un mot de passe fort, minimum: 8 caractères, 1 lettre majuscule, 1 lettre miniscule, un chiffre, 1 caractère spéciale";
      validationMessage.style.color = "black";
    });
});

// Description: javascript used to check form validation on login page


"use strict";

// This block will run when the DOM is loaded (once elements exist)
window.addEventListener("DOMContentLoaded", () => {

  //check all the submit form (general selector, since there are some repeat processes )
  const SubmitForm = document.querySelector("#submit");

  //add event listens for submit 
  SubmitForm.addEventListener("click", (ev) => {


    // get the user name input, and the user name error message
    const userNameInput = document.querySelector("#username");
    //this constant is only for checking error message for login page
    const userNameErrorMessage = document.querySelector("#userError3");

    // get the password input, and the password error message
    const passInput = document.querySelector("#password");
    const passError = document.querySelector("#passError");


    //declare a boolean flag valid here
    let valid = true;

    //check username is empty or not 
    if (userNameInput.value == "" || userNameInput.value == null) {
      userNameErrorMessage.classList.remove("hidden");
      valid = false;
    } else {
      userNameErrorMessage.classList.add("hidden");
    }

    //check password is empty or not 
    if (passInput.value == "" || passInput.value == null) {
      passError.classList.remove("hidden");
      valid = false;
    } else {
      passError.classList.add("hidden");
    }


    // STOP FORM SUBMISSION IF THERE ARE ERRORS
    if (valid == false) {

      ev.preventDefault();

    }
  });
});
// Description: javascript used to check form validation on personal info page 
// for submitting new password or new email


"use strict";


// This block will run when the DOM is loaded (once elements exist)
window.addEventListener("DOMContentLoaded", () => {



  // checking for email validation
  const emailIsValid = (string) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(string);

  //check all the submit form (general selector, since there are some repeat processes )
  const SubmitForm = document.querySelector("#submit");

  //add event listens for submit 
  SubmitForm.addEventListener("click", (ev) => {


    // get the email input, and the email error message
    const emailInput = document.querySelector("#email");
    const emailError = document.querySelector("#emailError"); 

    //declare a boolean flag valid here
    let valid = true;

    //  check email if valid and handle appropriately
    // and check if email is empty ||
    if (emailInput.value != "") {
      if (emailIsValid(emailInput.value)) {
        emailError.classList.add("hidden");

      } else {
        emailError.classList.remove("hidden");
        valid = false;
      }


    }

    // STOP FORM SUBMISSION IF THERE ARE ERRORS
    if (valid == false) {

      ev.preventDefault();

    }
  });
});
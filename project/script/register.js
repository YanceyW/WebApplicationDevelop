// Description: javascript used to verify that the username is unique 
// and also check form validation on register page 


"use strict";

// This block will run when the DOM is loaded (once elements exist)
window.addEventListener("DOMContentLoaded", () => {

  //verify the username is unique when focus is lost on the textbox
  const userNameErrorMessage = document.querySelector("#userError2");
  // check if the username is unique
  $('#username').on('blur', function () {
    var username = $('#username').val();
    $.ajax({

      url: 'check_user.php',
      type: 'Get',
      // datatype: 'json', 
      data: {
        'username': username
      },
      success: function (response) {
        console.log(response);
        //if got error print the message 
        if (response === "0") {
        console.log("doesn't exist");

          //   userNameErrorMessage.classList.add("hidden");
          userNameErrorMessage.classList.add("hidden");
        } else {
          userNameErrorMessage.classList.remove("hidden");
        }
      }
    });
  });


  // -----------------------------------------------------------------------------------------------------------------//
  // -----------------------------------------------------------------------------------------------------------------//


  // checking for email validation
  const emailIsValid = (string) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(string);

  //check all the submit form (general selector, since there are some repeat processes )
  const SubmitForm = document.querySelector("#submit");
  const noUserNameErrorMessage = document.querySelector("#userError3");


  //add event listens for submit 
  SubmitForm.addEventListener("click", (ev) => {


    // get the email input, and the email error message
    const emailInput = document.querySelector("#email");
    const emailError = document.querySelector("#emailError"); 

    // get the user name input, and the user name error message
    const userNameInput = document.querySelector("#username");

    // get the password input, and the password error message
    const passInput = document.querySelector("#password");
    const passError = document.querySelector("#passError");

    //declare a boolean flag valid here
    let valid = true;


    //check username is empty or not 
    if (userNameInput.value == "" || userNameInput.value == null) {
      noUserNameErrorMessage.classList.remove("hidden");
      valid = false;
    } else {
      noUserNameErrorMessage.classList.add("hidden");
    }


    //check password is empty or not 
    if (passInput.value == "" || passInput.value == null) {
      passError.classList.remove("hidden");
      valid = false;
    } else {
      passError.classList.add("hidden");
    }

    // check email if valid and handle appropriately
    if (emailIsValid(emailInput.value)) {
      emailError.classList.add("hidden");

    } else {
      emailError.classList.remove("hidden");
      valid = false;
    }

    // STOP FORM SUBMISSION IF THERE ARE ERRORS
    if (valid == false) {

      ev.preventDefault();

    }
  });
});
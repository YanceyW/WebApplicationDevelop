// Description: javascript used to delete an account and delete all corresponding information associated with the account
// a confirmation dialog with the option to cancel is provided


"use strict";


// This block will run when the DOM is loaded (once elements exist)
window.addEventListener("DOMContentLoaded", () => {

    //get the delete button
    const deleteButton = document.querySelector("#delete");

    // delete account information
    deleteButton.addEventListener("click", (ev) => {
        //show the chart
        var x = confirm("Are you sure?");
        if (x == true) {

            const delete_user = new XMLHttpRequest();

            delete_user.open("GET", "delete_user.php");

            delete_user.addEventListener("load", (ev) => {
                //if success change to login page
                if (delete_user.status == 200) {
                    window.location.href = "login.php";
                } else {
                    //error 
                    console.log(`error : ${delete_user.status}`);
                }

            })
            delete_user.send();
        }

        ev.preventDefault();
    });

});
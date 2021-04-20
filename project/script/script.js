// Description: javascript used to display a recipe on a pop-up modal window
// and option of edit, delete, copy and create a recipe


"use strict";

// This block will run when the DOM is loaded (once elements exist)
window.addEventListener("DOMContentLoaded", () => {

    const recipes = document.querySelectorAll(".recipe");
    const recipe_modal = document.getElementById("recipe_modal");
    const close_modal = document.querySelector(".close-button");
    const recipe_content = document.querySelector(".modal-content");

    const create_new_button = document.querySelector("button[name='go_to_create_new']");
    const edit_button = document.querySelector("button[name='edit']");
    const delete_button = document.querySelector("button[name='delete']");
    const copy_button = document.querySelector("button[name='copy']");

    var recipe_id;
    // viewing a specific recipe on modal window
    for (const recipe of recipes) {
        recipe.addEventListener("click", (ev) => {

            recipe_id = parseInt(recipe.name);
            //instantiate new XHR object
            const xhr = new XMLHttpRequest();
            //use xhr to open get connection to recipe.php
            xhr.open("GET", "recipe.php?recipe_id="+recipe_id);
            //attach load event to xhr
            xhr.addEventListener("load", (ev) => {
                // console.log(xhr);
                //if success
                if (xhr.status == 200) {
                    var recipe_info = JSON.parse(xhr.responseText);

                    var tags = '<p>tag: '+recipe_info.tags+'</p>';
                    var if_private = '';
                    var rating = '<p id="rating"><jsuites-rating value="'+recipe_info.rating+'"></jsuites-rating></p>';
                    var prep_time = '';
                    var cook_time = '';
                    var image = '<img src="/~claireli/www_data/recipe_images/'+recipe_info.image_filename+'" alt="" height="400" width="100%">';
                    // check tags
                    if (recipe_info.tags === ''){
                        tags = '';
                    }
                    // check private
                    if (recipe_info.private === 'Y'){
                        if_private = '<p>private</p>';
                    } else {
                        if_private = '<p>public</p>';
                    }
                    // check prepare time
                    if (recipe_info.prep_hour !== 0){
                        prep_time += recipe_info.prep_hour+'h ';
                    }
                    if (recipe_info.prep_min !== 0){
                        prep_time += recipe_info.prep_min+'min';
                    }
                    // check cook time
                    if (recipe_info.cook_hour !== 0){
                        cook_time += recipe_info.cook_hour+'h ';
                    }
                    if (recipe_info.cook_min !== 0){
                        cook_time += recipe_info.cook_min+'min';
                    }
                    // check image    
                    if (recipe_info.image_filename === ''){
                        image = '';
                    }

                    recipe_content.innerHTML = 
                    '<div class="recipe_title">'+
                        '<h1>'+recipe_info.title+'</h1>'+
                        '<h2>By '+recipe_info.username+'</h2>'+
                        '<div class="recipe_info">'+
                            tags+if_private+rating+
                        '</div>'+
                    '</div>'+
                    '<div class="intro">'+
                        '<div>'+
                            '<span>Servings</span>'+
                            '<span class="intro_detail">'+recipe_info.serving+'</span>'+
                        '</div>'+
                        '<div>'+
                            '<span>Difficulty</span>'+
                            '<span class="intro_detail">'+recipe_info.difficulty+'</span>'+
                        '</div>'+
                        '<div>'+
                            '<span>Prep time</span>'+
                            '<span class="intro_detail">'+prep_time+'</span>'+
                        '</div>'+
                        '<div>'+
                            '<span>Cook time</span>'+
                            '<span class="intro_detail">'+cook_time+'</span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="ingredient">'+
                        '<h2>Ingredients</h2>'+
                        '<p>'+recipe_info.recipe_ingredients+'</p>'+
                    '</div>'+
                    '<div class="directions">'+
                        '<h2>Directions</h2>'+
                        '<p>'+recipe_info.recipe_directions+'</p>'+
                    '</div>'+ image;

                    // if the recipe is not written by the user, the user cannot edit or delete, but can only copy the recipe.
                    if (recipe_info.author_id != recipe_info.current_user_id){
                        // hide buttons
                        edit_button.classList.add("hidden");
                        delete_button.style.display = 'none';
                        // show users that they can rate
                        const rate_box = document.querySelector("#rating");
                        rate_box.innerHTML = 'you can rate: <jsuites-rating value="'+recipe_info.rating+'"></jsuites-rating>';
                        // update rate
                        document.querySelector('jsuites-rating').addEventListener('onchange', function (e) {
                            const rate_recipe = new XMLHttpRequest();
                            //use xhr to open get connection to recipe.php
                            rate_recipe.open("GET", "rate_recipe.php?recipe_id=" + recipe_id + "&new_rate="+this.value+ "&rating="+recipe_info.rating+ "&num_rating="+recipe_info.num_rating);
                            //attach load event to xhr
                            rate_recipe.addEventListener("load", (ev) => {
                                if (rate_recipe.status == 200) {
                                    console.log(rate_recipe);
                                    console.log("rate successful!");
                                } else {
                                    console.log(`error: ${rate_recipe.status}`);
                                }
                            });
                            rate_recipe.send();
                        });
                    }else {
                        document.querySelector('jsuites-rating').addEventListener('onchange', function(e) {
                            console.log("you cannot rate yourself");
                        });
                        edit_button.classList.remove("hidden");
                        delete_button.style.display = 'inline';
                    }
                    // display recipe modal
                    recipe_modal.style.display = "block";

                }else {
                    console.log(`error: ${xhr.status}`);
                }
            });
            xhr.send();
    
        });
    }

    // close button on modal window
    close_modal.onclick = function () {
        recipe_modal.style.display = "none";
    }
    // close the modal when user clicks anywhere outside of the modal
    window.onclick = function (ev) {
        if (ev.target == recipe_modal) {
            recipe_modal.style.display = "none";
        }
    }


    // edit a recipe
    edit_button.addEventListener("click", (ev) => {
        window.location.href = "edit_recipe.php";    
    });

    
    // delete a recipe
    delete_button.addEventListener("click", (ev) => {
        // show a conformation dialog before delete
        var if_delete = confirm("Are you sure you want to delete this recipe?");
        if (if_delete == true) {
            //instantiate new XHR object
            const delete_recipe = new XMLHttpRequest();
            //use xhr to open get connection to recipe.php
            delete_recipe.open("GET", "delete_recipe.php?recipe_id="+recipe_id);
            //attach load event to xhr
            delete_recipe.addEventListener("load", (ev) => {
                if (delete_recipe.status == 200) {
                    location.reload();
                } else {
                    console.log(`error: ${delete_recipe.status}`);
                }
            });
            delete_recipe.send();
        } 
    });

    // copy a recipe
    copy_button.addEventListener("click", (ev) => {
        window.location.href = "edit_recipe.php";

    });

     // create a new recipe
     create_new_button.addEventListener("click", (ev) => {
        window.location.href = "create_recipe.php";    
    });

    


}); //this is the close of DOMContentLoaded everything should be inside it.
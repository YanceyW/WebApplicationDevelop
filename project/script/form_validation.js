// Description: javascript used to check form validation on create_recipe page and edit_recipe page 
// for create, save, copy_create option

"use strict";


    const form = document.querySelector("#form");

    form.addEventListener("submit", (ev) => {
        const title = document.querySelector('input[name="title"]');
        const titleError = document.querySelector('#titleError');
       
        const serving = document.querySelector('input[name="serving"]');
        const servingError = document.querySelector('#servingError');
        
        const difficulty = document.querySelector('input[name="difficulty"]');
        const difficultyError = document.querySelector('#difficultyError');
        
        const prep_hour = document.querySelector('input[name="prep_hour"]');
        const prep_min = document.querySelector('input[name="prep_min"]');
        const prep_timeError = document.querySelector('#prep_timeError');
        
        const cook_hour = document.querySelector('input[name="cook_hour"]');
        const cook_min = document.querySelector('input[name="cook_min"]');
        const cook_timeError = document.querySelector('#cook_timeError');
        
        const ingredient = document.querySelector('textarea[name="recipe_ingredients"]');
        const ingredientError = document.querySelector('#ingredientError');
        
        const directions = document.querySelector('textarea[name="recipe_directions"]');
        const directionsError = document.querySelector('#directionsError');
        

        var valid = true;

        // check if title is empty
        if (title.value === '') {
            valid = false;
            titleError.classList.remove("hidden");
        }else {
            titleError.classList.add("hidden");
        }
        // check if serving is empty
        if (serving.value === '') {
            valid = false;
            servingError.classList.remove("hidden");
        }else {
            servingError.classList.add("hidden");
        }
        // check if difficulty level is empty
        if (difficulty.value === '') {
            valid = false;
            difficultyError.classList.remove("hidden");
        }else {
            difficultyError.classList.add("hidden");
        }
        // check if preparing time is empty
        if (prep_hour.value === '' && prep_min.value === '') {
            valid = false;
            prep_timeError.classList.remove("hidden");
        }else {
            prep_timeError.classList.add("hidden");
        }
        // check if cook time is empty
        if (cook_hour.value === '' && cook_min.value === '') {
            valid = false;
            cook_timeError.classList.remove("hidden");
        }else {
            cook_timeError.classList.add("hidden");
        }

        // check if ingredient is empty
        if (ingredient.value === '') {
            valid = false;
            ingredientError.classList.remove("hidden");
        }else {
            ingredientError.classList.add("hidden");
        }

        // check if directions is empty
        if (directions.value === '') {
            valid = false;
            directionsError.classList.remove("hidden");
        }else {
            directionsError.classList.add("hidden");
        }

    
        if (!valid) {
            ev.preventDefault();
        }

    });

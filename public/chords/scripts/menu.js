//all of the query selectors that can be referenced
const underlines = document.querySelector(".underlines");
const header = document.querySelector("header");
const xLineTop = document.getElementById("line__top");
const xLineBottom = document.getElementById("line__bottom");

menuStatus = 0;
//menu toggle

underlines.addEventListener("click", () => {
    //if menu is closed do the following
    if(menuStatus == 0){
        //add the active class to parent
        header.classList.add("active");
        //animate x
        xLineTop.classList.remove("reverse__menu__underscore--animation--x");
        xLineBottom.classList.remove("reverse__menu__underscore--animation--rx");
        //reflect menu status
        menuStatus = 1;
    }
    //if menu is open
    else if(menuStatus == 1){
        //remove parent class
        header.classList.remove("active");
        //animate hamburger menu
        xLineTop.classList.add("reverse__menu__underscore--animation--x");
        xLineBottom.classList.add("reverse__menu__underscore--animation--rx");
        //reflect menu status
        menuStatus = 0;
    }
})


function dropDownIconChange() { 
    $(".dropdown-toggle i").toggleClass("fa-bars fa-caret-down");
} 

function openLoginForm(){
    document.body.classList.add("showPopUp");
  }
  function closeLoginForm(){
    document.body.classList.remove("showPopUp");
  }


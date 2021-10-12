function dropDownIconChange() {
  $(".dropdown-toggle i").toggleClass("fa-bars fa-caret-down");
}

//the pop up for patient sign up (OPEN)
function openPatientSignUpForm() {
  document.body.classList.add("showPopUp-patient-sign-up");
}

//the pop up for patient sign up  (CLOSE)
function closePatientSignUpForm() {
  document.body.classList.remove("showPopUp-patient-sign-up");
}

//the pop up for administrator sign up  (OPEN)
function openAdminSignUpForm() {
  document.body.classList.add("showPopUp-admin-sign-up");
}

//close the pop up for administrator sign up (CLOSE)
function closeAdminSignUpForm() {
  document.body.classList.remove("showPopUp-admin-sign-up");
}

//the pop up for administrator to record new vaccine (OPEN)
function openPopUp() {
  document.body.classList.add("showPopUp");
}

//the pop up for administrator to record new vaccine (CLOSE)
function closePopUp() {
  document.body.classList.remove("showPopUp");
}

//requestvaccineappointment.html
//the pop up for request vaccine (show centre name) (OPEN)
function openPopUpRequestVaccine1() {
  document.body.classList.add("showPopUp-requestvaccine-centre");
}

//requestvaccineappointment.html
//the pop up for request vaccine (show centre name) (CLOSE)
function closePopUpRequestVaccine1() {
  document.body.classList.remove("showPopUp-requestvaccine-centre");
}

//requestvaccineappointment.html
//the confrim button after user select the date (quit pop up and show details outside pop up)
function confirmAppointment() {}

//requestvaccineappointment.html
//hiding and showing the Batch No table
function showBatchTable() {
  var x = document.getElementById("BatchNo-table");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

//requestvaccineappointment.html
//hiding and showing the calender for appointment date
function showCalender() {
  var x = document.getElementById("AppointmentDate");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

//havent done this
//open the centre name and show name and address in sign up
function openCentreName() {
  document.body.classList.add("showPopUp-centre-name");
}

function closeCentreName() {
  document.body.classList.close("showPopUp-centre-name");
}


// Popup for view vaccine batch info
function openManageVaccination(){
  document.body.classList.add("showPopUp-manage-vaccination");
}

function closeManageVaccination(){
  document.body.classList.remove("showPopUp-manage-vaccination");
}

// Login validation

const loginForm = document.getElementById("form");
const username = document.getElementById("username");
const password = document.getElementById("password");

loginForm.addEventListener("submit", (e) => {
  e.preventDefault();
  checkLoginDetails();
});

function checkLoginDetails() {
  usernameValue = username.value.trim();
  passwordValue = password.value.trim();


  if (usernameValue === '') {
    setErrorFor(username, "Username cannot be blank");
  }

  if (passwordValue === '') {
    setErrorFor(password, "Password cannot be blank");
  }


  if (usernameValue !== "abc" || passwordValue !=="123") {
    setErrorFor(username, "User hasn't been registered");
    setErrorFor(password, "User hasn't been registered");

  } else {
    setSuccessFor(username);
    setSuccessFor(password);
    location.href = "AdminMenu.html";
  }

  if (usernameValue !== "def" || passwordValue !=="456") {
    setErrorFor(username, "User hasn't been registered");
    setErrorFor(password, "User hasn't been registered");

  } else {
    setSuccessFor(username);
    setSuccessFor(password);
    location.href = "PatientMenu.html";
  }

}

function setErrorFor(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector("small");
  formControl.className = "form-control error";
  small.innerText = message;
}

function setSuccessFor(input) {
  const formControl = input.parentElement;
  formControl.className = "form-control success";
}

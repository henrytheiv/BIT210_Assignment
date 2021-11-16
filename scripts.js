function dropDownIconChange() {
  $(".dropdown-toggle i").toggleClass("fa-bars fa-caret-down");
}

function signIn() {
  var form_element = document.getElementsByClassName("form_data");

  var form_data = new FormData();

  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }

  document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();

  ajax_request.open("POST", "http://localhost/DAHVAX/DahVax/public/form-validation/signin_validation.php");

  ajax_request.send(form_data);

  ajax_request.onreadystatechange = function () {
    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
      document.getElementById("submit").disabled = false;
      var response = JSON.parse(ajax_request.responseText);

      $usernameInput = document.getElementById("username");
      $passwordInput = document.getElementById("password");

      if (response.success != "") {
        if (response.success == "successPatient") {
          location.href = "PatientMenu.php";
        } else {
          location.href = "AdminMenu.php";
        }
      } else {
        if (response.wrong_username == "blankUsername") {
          setErrorFor($usernameInput, "Username cannot be blank");
        } else if (response.wrong_username == "invalidUsername") {
          setErrorFor($usernameInput, "Invalid username");
        } else {
          setSuccessFor($usernameInput);
        }

        if (response.wrong_password == "blankPassword") {
          setErrorFor($passwordInput, "Password cannot be blank");
        } else if (response.wrong_password == "invalidPassword") {
          setErrorFor($passwordInput, "Invalid password");
        } else {
          setSuccessFor($passwordInput);
        }
      }
    }
  };
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

//the pop up for administrator to record new vaccine (CLOSE)
function closePopUp() {
  document.body.classList.remove("showPopUp");
}

//requestvaccineappointment.html
//the pop up for request vaccine (show centre name) (OPEN)
function openPopUpRequestVaccination() {
  document.body.classList.add("showPopUp-requestvaccination-centre");
}

//requestvaccineappointment.html
//the pop up for request vaccine (show centre name) (CLOSE)
function closePopUpRequestVaccination() {
  document.body.classList.remove("showPopUp-requestvaccination-centre");
}

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

//open the centre name and show name and address in sign up
function openCentreName() {
  document.body.classList.add("showPopUp-centre-name");
}

function closeCentreName() {
  document.body.classList.close("showPopUp-centre-name");
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

function patientSignUpValidation() {
  var patientSignUpForm = document.getElementById("patient-sign-up-form");
  var patientUsername = document.getElementById("patientUsername");
  var patientPassword = document.getElementById("patientPassword");
  var patientFullname = document.getElementById("patientFullname");
  var patientEmail = document.getElementById("patientEmail");
  var patientIcpassport = document.getElementById("patientIcpassport");

  patientSignUpForm.addEventListener("submit", (e) => {
    e.preventDefault();
    checkPatientSignUpDetails();
  });
}

function checkPatientSignUpDetails() {
  patientUsernameValue = patientUsername.value.trim();
  patientPasswordValue = patientPassword.value.trim();
  patientFullnameValue = patientFullname.value.trim();
  patientEmailValue = patientEmail.value.trim();
  patientIcpassportValue = patientIcpassport.value.trim();

  //username
  if (patientUsernameValue === "") {
    setErrorFor(patientUsername, "Username cannot be empty");
  } else {
    setSuccessFor(patientUsername);
  }

  if (patientPasswordValue === "") {
    setErrorFor(patientPassword, "Password cannot be empty");
  } else {
    setSuccessFor(patientPassword);
  }

  if (patientFullnameValue === "") {
    setErrorFor(patientFullname, "Full name cannot be empty");
  } else {
    setSuccessFor(patientFullname);
  }

  if (patientEmailValue === "") {
    setErrorFor(patientEmail, "Email cannot be empty");
  } else {
    setSuccessFor(patientEmail);
  }

  if (patientIcpassportValue === "") {
    setErrorFor(patientIcpassport, "Passport No. cannot be empty");
  } else {
    setSuccessFor(patientIcpassport);
  }
}

//sign up validation for admin
function adminSignUpValidation() {
  var adminForm = document.getElementById("admin-sign-up-form");
  var adminUsername = document.getElementById("adminUsername");
  var adminPassword = document.getElementById("adminPassword");
  var adminFullname = document.getElementById("adminFullname");
  var adminEmail = document.getElementById("adminEmail");
  var adminStaffID = document.getElementById("adminStaffID");

  adminForm.addEventListener("submit", (e) => {
    e.preventDefault();

    adminUsernameValue = adminUsername.value.trim();
    adminPasswordValue = adminPassword.value.trim();
    adminFullnameValue = adminFullname.value.trim();
    adminEmailValue = adminEmail.value.trim();
    adminStaffIDValue = adminStaffID.value.trim();

    if (adminUsernameValue === "") {
      setErrorFor(adminUsername, "Username cannot be empty");
    } else {
      setSuccessFor(adminUsername);
    }

    if (adminPasswordValue === "") {
      setErrorFor(adminPassword, "Password cannot be empty");
    } else {
      setSuccessFor(adminPassword);
    }

    if (adminFullnameValue === "") {
      setErrorFor(adminFullname, "Full name cannot be empty");
    } else {
      setSuccessFor(adminFullname);
    }

    if (adminEmailValue === "") {
      setErrorFor(adminEmail, "Email cannot be empty");
    } else {
      setSuccessFor(adminEmail);
    }

    if (adminStaffIDValue === "") {
      setErrorFor(adminStaffID, "Staff ID cannot be empty");
    } else {
      setSuccessFor(adminStaffID);
    }
  });
}

//add new centre validation
function addCentreValidation() {
  var centreForm = document.getElementById("new-centre-form");
  var centreName = document.getElementById("centreName");
  var address = document.getElementById("address");

  centreForm.addEventListener("submit", (e) => {
    e.preventDefault();

    centreNameValue = centreName.value.trim();
    addressValue = address.value.trim();

    if (centreNameValue === "") {
      setErrorFor(centreName, "enter a centre name");
    } else {
      setSuccessFor(centreName);
    }

    if (addressValue === "") {
      setErrorFor(address, "enter an address for centre");
    } else {
      setSuccessFor(address);
    }
  });
}

//SignUp.html
//hiding and showing the details of centre
function centreDetails() {
  var x = document.getElementById("centreDetails");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

// SignUp.html
//the pop up for add new centre  (OPEN)
function openNewCentre() {
  document.body.classList.add("showPopUp-add-new-centre");
}

// SignUp.html
//the pop up for add new centre (CLOSE)
function closeNewCentre() {
  document.body.classList.remove("showPopUp-add-new-centre");
}

// SignUp.html
//the pop up for administrator sign up  (OPEN)
function openAdminSignUpForm() {
  document.body.classList.add("showPopUp-admin-sign-up");
}

// SignUp.html
//close the pop up for administrator sign up (CLOSE)
function closeAdminSignUpForm() {
  document.body.classList.remove("showPopUp-admin-sign-up");
}

function requestVaccinationAppointment() {
  alert("Requested successfully!");
  location.href = "PatientMenu.html";
}

function clearBatchCSS() {
  $batchNoInput = document.getElementById("batchNo");
  $expiryDateInput = document.getElementById("expiryDate");
  $quantityInput = document.getElementById("quantity");

  setSuccessFor($batchNoInput);
  setSuccessFor($expiryDateInput);
  setSuccessFor($quantityInput);
}

function validateBatch() {
  var form_element = document.getElementsByClassName("form_data");

  var form_data = new FormData();

  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }

  document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();

  ajax_request.open("POST", "form-validation/batch_validation.php");

  ajax_request.send(form_data);

  console.log(form_data);

  ajax_request.onreadystatechange = function () {
    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
      document.getElementById("submit").disabled = false;
      var response = JSON.parse(ajax_request.responseText);

      $batchNoInput = document.getElementById("batchNo");
      $expiryDateInput = document.getElementById("expiryDate");
      $quantityInput = document.getElementById("quantity");

      if (response.success != "") {
        document.getElementById("form").reset();
        alert("Recorded successfully!");
        location.href = "RecordNewVaccineBatch.php";
        setSuccessFor($batchNoInput);
        setSuccessFor($expiryDateInput);
        setSuccessFor($quantityInput);
      } else {
        if (response.wrong_batchNo == "blankBatchNo") {
          setErrorFor($batchNoInput, "Batch no. cannot be blank");
        } else if (response.wrong_batchNo == "usedBatchNo") {
          setErrorFor($batchNoInput, "Batch no. is used");
        } else {
          setSuccessFor($batchNoInput);
        }

        if (response.wrong_expiryDate == "blankExpiryDate") {
          setErrorFor($expiryDateInput, "Expiry date cannot be blank");
        } else if (response.wrong_expiryDate == "invalidExpiryDate") {
          setErrorFor($expiryDateInput, "Invalid expiry date");
        } else {
          setSuccessFor($expiryDateInput);
        }

        if (response.wrong_quantity == "blankQuantity") {
          setErrorFor($quantityInput, "Quantity available cannot be blank");
        } else if (response.wrong_quantity == "invalidQuantity") {
          setErrorFor($quantityInput, "Invalid quantity available");
        } else {
          setSuccessFor($quantityInput);
        }
      }
    }
  };
}

function validatePatient() {
  var form_element = document.getElementsByClassName("form_data");

  var form_data = new FormData();

  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }

  document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();

  ajax_request.open("POST", "http://localhost/DAHVAX/DahVax/public/form-validation/patient_validation.php");

  ajax_request.send(form_data);

  ajax_request.onreadystatechange = function () {
    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
      document.getElementById("submit").disabled = false;
      var response = JSON.parse(ajax_request.responseText);

      $patientUsernameInput = document.getElementById("patientUsername");
      $patientPasswordInput = document.getElementById("patientPassword");
      $patientEmailInput = document.getElementById("patientEmail");
      $patientFullnameInput = document.getElementById("patientFullname");
      $patientIcpassportInput = document.getElementById("patientIcpassport");

      if (response.success != "") {
        document.getElementById("patient-sign-up-form").reset();
        alert("Patient signed up successfully!");
        location.href = "index.php";
        setSuccessFor($patientUsernameInput);
        setSuccessFor($patientPasswordInput);
        setSuccessFor($patientEmailInput);
        setSuccessFor($patientFullnameInput);
        setSuccessFor($patientIcpassportInput);
      } else {
        if (response.wrong_patient_username == "blankPatientUsername") {
          setErrorFor(
            $patientUsernameInput,
            "Patient username cannot be blank"
          );
        } else if (response.wrong_patient_username == "usedPatientUsername") {
          setErrorFor($patientUsernameInput, "Patient username is used");
        } else {
          setSuccessFor($patientUsernameInput);
        }

        if (response.wrong_patient_password == "blankPatientPassword") {
          setErrorFor($patientPasswordInput, "Password cannot be blank");
        } else if (
          response.wrong_patient_password == "invalidPatientPassword"
        ) {
          setErrorFor(
            $patientPasswordInput,
            "Password must be at Least 6 characters in length and must contain at least one number, one upper case letter!"
          );
        } else {
          setSuccessFor($patientPasswordInput);
        }

        if (response.wrong_patient_email == "blankPatientEmail") {
          setErrorFor($patientEmailInput, "Email cannot be blank");
        } else {
          setSuccessFor($patientEmailInput);
        }

        if (response.wrong_patient_fullname == "blankPatientFullname") {
          setErrorFor($patientFullnameInput, "Full name cannot be blank");
        } else {
          setSuccessFor($patientFullnameInput);
        }

        if (response.wrong_patient_Icpassport == "blankPatientIcpassport") {
          setErrorFor(
            $patientIcpassportInput,
            "IC / Passport No. cannot be blank"
          );
        } else {
          setSuccessFor($patientIcpassportInput);
        }
      }
    }
  };
}

function inputRemarks() {
  var x = document.getElementById("enterRemark");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function updateToAdministered() {
  var form_element = document.getElementsByClassName("form_data");

  var form_data = new FormData();

  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }

  document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();

  ajax_request.open("POST", "form-validation/record_administered.php");

  ajax_request.send(form_data);

  ajax_request.onreadystatechange = function () {
    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
      document.getElementById("submit").disabled = false;

      alert("Updated successfully!");
      location.href = "ViewVaccineBatchInfo.php";
    }
  };
}


// after patient click on the add button in add appointment 
function addAppointment() {
  // var form_element = document.getElementsByClassName("form_data");

  // var form_data = new FormData();

  // for (var i = 0; i < form_element.length; i++) {
  //   form_data.append(form_element[i].name, form_element[i].value);
  // }

  // document.getElementById("submit").disabled = true;

  // var ajax_request = new XMLHttpRequest();

  // ajax_request.open("POST", "requestAppointment.php");

  // ajax_request.send(form_data);

  // ajax_request.onreadystatechange = function () {
  //   if (ajax_request.readyState == 4 && ajax_request.status == 200) {
  //     document.getElementById("submit").disabled = false;

  //     // $patientUsernameInput = document.getElementById("username");
  //     // $patientBatchNoInput = document.getElementById("batchNo");
  //     $patientAppointmentDateInput = document.getElementById("appointmentDate");

  //     if (response.success != "") {
  //       document.getElementById("form").reset();
  //       alert("Appointment added successfully!");
  //      location.href = "RequestVaccination.php";
  //       // setSuccessFor($patientUsernameInput);
  //       // setSuccessFor($patientBatchNoInput);
  //       setSuccessFor($patientAppointmentDateInput);
  //     } else {
  //       if (response.wrong_appointmentDate == "blankAppointmentDate") {
  //         setErrorFor($patientAppointmentDateInput, "Appointment date cannot be blank");
  //       } else if (response.wrong_appointmentDate == "invalidAppointmentDate") {
  //         setErrorFor($patientAppointmentDateInput, "Invalid appointment date");
  //       } else {
  //         setSuccessFor($patientAppointmentDateInput);
  //       }

      alert("Appointment added successfully!");
      location.href = "RequestVaccination.php";
    }

function validateAdmin() {
  var form_element = document.getElementsByClassName("form_data");

  var form_data = new FormData();

  
  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }

  // get dropdown value and pass it to database
  var e = document.getElementById("admincentreName");
  var selectedCentreName = e.options[e.selectedIndex].text;
  form_data.append("admincentreName", selectedCentreName)
  document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();
  
  ajax_request.open("POST", "http://localhost/DAHVAX/DahVax/public/form-validation/admin_validation.php");
  
  ajax_request.send(form_data);

  ajax_request.onreadystatechange = function () {
    
    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
      document.getElementById("submit").disabled = false;

      var response = JSON.parse(ajax_request.responseText);

      $adminUsernameInput = document.getElementById("adminUsername");

      $adminPasswordInput = document.getElementById("adminPassword");

      $adminEmailInput = document.getElementById("adminEmail");

      $adminFullnameInput = document.getElementById("adminFullname");

      $adminStaffidInput = document.getElementById("adminStaffid");

      // $admincentreNameInput = document.getElementById("admincentreName");

      if (response.success != "") {
        document.getElementById("admin-sign-up-form").reset();

        alert("Admin signed up successfully!");

        location.href = "index.php";

        setSuccessFor($adminUsernameInput);

        setSuccessFor($adminPasswordInput);

        setSuccessFor($adminEmailInput);

        setSuccessFor($adminFullnameInput);

        setSuccessFor($adminStaffidInput);

        // setSuccessFor($admincentreNameInput);
      } else {
        if (response.wrong_admin_username == "blankAdminUsername") {
          setErrorFor($adminUsernameInput, "Admin username cannot be blank");
        } else if (response.wrong_admin_username == "usedAdminUsername") {
          setErrorFor($adminUsernameInput, "Admin username is used");
        } else {
          setSuccessFor($adminUsernameInput);
        }

        if (response.wrong_admin_password == "blankAdminPassword") {
          setErrorFor($adminPasswordInput, "Password cannot be blank");
        } else if (response.wrong_admin_password == "invalidAdminPassword") {
          setErrorFor(
            $adminPasswordInput,
            "Min 6 characters, 1 number, 1 Uppercase"
          );
        } else {
          setSuccessFor($adminPasswordInput);
        }

        if (response.wrong_admin_email == "blankAdminEmail") {
          setErrorFor($adminEmailInput, "Email cannot be blank");
        } else if (response.wrong_admin_email == "usedAdminUsername") {
          setErrorFor($adminEmailInput, "Admin email is used");
        } else {
          setSuccessFor($adminEmailInput);
        }

        if (response.wrong_admin_fullname == "blankAdminFullname") {
          setErrorFor($adminFullnameInput, "Full name cannot be blank");
        } else {
          setSuccessFor($adminFullnameInput);
        }

        if (response.wrong_admin_staffID == "blankAdminstaffId") {
          setErrorFor($adminStaffidInput, "Staff ID cannot be blank");
        } else {
          setSuccessFor($adminStaffidInput);
        }

        // if (response.wrong_admin_centreName == "blankAdmincentreName") {

        // setErrorFor($admincentreNameInput, "Centre cannot be blank");

        // } else {

        // setSuccessFor($admincentreNameInput);

        // }
      }
    }
  };
}

function validateCentre() {
  var form_element = document.getElementsByClassName("form_data");

  var form_data = new FormData();

  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }

  document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();

  ajax_request.open("POST", "http://localhost/DAHVAX/DahVax/public/form-validation/centre_validation.php");

  ajax_request.send(form_data);

  ajax_request.onreadystatechange = function () {
    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
      document.getElementById("submit").disabled = false;
      var response = JSON.parse(ajax_request.responseText);

      $centreNameInput = document.getElementById("centreName");
      $addressInput = document.getElementById("centreAddress");
      
      if (response.success != "") {
        document.getElementById("add-centre-form").reset();
        alert("New centre added successfully!");
        location.href = "index.php";
        setSuccessFor($centreNameInput);
        setSuccessFor($addressInput);

      } else {
        if (response.wrong_centrename == "blankCentreName") {
          setErrorFor($centreNameInput, "Centre name cannot be blank");
        } else if (response.wrong_centrename == "usedCentreName") {
          setErrorFor($centreNameInput, "Centre name is already exist");
        } else {
          setSuccessFor($centreNameInput);
        }

        if (response.wrong_address == "blankAddress") {
          setErrorFor($addressInput, "Address cannot be blank");
        } else {
          setSuccessFor($addressInput);
        }
      }
    }
  };
}









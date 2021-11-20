function dropDownIconChange() {
  $(".dropdown-toggle i").toggleClass("fa-bars fa-caret-down");
}

// Show CSS for validation when user signs in
function signIn() {
  var form_element = document.getElementsByClassName("form_data");

  var form_data = new FormData();

  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }

  document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();

  ajax_request.open("POST", "form-validation/signIn_validation.php");

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

// Show CSS for validation when recording a new batch
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

  ajax_request.open("POST", "form-validation/patient_validation.php");

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
        alert("Signed up successfully!");
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
            "Username cannot be blank"
          );
        } else if (response.wrong_patient_username == "usedPatientUsername") {
          setErrorFor($patientUsernameInput, "Username is used");
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
            "Must be at Least 6 characters in length"
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

function validateAdmin() {
  var form_element = document.getElementsByClassName("form_data");

  var form_data = new FormData();

  
  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }

  // go to html get the element from admin de centrename 
  var e = document.getElementById("admincentreName");
  // admin choose de row de text store into selectedCentreName (we need .text to get the centrename if dont have then is just the row only)
  var selectedCentreName = e.options[e.selectedIndex].text;
  // keyvalue pair store into form data 
  form_data.append("admincentreName", selectedCentreName)
  document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();
  
  ajax_request.open("POST", "form-validation/admin_validation.php");
  
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

      if (response.success != "") {
        document.getElementById("admin-sign-up-form").reset();

        alert("Signed up successfully!");

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

      }
    }
  };
}

// To display input text field for remarks when updating the status of vaccination
function inputRemarks() {
  var x = document.getElementById("enterRemark");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

// from pending to either reject or confirm 
function updateFromPending() {
  var form_element = document.getElementsByClassName("form-data");

  var form_data = new FormData();

  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }
  form_data.append("status",document.querySelector('input[name="status"]:checked').value);

  for (var value of form_data.values()) {
    console.log(value);
 }
   document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();

  ajax_request.open("POST", "form-validation/record_pending.php");

  ajax_request.send(form_data);

  ajax_request.onreadystatechange = function () {
    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
      document.getElementById("submit").disabled = false;

      alert("Updated successfully!");
      location.href = "ViewVaccineBatchInfo.php";
    }
  };
}

// Make an AJAX request to PHP for updating the vaccination status to 'Administered'
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
  // alert("Requested successfully!");
  location.href = "RequestVaccination.php";
}

function validateCentre() {
  var form_element = document.getElementsByClassName("form_data");

  var form_data = new FormData();

  for (var i = 0; i < form_element.length; i++) {
    form_data.append(form_element[i].name, form_element[i].value);
  }

  document.getElementById("submit").disabled = true;

  var ajax_request = new XMLHttpRequest();

  ajax_request.open("POST", "form-validation/centre_validation.php");

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
        location.href = "AdminMenu.php";
        setSuccessFor($centreNameInput);
        setSuccessFor($addressInput);
      } else {
        if (response.wrong_centrename == "blankCentreName") {
          setErrorFor($centreNameInput, "Centre name cannot be blank");
        } else if (response.wrong_centrename == "usedCentreName") {
          setErrorFor($centreNameInput, "Centre name already exists");
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

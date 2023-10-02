function validateForm() {
    var signupform = document.getElementById("signupForm");
    var password = document.getElementById("password").value;
    var confirmpassword = document.getElementById("confirmPassword").value;
    var submitbutton = document.getElementById("submitbtn");
    var displayerror = document.getElementById("error");
    var companycode = document.getElementById("companyCode").value;

    // Create an array to store empty field names
    var emptyFields = [];

    // Check if all required fields are filled
    var inputs = signupform.querySelectorAll("[required]");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value.trim() === "") {
            var inputAttribute = inputs[i].id;
            var label = document.querySelector('label[for="' + inputAttribute + '"]');
            var labelText = label.textContent;
            // Add the field name to the emptyFields array
            emptyFields.push(labelText);
        }
    }

    // If there are empty fields, display an error message
    if(companycode != ""){
        if (emptyFields.length > 0) {
            var errorMessage = "Please fill in the following fields:\n" + emptyFields.join(",\n");
            displayerror.innerHTML = errorMessage;
            displayerror.style.display = "block";
        }else if(password != confirmpassword){
            displayerror.innerHTML = "Passwords do not match";
            displayerror.style.display = "block";
        } else {
            submitbutton.removeAttribute("disabled");
            displayerror.style.display = "none";
        }
    }
}
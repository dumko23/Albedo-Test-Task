<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="index.css" rel="stylesheet">
    <script src="index.js" type="application/javascript"></script>
    <title>Document</title>
</head>
<body>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1651.8741415025238!2d-118.34412348513942!3d34.10158833461871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf20e4c82873%3A0x14015754d926dadb!2zNzA2MCBIb2xseXdvb2QgQmx2ZCwgTG9zIEFuZ2VsZXMsIENBIDkwMDI4LCDQodCo0JA!5e0!3m2!1sru!2sua!4v1654499127339!5m2!1sru!2sua"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>

<form id="regForm" onsubmit="return false">

    <h1>Register:</h1>

    <!-- One "tab" for each step in the form: -->
    <div class="tab">
        <p><input class="isValid" placeholder="First name..." oninput="this.className = onInput(this.className)" required></p>
        <p><input class="isValid" placeholder="Last name..." required></p>
        <p><input class="isValid" placeholder="Birthdate..." type="date" required></p>
        <p><input class="isValid" placeholder="Repost subject..."  required></p>
        <p>Country: <select class="country isValid"  required>
                <option>Choose Country</option>
            </select></p>
        <p><input class="isValid" placeholder="Phone..."  required type="tel"></p>
        <p><input class="isValid" placeholder="E-mail..."  required type="email"></p>
    </div>

    <div class="tab">Login Info:
        <p><input placeholder="Company..." ></p>
        <p><input placeholder="Position..." ></p>
        <p><textarea placeholder="About me..." ></textarea></p>
        <p><input placeholder="Photo..." type="file" ></p>
    </div>

    <div class="tab">
        <p>some links</p>
    </div>

    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            <a></a>
        </div>
    </div>

    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
    </div>

</form>

<script>
    let currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form ...
        const x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n === 0) {
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("nextBtn").style.display = "inline";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
            document.getElementById("nextBtn").style.display = "inline";
        }
        if (n === (x.length - 1)) {
            document.getElementById("nextBtn").style.display = "none";
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
    }

    function onInput(str){
        let subst = /invalid/g;
        return str.replace(subst, '');
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        let x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n === 1 && !validateForm()) {
            return false
        }
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :

        // Otherwise, display the correct tab:
        showTab(currentTab);
        if (n === 1){

        }
    }

    function validateForm() {
        // This function deals with validation of the form fields
        let x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByClassName("isValid");
        // A loop that checks every input field in the current tab:

        // If a field is empty...
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value === "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }

        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        let i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }

    const countryList = document.querySelector('.country');

    fetch('https://restcountries.com/v3.1/all').then(res => {
        return res.json();
    }).then(data => {
        let output = '<option class="form-item" selected disabled value="">Choose Country</option>`';

        data.sort((a, b) => (a.name.common > b.name.common) ? 1 : -1)
            .forEach(country => {
                output += `<option class="form-item" data-value="${country.name.common}">${country.name.common}</option>`;
                countryList.innerHTML = output;
            });
    }).catch(err => {
        console.log(err);
    });
</script>
</body>
</html>
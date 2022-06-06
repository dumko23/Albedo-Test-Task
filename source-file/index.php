<?php
    session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="index.css" rel="stylesheet">
    <script src="index.js" type="application/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1651.8741415025238!2d-118.34412348513942!3d34.10158833461871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf20e4c82873%3A0x14015754d926dadb!2zNzA2MCBIb2xseXdvb2QgQmx2ZCwgTG9zIEFuZ2VsZXMsIENBIDkwMDI4LCDQodCo0JA!5e0!3m2!1sru!2sua!4v1654499127339!5m2!1sru!2sua"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>

<form id="regForm" onsubmit="return false">
    <h1>Register:</h1>


    <div class="tab">
        <p><input class="isValid" name="data[name]" placeholder="First name..."
                  oninput="this.className = onInput(this.className)" required></p>
        <p><input class="isValid" name="data[surname]" placeholder="Last name..." required></p>
        <p><input class="isValid" name="data[birthdate]" placeholder="Birthdate..." type="date" required></p>
        <p><input class="isValid" name="data[subject]" placeholder="Repost subject..." required></p>
        <p>Country: <select class="country isValid" name="data[country]" required>
                <option>Choose Country</option>
            </select></p>
        <p><input class="isValid" name="data[phone]" placeholder="Phone..." required type="tel"></p>
        <p><input class="isValid" name="data[email]" placeholder="E-mail..." required type="email"></p>
    </div>


    <div class="tab">Login Info:
        <p><input name="data[company]" placeholder="Company..."></p>
        <p><input name="data[position]" placeholder="Position..."></p>
        <p><textarea name="data[about]" placeholder="About me..."></textarea></p>
        <p><input name="data[photo]" placeholder="Photo..." type="file"></p>
    </div>

    <div class="tab">
        <p>some links</p>
    </div>

    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>

        </div>
    </div>

    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <div id="my_message"></div>
        <a></a>
    </div>
</form>

<script>

    let currentTab = 0;
    if(sessionStorage.getItem('currentTab')){
        currentTab = +sessionStorage.getItem('currentTab');
    } else if(+sessionStorage.getItem('currentTab') === 2){
        currentTab = 0;
    }
    console.log(currentTab, sessionStorage.getItem('currentTab'));
    sessionStorage.setItem('currentTab', '0');
    showTab(currentTab);

    function showTab(n) {

        const x = document.getElementsByClassName("tab");
        x[n].style.display = "block";

        if (n === 0) {
            document.getElementById("nextBtn").style.display = "inline";
        } else {
            document.getElementById("nextBtn").style.display = "inline";
        }
        if (n === (x.length - 1)) {
            document.getElementById("nextBtn").style.display = "none";
        }
        fixStepIndicator(n)
    }

    function onInput(str) {
        let subst = /invalid/g;
        return str.replace(subst, '');
    }

    function sendData() {
        $.post(
            'handler.php',
            $("#regForm").serialize(),
            function (msg) {
                $('#my_message').html(msg);
            }
        );
    }

    function nextPrev(n) {

        let x = document.getElementsByClassName("tab");

        if (n === 1 && !validateForm()) {
            return false
        }

        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        sessionStorage.setItem('currentTab', currentTab.toString());
        if(+sessionStorage.getItem('currentTab') === 2){
            sessionStorage.setItem('currentTab', '0');
        }
        console.log(currentTab, sessionStorage.getItem('currentTab'))
        showTab(currentTab);
        sendData();
    }

    function validateForm() {

        let x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByClassName("isValid");


        for (i = 0; i < y.length; i++) {

            if (y[i].value === "") {
                y[i].className += " invalid";
                valid = false;
            }
        }


        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        if (currentTab === 2) {
            document.getElementsByClassName("step").style.display = 'none';
        }
        return valid;
    }

    function fixStepIndicator(n) {

        let i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }

        x[n].className += " active";
    }

    const countryList = document.querySelector('.country');

    fetch('https://restcountries.com/v3.1/all').then(res => {
        return res.json();
    }).then(data => {
        let output = '<option selected disabled value="">Choose Country</option>`';

        data.sort((a, b) => (a.name.common > b.name.common) ? 1 : -1)
            .forEach(country => {
                output += `<option value="${country.name.common}">${country.name.common}</option>`;
                countryList.innerHTML = output;
            });
    }).catch(err => {
        console.log(err);
    });
</script>
</body>
</html>
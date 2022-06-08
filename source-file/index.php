<?php

require __DIR__ . '/../vendor/autoload.php';

?>
<?php
include('view/layouts/header.php')
?>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1651.8741415025238!2d-118.34412348513942!3d34.10158833461871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf20e4c82873%3A0x14015754d926dadb!2zNzA2MCBIb2xseXdvb2QgQmx2ZCwgTG9zIEFuZ2VsZXMsIENBIDkwMDI4LCDQodCo0JA!5e0!3m2!1sru!2sua!4v1654499127339!5m2!1sru!2sua"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
<form id="regForm" name="form" enctype="multipart/form-data" onsubmit="return false" method="post">
    <h1>Register:</h1>


    <div class="tab">
        <p><label>First name:
                <input class="isValid" name="data[firstName]" placeholder="First name..."
                       oninput="this.className = onInput(this.className)" required>
            </label>
            <span class="error" id="firstNameError"></span>
        </p>
        <p><label>Last name:
                <input class="isValid" name="data[lastName]" placeholder="Last name..."
                       oninput="this.className = onInput(this.className)" required>
            </label>
            <span class="error" id="lastNameError"></span>
        </p>
        <p><label>Birth date:
                <input class="isValid" name="data[date]" placeholder="Birthdate..."
                       oninput="this.className = onInput(this.className)" type="date" required>
            </label>
            <span class="error" id="dateError"></span>
        </p>
        <p><label>Report subject:
                <input class="isValid" name="data[subject]" placeholder="Repost subject..."
                       oninput="this.className = onInput(this.className)" required>
            </label>
            <span class="error" id="subjectError"></span>
        </p>
        <p><label>Country:
                <select class="country isValid" name="data[country]" required>
                    <option>Choose Country</option>
                </select>
            </label>
            <span class="error" id="countryError"></span>
        </p>
        <p><label>Phone:
                <input class="isValid" name="data[phone]" placeholder="+1 (555) 555-5555" maxlength="17"
                       oninput="this.className = onInput(this.className)" required type="tel">
            </label>
            <span class="error" id="phoneError"></span>
        </p>
        <p><label>Email:
                <input class="isValid" name="data[email]" placeholder="E-mail..."
                       oninput="this.className = onInput(this.className)" required type="email">
            </label>
            <span class="error" id="emailError"></span>
        </p>
    </div>


    <div class="tab">
        <h3>Additional info:</h3>
        <p><label>Company:
                <input name="data[company]" placeholder="Company...">
            </label></p>
        <p><label>Position:
                <input name="data[position]" placeholder="Position...">
            </label></p>
        <p><label>About me:
                <textarea name="data[about]" placeholder="About me..."></textarea>
            </label></p>
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000000"/>
        <p><label>My Photo (.png, .jpg, .jpeg):
                <input id="imgLoad" name="photo" type="file" accept=".png, .jpg, .jpeg">
            </label></p>
        <p id="fileWarning"></p>
    </div>

    <div class="tab">
        <p>some links</p>
        <a href="/">Back to 1st step</a>
    </div>

    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>

        </div>
    </div>

    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>

<div class="members-link">
    <a href="members.php">All members</a>
</div>

<script>

    let currentTab = 0;
    if (sessionStorage.getItem('currentTab')) {
        currentTab = +sessionStorage.getItem('currentTab');
    } else if (+sessionStorage.getItem('currentTab') === 2) {
        currentTab = 0;
    }
    console.log(currentTab, sessionStorage.getItem('currentTab'));
    sessionStorage.setItem('currentTab', '0');

    let noErrors = {
        country: "",
        date: "",
        email: "",
        firstName: "",
        lastName: "",
        phone: "",
        subject: "",
    }

    showTab(currentTab);

    function sendData() {
        let oldForm = document.forms.form;
        let formData = new FormData(oldForm);
        let file_data = $('#imgLoad').prop('files')[0];
        formData.append("photo", file_data);
        let result;
        toggleErrors(noErrors);

        $.ajax({
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            url: 'handlerSend.php',
            data: formData,
            success: function (data) {
                if(typeof data === 'string'){
                    result = JSON.parse(data);
                    console.log(result);

                    toggleErrors(result);
                    return false;
                } else if(data === 1){
                    return true;
                }
            }
        });
        if(result === 1){
            return true;
        }
        return result;
    }

    function toggleErrors(data) {
        $('#firstNameError').html(data.firstName);
        $('#lastNameError').html(data.lastName);
        $('#dateError').html(data.date);
        $('#subjectError').html(data.subject);
        $('#countryError').html(data.country);
        $('#phoneError').html(data.phone);
        $('#emailError').html(data.email);
    }


    function updateData() {
        let oldForm = document.forms.form;
        let formData = new FormData(oldForm);
        let file_data = $('#imgLoad').prop('files')[0];
        formData.append("photo", file_data);

        $.ajax({
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            url: 'handlerUpdate.php',
            data: formData,
            success: function (data) {
                console.log(data);
            }
        });
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
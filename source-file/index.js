// will be moved to script folder later

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

function nextPrev(n) {

    let x = document.getElementsByClassName("tab");

    if (n === 1 && !validateForm()) {
        return false
    }
    if (currentTab === 0) {
        sendData();
        x[currentTab].style.display = "none";
    } else if (currentTab === 1) {
        let file_data = document.getElementById("imgLoad").files[0];
        if (file_data.size > 3000000000){
            document.getElementById('fileWarning').innerHTML = `Max file size is 300. Your is ${file_data.size}`
            return false;
        } else {

            updateData();
            x[currentTab].style.display = "none";
        }
    }
    currentTab = currentTab + n;
    sessionStorage.setItem('currentTab', currentTab.toString());
    if (+sessionStorage.getItem('currentTab') === 2) {
        sessionStorage.setItem('currentTab', '0');
    }
    console.log(currentTab, sessionStorage.getItem('currentTab'))
    showTab(currentTab);
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
    console.log(x[n].className);
    x[n].className += " active";
}
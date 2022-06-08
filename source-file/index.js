// will be moved to script folder later

function showTab(n) {

    const x = document.getElementsByClassName("tab");
    x[n].style.display = "block";

    if (n === 0) {
        document.getElementById("nextBtn").style.display = "inline";
        document.getElementById("step2Btn").style.display = "none";
    } else if(n === 1) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("step2Btn").style.display = "inline";
    }
    if (n === (x.length - 1)) {
        document.getElementById("step2Btn").style.display = "none";
    }
    fixStepIndicator(n)
}


async function nextPrev(n, result = true) {

    let x = document.getElementsByClassName("tab");


    if (currentTab === 0) {
        let resultOfAjax = result;
        console.log(4, resultOfAjax);
        if(typeof resultOfAjax === 'object'){
            console.log(5, resultOfAjax)
            toggleErrors(resultOfAjax);

            return false;
        } else if(resultOfAjax === 1){
            console.log('shit')
            x[currentTab].style.display = "none";
            toggleErrors(resultOfAjax);
        }
    } else if (currentTab === 1) {
        let file_data = document.getElementById("imgLoad").files[0];
        console.log(file_data);
        if (file_data) {
            if (file_data.size > 3000000000) {
                console.log('breaking')
                document.getElementById('fileWarning').innerHTML = `Max file size is 300. Your is ${file_data.size}`
                return false;
            } else {
                console.log('another shit')
                updateData();
                x[currentTab].style.display = "none";
            }
        } else {
            updateData();
            x[currentTab].style.display = "none";
        }
    }
    console.log('this', currentTab)
    currentTab = currentTab + 1;
    sessionStorage.setItem('currentTab', currentTab.toString());
    if (+sessionStorage.getItem('currentTab') === 2) {
        sessionStorage.setItem('currentTab', '0');
    }
    console.log('that', currentTab, sessionStorage.getItem('currentTab'))
    showTab(currentTab);
}

function fixStepIndicator(n) {

    let i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    console.log(x[n].className);
    x[n].className += " active";
}
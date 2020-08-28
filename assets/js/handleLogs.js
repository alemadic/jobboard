window.onload = function () {



    let location = window.location.pathname;



    $("#registerEmployee").hide();



    console.log(location);



    if (location.indexOf("register")) {

        $(".tabs").click(function () {

            let regType = $(this).data("type");



            if (regType == "employer") {

                $("#firma").addClass("btn-success");

                $("#radnik").removeClass("btn-success");



                $("#registerEmployee").fadeOut();

                $("#registerEmployer").fadeIn();

                $(".errors").remove();


            } else {



                $("#firma").removeClass("btn-success");

                $("#radnik").removeClass("btn-light");

                $("#radnik").addClass("btn-success");



                $("#registerEmployer").fadeOut();

                $("#registerEmployee").fadeIn();

                $(".errors").remove();

            }

        });

    }



}







// var dugme = document.querySelector("input[type=button]");

// dugme.addEventListener("click", proveraRad);



var podaci = [];

var greske = [];



var regexIme = /^[A-Z][a-z]{2,25}$/;

var regexImeFirme = /^[A-Z][A-z\d\s\-]{2,45}$/;

var regexPrezime = /^[A-Z][a-z]{2,45}$/;

var regexEmail = /^[a-z\.\d]{3,40}@[a-z]{3,10}\.[a-z]{2,10}(\.[a-z]{2,10})*$/;

var regexLozinka = /^.{6,40}$/;

var regexCv = /^[A-z\d-]+(\.doc|\.pdf|\.docx)$/;

var regexLogo = /^[A-z\d-]+(\.jpg|\.jpeg|\.png|\.svg)$/;

// var validFormati = {
//     ime: {
//         "desc": "Name",
//         "format": "John"
//     },
//     prezime: "Blake",
//     email: "someone@example.com",
//     lozinka: "You must enter same passwords",
// }

var validFormati = {
    ime: {
        desc: "First name",
        format: "John"
    },
    prezime: {
        desc: "Last name",
        format: "Smith"
    },
    email: {
        desc: "Email",
        format: "someone@example.com"
    },
    lozinka: {
        desc: "Password",
        format: "You must enter same passwords"
    },
    imeFirme: {
        desc: "Company name",
        format: "Nordeus"
    },
    emailFirme: {
        desc: "Email",
        format: "someone@example.com"
    },
    lozinkaF: {
        desc: "Password",
        format: "You must enter same passwords"
    }
}


function proveriPolje(regex, polje) {

    if (regex.test(polje.value)) {

        podaci.push(polje.value);

        polje.classList.remove("border-danger");

    } else {

        greske.push(polje.id);

        polje.classList.add("border", "border-danger");

        return false;

    }

}



function proveraFirme() {

    podaci = [];

    greske = [];



    let imeFirme = document.querySelector("#imeFirme");

    let emailF = document.querySelector("#emailFirme");

    let lozinka = document.querySelector("#lozinkaF");



    let lozinkaP = document.querySelector("#lozinkaPF");

    let slika = document.querySelector("#logo");


    proveriPolje(regexImeFirme, imeFirme);

    proveriPolje(regexEmail, emailF);

    proveriPolje(regexLozinka, lozinka);



    if (lozinka.value == '' || lozinkaP.value != lozinka.value) {

        greske.push("Lozinke se ne podudaraju");

        lozinka.classList.add("border", "border-danger");

        lozinkaP.classList.add("border", "border-danger");

    } else {

        lozinka.classList.remove("border-danger");

        lozinkaP.classList.remove("border-danger");

    }

    let out = "<ul class='errors'>";

    for (const err of greske) {
        if (validFormati[err]) {
            out += `
                <li>${validFormati[err].desc} - ${validFormati[err].format}</li>
            `;

        }

    }

    out += "</ul>";

    $(out).insertBefore(".btnContainer");

    console.log(out);

    if (slika.value == "") {

        slika.classList.add("border", "border-danger");

        return false;

    } else {

        slika.classList.remove("border-danger");

    }

    console.log(greske);

    if (greske.length == 0) {

        return true;

    } else {

        return false;

    }



}



function proveraRad() {

    podaci = [];

    greske = [];

    $(".errors").remove();

    let ime = document.querySelector("#ime");

    let prezime = document.querySelector("#prezime");

    let email = document.querySelector("#email");

    let lozinka = document.querySelector("#lozinka");

    let lozinkaPonovo = document.querySelector("#lozinkaP");

    let cv = document.querySelector("#cv");

    let cvError = document.querySelector("#cvError");



    proveriPolje(regexIme, ime);

    proveriPolje(regexPrezime, prezime);

    proveriPolje(regexEmail, email);

    proveriPolje(regexLozinka, lozinka);



    if (lozinka.value == '' || lozinkaPonovo.value != lozinka.value) {

        greske.push("Lozinke se ne podudaraju");

        lozinka.classList.add("border", "border-danger");

        lozinkaPonovo.classList.add("border", "border-danger");

    } else {

        lozinka.classList.remove("border-danger");

        lozinkaPonovo.classList.remove("border-danger");

    }



    let cvVal = cv.value.split("\\")[2];



    if (regexCv.test(cvVal)) {

        podaci.push(cvVal);

        cvError.innerHTML = "";

        cv.classList.remove("border-danger");

    } else {

        greske.push("Cv nije ok");

        cvError.innerHTML = "Upload only docx, doc or pdf file";

        cv.classList.add("border", "border-danger");

    }

    console.log(podaci);

    console.log(greske);

    let out = "<ul class='errors'>";

    for (const err of greske) {
        if (validFormati[err]) {
            out += `
                <li>${validFormati[err].desc} - ${validFormati[err].format}</li>
            `;

        }

    }

    out += "</ul>";

    $(out).insertBefore(".btnContainer");

    console.log(out);

    // return false;

    if (greske.length == 0) {

        return true;

    } else {

        return false;

    }

}



function proveraL() {

    podaci = [];

    greske = [];



    let email = document.querySelector("#email");

    let lozinka = document.querySelector("#lozinka");



    proveriPolje(regexEmail, email);

    proveriPolje(regexLozinka, lozinka);



    console.log(greske);



    if (greske.length == 0) {

        return true;

    } else {

        console.log("trebalo bi da stane");

        return false;

    }



}
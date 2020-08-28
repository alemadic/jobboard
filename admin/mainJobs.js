$(document).ready(function() {
    let location = window.location.pathname;

    if(location.includes("/admin/") || location.includes("index")) {
        handleClick();

    }

    if(location.includes("editJob")) {

    }

    if(location.includes("profile")) {
        
    }
});

function handleClick() {
    $(".link").click(function(e) {
        e.preventDefault();

        let ispis = `
            <table class="table table-striped table-sm" id="tabela">
                <thead id="head">
                    
                </thead>
                <tbody id="data">
                    
                </tbody>
            </table>
        `;

        
        $("#mainContent").html(ispis);
        
        let key = $(this).attr("href").split("=")[1];
        $("#pageTitle").html(key);
        var output = "";
        if(key == "jobs") {
            prikaziPoslove();
            output = `
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Category</th>
                    <th>City</th>
                    <th>Experience</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                    
            `;
        }

        if(key == "categories") {
            prikaziKategorije();
            output = `
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Popularity</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            `;
        }

        $("#head").html(output);
    });
}

function ajaxIndex(callback) {
    $.ajax({
        url: "../Business/initIndex.php",
        dataType: "json",
        success: callback,
        error: function(xhr, error, status) {
            console.log(xhr, error, status);
        }
    })
}

function prikaziPoslove() {
    ajaxIndex(data => stampajPoslove(data.oglasi));
}

function stampajPoslove(data) {
    let output = "";
    let redniBr = 1;

    console.log(data);

    for (let el of data) {
        output += `
            <tr>
                <td>${redniBr++}</td>
                <td>${el.Naslov}</td>
                <td>${el.nazivFirme}</td>
                <td>${el.ImeKategorije}</td>
                <td>${el.Grad}</td>
                <td>${el.iskustvo}</td>
                <td><a href="editJob.php?jobId=${el.Id}">Edit</a></td>
                <td><a href="deleteJob.php?jobId=${el.Id}">Delete</a></td>
            </tr>
        `;
    }

    $("#data").html(output);
}

function prikaziKategorije() {
    ajaxIndex(data => stampajKategorije(data.kategorije));
}

function stampajKategorije(data) {
    let out = "";
    let redniBr = 1;

    for (let el of data) {
        out += `
            <tr>
                <td>${redniBr++}</td>
                <td>${el.Ime}</td>
                <td>${el.Popularnost}</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
    `;
    }

    $("#data").html(out);
}

function proveraEdit() {
    let greske = [];

    let naslov = document.querySelector("#naslov");
    let kategorija = document.querySelector("#kategorije");
    let rok = document.querySelector("#date");
    let lokacija = document.querySelector("#lokacije");
    let iskustvo = document.querySelector("#iskustvo");
    let tipPosla = document.querySelector("#tipPosla");
    let opis = document.querySelector("#jobDesc");
    let plata = document.querySelector("#plata");

    let regexNaslov = /^[\.A-z][A-z\d\s\-.]{2,45}$/;
    
    if(!regexNaslov.test(naslov.value)) {
        naslov.classList.add("border", "border-danger");
        naslov.value = "";
        naslov.setAttribute("placeholder", "Title dev etc.");
        greske.push("Naslov nije ok");

    } else {
        naslov.classList.remove("border-danger");
    }

    if(kategorija.value == '0') {
        kategorija.classList.add("border", "border-danger");
        greske.push("Morate izabrati kategoriju");
    } else {
        kategorija.classList.remove("border-danger");
    }

    if(lokacija.value == '0') {
        lokacija.classList.add("border", "border-danger");
        greske.push("Morate izabrati lokaciju");
    } else {
        lokacija.classList.remove("border-danger");
    }

    if(iskustvo.value == '0') {
        iskustvo.classList.add("border", "border-danger");
        greske.push("Morate izabrati iskustvo");
    } else {
        iskustvo.classList.remove("border-danger");
    }

    if(tipPosla.value == '0') {
        tipPosla.classList.add("border", "border-danger");
        greske.push("Morate izabrati tipPosla");
    } else {
        tipPosla.classList.remove("border-danger");
    }
    
    if(opis.value.length < 30) {
        greske.push("Opis mora biti duzi od 30 char");
        opis.classList.add("border", "border-danger");
        opis.value = "";
        opis.setAttribute("placeholder", "Description must be 30 chars min");
    }

    let datum = new Date(rok.value);
    let danasnji = new Date();

    let razlika = Date.UTC(datum.getFullYear(), datum.getMonth(), datum.getDate()) - Date.UTC(danasnji.getFullYear(), danasnji.getMonth(), danasnji.getDate());

    if(rok.value == "" || razlika < 0) {
        greske.push("Date nije ok");
        rok.classList.add("border", "border-danger");
        let warning = `
            <small class="form-text text-muted" id="dateError">Date mumst be in the future</small>
        `;

        if($("#dateError").length == 0) {
            $(warning).insertAfter("#date");
        }

    } else {
        rok.classList.remove("border-danger");
        $("#dateError").remove();
    }

    if(plata.value < 30000) {
        plata.classList.add("border", "border-danger");
        greske.push("Plata ne moze manje od 30000");
        let warning = `
            <small class="form-text text-muted" id="plataError">Min Salary is 30000</small>
        `;

        if($("#plataError").length == 0) {
            $(warning).insertAfter("#plata");
        }
    } else {
        plata.classList.remove("border-danger");
        $("#plataError").remove();
    }

    console.log($("#plataError").length);

    if(greske.length == 0) {
        return true;
    } else {
        return false;
    }

}
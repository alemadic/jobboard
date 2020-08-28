/* MOJ KOD */

var lokacija = "";
$(document).ready(function () {
  lokacija = window.location.pathname;

  console.log(lokacija);

  if (lokacija.indexOf("index.php") != -1 || lokacija == "/jobboard/index.php" || lokacija == "/jobboard/" || lokacija == '/') {
    initIndex();

    let findJob = document.querySelector("#findJob");
    // findJob.addEventListener("click", filterJobs);
  }

  if (lokacija.indexOf("jobs.php") != -1) {
    let url = "Business/initIndex.php";
    initListe(url);

    $("#submitAnketu").click(posaljiAnketu);

    // let filterDugme = document.querySelector("#filterJobs");
    // filterDugme.addEventListener("click", () => console.log("kliknuto"));
  }

  if (lokacija.indexOf("jobDetails") != -1) {
    let dugme = document.querySelector("#submitApply");

    dugme.addEventListener("click", handlePrijavu);
  }

  if (lokacija.indexOf("profile") != -1) {
    handleLink();

    $("#insertJob").hide();

  }

  /* ZA ADMINA */
  if (lokacija == "/jobboard/admin/" || lokacija.includes("admin/index")) {
    let url = "../Business/initIndex.php";
    initListe(url);
    handleLink();

    $("#insertJobCont").hide();
    $("#insertKatCont").hide();


    $("#addNew").click((e) => {
      e.preventDefault();
      $("#insertJob").removeClass("d-none");
      $("#insertJob").fadeIn();
    });

    $("#addNewKat").click((e) => {
      e.preventDefault();
      $("#insertKat").removeClass("d-none");
      $("#insertKat").fadeIn();
    })

  }

  if (lokacija.includes("editJob")) {

  }


});



function ajaxIndex(url, callback) {
  $.ajax({
    url: url,
    dataType: "json",
    success: callback,
    error: function (xhr, error, status) {
      console.log(xhr);
      console.log(error);
      console.log(status);
    }
  })
}

// function ajaxIndexAdmin(callback) {
//   $.ajax({
//     url: "../Business/initIndex.php",
//     dataType: "json",
//     success: callback,
//     error: function(xhr, error, status) {
//       console.log(xhr);
//       console.log(error);
//       console.log(status);
//     }
//   })
// }


function initIndex() {
  ajaxIndex("Business/initIndex.php", (data) => {
    var lokacije = $("#lokacije");

    populateDropdowns(lokacije, data.lokacije);

    var kategorije = $("#kategorije");

    populateDropdowns(kategorije, data.kategorije);

    var oglasiDiv = document.querySelector("#oglasi");
    let prvih = data.oglasi.slice(0, 6);
    populateJobs(oglasiDiv, prvih);

    // var utisci = document.querySelector("#utisci");
    // console.log(data.utisci);
    // populateUtiske(utisci, data.utisci);


  })
}

function initListe(url) {
  ajaxIndex(url, (data) => {
    var lokacije = $("#lokacije");

    populateDropdowns(lokacije, data.lokacije);

    var kategorije = $("#kategorije");

    populateDropdowns(kategorije, data.kategorije);

    var iskustvo = $("#iskustvo");

    populateDropdowns(iskustvo, data.iskustvo);

    var tipPosla = $("#tipPosla");

    populateDropdowns(tipPosla, data.tipovi);

    var oglasiDiv = $("#oglasi");
    // populateJobs(oglasiDiv, data.oglasi);

    var firme = $("#firme");
    populateDropdowns(firme, data.firme);

  });

  // var filterForm = document.querySelector("#filterJobs");

  // filterForm.addEventListener("click", function(e) {
  //   e.preventDefault();

  //   var filterData = {
  //     lokacija: lokacije.value,
  //     kategorija: kategorije.value,
  //     isk: iskustvo.value,
  //     tip: tipPosla.value,
  //     dugmeFilter: true
  //   };

  //   $.ajax({
  //     url: "Business/processFilterJobs.php",
  //     dataType: "json",
  //     method: "GET",
  //     data: filterData,
  //     success: function(data) {
  //       let oglasiDiv = document.querySelector("#oglasi");
  //       populateJobs(oglasiDiv, data);
  //     },
  //     error: function(xhr) {
  //       console.log(xhr);
  //     }
  //   })
  // })


}



/* POPUNJAVANJE FUNKCIJE */
function populateDropdowns(element, niz) {
  let output = '';

  for (let el of niz) {

    if (el.hasOwnProperty("Ime")) {
      output += `
      <option value="${el.Id}">${el.Ime}</option>
      `;
    } else if (el.hasOwnProperty("Grad")) {
      output += `
        <option value="${el.Id}">${el.Grad}</option>
      `;
    } else if (el.hasOwnProperty("Naziv")) {
      output += `
        <option value="${el.Id}">${el.Naziv}</option>
      `;
    } else if (el.hasOwnProperty("NazivTip")) {
      output += `
        <option value="${el.Id}">${el.NazivTip}</option>
      `;
    }
  }

  element.append(output);
}

function populateList(el, niz) {
  let output = "";

  for (let el of niz) {
    output += `
      <li>
        <a href="#">${el.Ime}</a>
      </li>
    `;
  }

  el.innerHTML += output;
}

function populatePopularKats(el, niz) {
  let output = "";

  for (let el of niz) {
    output += `
      <div class="col-lg-4 col-xl-3 col-md-6">
        <div class="single_catagory">
            <a href="jobs.html"><h4>${el.Ime}</h4></a>
            <p> <span>50</span> Available position</p>
        </div>
    </div>
    `;
  }

  el.innerHTML += output;
}

function populateJobs(el, data) {
  let output = "";

  for (let item of data) {
    output += `
      <div class="col-lg-12 col-md-12">
        <div class="single_jobs white-bg d-flex justify-content-between">
            <div class="jobs_left d-flex align-items-center">
                <div class="thumb">
                    <img src="${item.Logo}" alt="${item.nazivFirme}" class="img-fluid" />
                </div>
                <div class="jobs_conetent">
                    <a href="jobDetails.php?jobId=${item.Id}"><h4>${item.Naslov} @ ${item.nazivFirme}</h4></a>
                    <div class="links_locat d-flex align-items-center">
                        <div class="location">
                            <p> <i class="fa fa-map-marker"></i>${item.Grad}</p>
                        </div>
                        <div class="location">
                            <p> <i class="fa fa-clock-o"></i> ${item.TipPosla}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="jobs_right">
                <div class="apply_now">
                    <a href="jobDetails.php?jobId=${item.Id}" class="boxed-btn3">View details</a>
                </div>
                <div class="date">
                    <p>Deadline: ${item.Rok.split(" ")[0]}</p>
                </div>
            </div>
        </div>
    </div>
    `;
  }

  el.innerHTML = output;
}

function populateUtiske(el, data) {
  let out = "";

  for (let item of data) {
    out += `
      <div class="single_carousel">
        <div class="row">
            <div class="col-lg-11">
                <div class="single_testmonial d-flex align-items-center">
                   
                    <div class="info">
                        <p>${item.Text}</p>
                        <span>- ${item.korIme}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;
  }
  el.innerHTML = out;


}

function handlePrijavu(e) {
  e.preventDefault();

  let oglasId = this.dataset.oglasid;
  let userId = this.dataset.userid;

  let message = document.querySelector("#message");

  let podaci = {
    oglasId: oglasId,
    userId: userId,
    poruka: message.value,
    dugme: "true"
  };

  if (message.value.length < 10) {
    message.classList.add("border", "border-danger");
    return false;
  } else {
    message.classList.remove("btn-danger");
  }

  // console.log(podaci);

  $.ajax({
    url: "Business/jobApply.php",
    type: "post",
    dataType: "json",
    data: podaci,
    success: function (odg) {
      if (odg == "Uspelo") {
        alert("You have successfully applied for this job");
        message.value = "";
      }
    },
    error: function (xhr, error, status) {
      console.log(xhr, error, status);
    }
  })

}




/* ADMIN FUNKCIJE */

var ispisTabele = `
  <div class="table-responsive">
  <table class="table table-striped table-sm" id="tabela">
    <thead id="head">
        
    </thead>
    <tbody id="data">
        
    </tbody>
  </table>
</div>
`;

function handleLink() {
  $(".link").click(function (e) {
    e.preventDefault();

    $("#mainContent").html(ispisTabele);

    let key = $(this).attr("href").split("=")[1];
    $("#pageTitle").html(key);
    let tableHead = "";
    if (key == "jobs") {
      $("#insertKatCont").hide();
      $("#insertJobCont").show();
      prikaziPoslove();
      tableHead = `
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

    if (key == "categories") {
      $("#insertJobCont").hide();
      $("#insertKatCont").show();
      prikaziKategorije();
      tableHead = `
              <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Popularity</th>
                  <th>Edit</th>
                  <th>Delete</th>
              </tr>
          `;


    }

    if (key == "myjobs") {
      tableHead = `
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
      prikaziKomPoslove();

    }

    if (key == "applications") {
      tableHead = `
              <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>User Name</th>
                  <th>User Cv</th>
                  <th>Message</th>
                  <th>Contact</th>
              </tr>
          `;
      prikaziPrijave();

      $("#insertJob").hide();
    }

    if (key == "myAppns") {
      tableHead = `
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Company</th>
                <th>Salary</th>
                <th>Deadline</th>
                <th>Experience</th>
                <th>View more details</th>
                <th>Delete</th>
            </tr>
        `;
      prikaziKorPrijave();

    }

    if (key == "tests") {
      $("#insertJobCont").hide();
      $("#insertKatCont").hide();
      prikaziKategorije();
      tableHead = `
              <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Popularity</th>
                  <th>Edit</th>
                  <th>Delete</th>
              </tr>
          `;


    }

    $("#head").html(tableHead);
  });
}

function prikaziPoslove() {
  // ajaxIndex(("../Business/initIndex.php", data) => { stampajPoslove(data.oglasi)});

  let url = "../Business/initIndex.php";

  ajaxIndex(url, data => {
    stampajSvePoslove(data.oglasi)
  });

  $("#insertKatCont").hide();
}

function prikaziKomPoslove() {
  let url = "Business/profileByRole.php";

  ajaxIndex(url, data => {
    stampajKomPoslove(data.firmaOglasi);
  });
}

function stampajSvePoslove(data) {
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

function stampajKomPoslove(data) {
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

  if (lokacija.indexOf("profile") != -1) {
    let insertNew = `<a href="#" class="btn btn-light mb-2 mt-5 pull-right" id="insertNew">Add new job</a>`;

    $("#mainContent").append(insertNew);

    $("#insertNew").click((e) => {
      e.preventDefault();
      $("#insertJob").removeClass("d-none");
      $("#insertJob").fadeIn();

      let url = "Business/initIndex.php";
      initListe(url);
    })

  }

}

function prikaziKategorije() {
  let url = "../Business/initIndex.php";
  // ajaxIndex((url, data => stampajKategorije(data.kategorije)));

  ajaxIndex(url, data => {
    // stampajKategorije(data.kategorije)
    stampajKategorije(data.kategorije);

    $("#insertJob").hide();
  });
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
              <td>
                <a href="editKat.php?katId=${el.Id}">Edit</a>
              </td>
              <td>
                <a href="deleteKat.php?katId=${el.Id}">Delete</a>
              </td>
          </tr>
  `;
  }

  $("#data").html(out);
}

function prikaziPrijave() {
  let url = "Business/profileByRole.php";

  ajaxIndex(url, data => {
    stapmajPrijave(data.prijave);
  });
}

function stapmajPrijave(data) {
  console.log(data);
  let out = "";
  let redniBr = 1;

  for (let el of data) {
    out += `
          <tr>
              <td>${redniBr++}</td>
              <td>${el.naslov}</td>
              <td>${el.userName}</td>
              <td>
                  <a class="btn btn-light" href="${el.Cv}">Download Cv</a>
              </td>
              <td>
                <button class="btn btn-light viewMessage" data-toggle="modal" data-target="viewMessage" href="" data-msg="${el.Poruka}">View Message</button>
              </td>
              <td>
                <button class="btn btn-light contact" data-toggle="modal" data-target="contactModal" href="" data-userEmail="${el.Email}">Contact</button>
              </td>
          </tr>
      `;
  }

  $("#data").html(out);

  $(".viewMessage").click(function () {
    var poruka = $(this).data("msg");
    var porukaOut = `<p>${poruka}</p>`
    stampajModal();

    $(".modal-title").html("Message");
    $(".modal-body").html(porukaOut);
  });

  $(".contact").click(function () {
    let forma = stampajFormuZaPrijavu();

    var userEmail = $(this).data("useremail");

    stampajModal();
    $(".modal-title").html("Contact user");
    $(".modal-body").html(forma);

    $("#contactUser").click(function (e) {
      e.preventDefault();

      let empMsg = $("#message");

      if (empMsg.val().length < 10) {
        empMsg.addClass("border border-danger");

        let warning = `
          <small class="form-text text-danger mb-3" id="msgErr">You must enter min 10 chars</small>
        `;

        if ($("#msgErr").length == 0) {
          $(warning).insertAfter(empMsg);
        }
      } else {
        empMsg.removeClass("border-danger");
        $("#msgErr").remove();
      }

      console.log(firmaEmail);

      let podaci = {
        emailTo: userEmail,
        emailFrom: firmaEmail,
        firmaNaziv: firmaNaziv,
        msg: empMsg.val(),
        dugmeUser: true
      }

      $.ajax({
        url: "contactForm.php",
        dataType: "json",
        method: "POST",
        data: podaci,
        success: function (data) {
          console.log(data)
        },
        error: function (xhr, error, status) {
          console.log(xhr, error, status);
        }
      });


    })
  })

}

function prikaziKorPrijave() {
  let url = "Business/profileByRole.php";

  ajaxIndex(url, data => {
    stampajKorPrijave(data);
  })
}

function stampajKorPrijave(data) {
  let out = "";
  let redniBr = 1;

  console.log(data);

  for (let el of data) {
    out += `
        <tr>
          <td>${redniBr++}</td>
          <td>${el.Naslov}</td>
          <td>${el.nazivFirme}</td>
          <td>${el.Plata}</td>
          <td>${el.Rok.split(" ")[0]}</td>
          <td>${el.nazivIsk}</td>
          <td>
            <a href="jobDetails.php?jobId=${el.oglasId}">Job details</a>
          </td>
          <td>
            <a class="brisiPrijavu" href="Business/delPrijavu.php?jobId=${el.oglasId}&korId=${el.korId}">Delete</a>
          </td>
      </tr>
      `;
  }

  $("#data").html(out);

}

function posaljiAnketu(e) {
  e.preventDefault();

  let korId = $("#korId");
  let nasao = $("input[name=nasao]");
  let ocena = $("#ocenaPlat");

  let pitanje1Id = $("#pitanje1").data("idpitanja");
  let pitanje2Id = ocena.data("idpitanja");

  let nasaoIzbor = "";

  for (let i = 0; i < nasao.length; i++) {
    if (nasao[i].checked) {
      nasaoIzbor = nasao[i].value;
      break;
    }
  }

  if (nasaoIzbor == "") {
    let warning = `
        <small class="form-text text-danger" id="izborErr">You must choose option</small>
    `;

    if ($("#izborErr").length == 0) {
      $(warning).insertAfter($(".form-check").last());
    }

    return false;
  } else {
    $("#izborErr").remove();
  }

  if (ocena.val() > 10 || ocena.val() < 1) {
    let warning = `
        <small class="form-text text-danger" id="ocenaErr">You must choose between 1-10</small>
    `;

    if ($("#ocenaErr").length == 0) {
      $(warning).insertAfter($("#ocenaPlat"));
    }

    return false;
  } else {
    $("#ocenaErr").remove();
  }

  // let podaci = {
  //   korId: korId.val(),
  //   nasao: nasaoIzbor,
  //   ocena: ocena.val(),
  //   pitanje1Id: pitanje1Id,
  //   pitanje2Id: pitanje2Id,
  //   dugme: true
  // };

  let podaci = {
    korId: korId.val(),
    pitOdg: [
      {
        pitanjeId: pitanje1Id,
        odgovor: nasaoIzbor
      },
      {
        pitanjeId: pitanje2Id,
        odgovor: ocena.val()
      },
    ],
    dugme: true
  };

  $.ajax({
    url: "Business/processAnketa.php",
    method: "POST",
    dataType: "JSON",
    data: podaci,
    success: function (data) {
      handleAnketu(data);
    },
    error: function (xhr, error, status) {
      console.log(xhr, error, status);
    }
  });
}

function handleAnketu(data) {
  if (data.status == "Nije Uspelo") {
    alert("You already voted");
  }

  if (data.status == "Uspelo") {
    alert("You successfully voted");
  }

  $("#anketa").html("");

  let out = `
    <h3>Percentage of people who found a job</h3>
    <p>${data.uspehPosao.procenat * 100} %</p>
    
    <h3>Average Rate of our platform</h3>
    <p>${data.ocenaPlatforme.prosek * 10} %</p>
  `;

  $("#anketa").html(out);
}

function proveraEdit() {
  let greske = [];

  let rez = proveraFormeZaPosao(greske);

  return rez;

}

function proveraFormeZaPosao(greske) {
  let naslov = $("#naslov");
  let kategorija = $("#kategorije");
  let rok = $("#date");
  let lokacija = $("#lokacije");
  let iskustvo = $("#iskustvo");
  let tipPosla = $("#tipPosla");
  let opis = $("#jobDesc");
  let plata = $("#plata");
  let firma = $("#firme");

  let regexNaslov = /^[\.A-z][A-z\d\s\-.]{2,45}$/;

  if (!regexNaslov.test(naslov.val())) {
    naslov.addClass("border border-danger");
    naslov.val("");
    naslov.attr("placeholder", "Title dev etc.");
    greske.push("Naslov nije ok");

  } else {
    naslov.removeClass("border-danger");
  }

  if (kategorija.val() == '0') {
    kategorija.addClass("border border-danger");
    greske.push("Morate izabrati kategoriju");
  } else {
    kategorija.removeClass("border-danger");
  }

  if (lokacija.val() == '0') {
    lokacija.addClass("border border-danger");
    greske.push("Morate izabrati lokaciju");
  } else {
    lokacija.removeClass("border-danger");
  }

  if (iskustvo.val() == '0') {
    iskustvo.addClass("border border-danger");
    greske.push("Morate izabrati iskustvo");
  } else {
    iskustvo.removeClass("border-danger");
  }

  if (tipPosla.val() == '0') {
    tipPosla.addClass("border border-danger");
    greske.push("Morate izabrati tipPosla");
  } else {
    tipPosla.removeClass("border-danger");
  }

  if (firma.val() == '0') {
    firma.addClass("border border-danger");
    greske.push("Morate izabrati firma");
  } else {
    firma.removeClass("border-danger");
  }

  if (opis.val().length < 30) {
    greske.push("Opis mora biti duzi od 30 char");
    opis.addClass("border border-danger");
    opis.val("");
    opis.attr("placeholder", "Description must be 30 chars min");
  }

  let datum = new Date(rok.val());
  let danasnji = new Date();

  let razlika = Date.UTC(datum.getFullYear(), datum.getMonth(), datum.getDate()) - Date.UTC(danasnji.getFullYear(), danasnji.getMonth(), danasnji.getDate());

  if (rok.val() == "" || razlika < 0) {
    greske.push("Date nije ok");
    rok.addClass("border border-danger");
    let warning = `
          <small class="form-text text-muted" id="dateError">Date must be in the future</small>
      `;

    if ($("#dateError").length == 0) {
      $(warning).insertAfter("#date");
    }

  } else {
    rok.removeClass("border-danger");
    $("#dateError").remove();
  }

  if (plata.val() < 30000) {
    plata.addClass("border border-danger");
    greske.push("Plata ne moze manje od 30000");
    let warning = `
          <small class="form-text text-muted" id="plataError">Min Salary is 30000</small>
      `;

    if ($("#plataError").length == 0) {
      $(warning).insertAfter("#plata");
    }
  } else {
    plata.removeClass("border-danger");
    $("#plataError").remove();
  }


  if (greske.length == 0) {
    return true;
  } else {
    return false;
  }
}

function proveraKat() {
  let katNaziv = $("#katNaziv");
  let popular = $("#popular");

  let regexNaziv = /^[A-Z][A-z\.\s]{2,}$/;

  if (!regexNaziv.test(katNaziv.val())) {
    katNaziv.val("");
    katNaziv.attr("placeholder", "Category name");
    katNaziv.addClass("border border-danger");
    return false;
  } else {
    katNaziv.removeClass("border-danger");
  }

  let intPopular = Number(popular.val());

  console.log(intPopular);

  if (intPopular == 1 || intPopular == 0) {
    popular.removeClass("border-danger");
  } else {
    popular.val("");
    popular.attr("placeholder", "Chose 1/0");
    popular.addClass("border border-danger");
    return false;
  }

}

let dataObjError = {
  Name: "eg. Blake Smith",
  Email: "someone@example.com",
  Subject: "Title mail",
  Message: "Enter text message",
}

var greskeContact = [];
var podaciContact = [];

function proveriPolje(polje, regex) {
  let poljeId = polje.attr("id");
  if (!regex.test(polje.val())) {
    polje.css({
      'border': '2px solid #dc3545',
    });

    polje.val("");
    polje.attr("placeholder", dataObjError[poljeId]);
    greskeContact.push(poljeId + " nije ok");
  } else {
    polje.css({
      'border': '1px solid #e6e6e6'
    });
    podaciContact.push(polje.val());
  }
}


function proveraContact() {
  greskeContact = [];
  podaciContact = [];

  let ime = $('#Name');
  let mail = $('#Email');
  let subject = $("#Subject");
  let msg = $('#Message');

  var regexIme = /^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{2,20})*$/;
  var mailRe = /^\w([\.-]?\w+\d*)*@\w+\.\w{2,6}$/;
  var subjectRe = /^[A-Z][a-z]{2,}(\s[A-z\d]{2,})*$/;

  console.log(msg);

  proveriPolje(ime, regexIme);
  proveriPolje(mail, mailRe);
  proveriPolje(subject, subjectRe);

  if (msg.val() == '') {
    msg.css({
      'border': '2px solid #dc3545',
    });

    msg.val('')
    msg.attr('placeholder', 'Message can not be empty');
    greskeContact.push("Msg nije ok");
  } else {
    msg.css({
      'border': '1px solid #e6e6e6'
    });
    podaciContact.push(msg.val());
  }

  console.log(greskeContact);

  if (greskeContact.length == 0) {
    return true;
  } else {
    return false;
  }
}


function stampajModal() {
  let modal = `
  <div class="modal fade" id="viewMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
  
  `;

  $("body").append(modal);
  $("#viewMessage").modal();
  $("#viewMessage").css("opacity", "1");
  // $(".modal-backdrop").hide()
}


function stampajFormuZaPrijavu() {
  return `
  <form action="#" method="POST">
  <div class="row">
      
      <div class="col-md-12">
          <div class="input_field">
              <textarea name="#" id="message" cols="30" rows="10" placeholder="Enter message to Employee"></textarea>
          </div>
      </div>

      <div class="col-md-12">
          <div class="submit_btn">
              <button class="btn btn-primary" id="contactUser">Contact</button>
          </div>
      </div>
  </div>
</form>
  `;
}
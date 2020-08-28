/* MOJ KOD */ 

var lokacija = "";
$(document).ready(function() {
  lokacija = window.location.pathname;
  
  console.log(lokacija);

  if(lokacija == '/' || lokacija == ("/jobboard/index.php") || lokacija == "/jobboard/") {
    initIndex();

    let findJob = document.querySelector("#findJob");
    // findJob.addEventListener("click", filterJobs);
  }

  if(lokacija.indexOf("jobs.php") != -1) {
    let url = "Business/initIndex.php";
    initListe(url);

    // let filterDugme = document.querySelector("#filterJobs");
    // filterDugme.addEventListener("click", () => console.log("kliknuto"));
  }

  if(lokacija.indexOf("jobDetails") != -1) {
    let dugme = document.querySelector("#submitApply");

    dugme.addEventListener("click", handlePrijavu);
  }

  if(lokacija.indexOf("profile") != -1) {
    handleLink();
    
  }

  /* ZA ADMINA */
  if(lokacija.includes("/admin/") || lokacija.includes("index")) {
    let url = "../Business/initIndex.php";
    initListe(url);
    handleLink();

    $("#insertJob").hide();

    $("#addNew").hide();
    $("#addNew").click((e) => {
      e.preventDefault();
      $("#insertJob").fadeIn();
    });

  }

  if(lokacija.includes("editJob")) {

  }


});



function ajaxIndex(url, callback) {
  $.ajax({
    url: url,
    dataType: "json",
    success: callback,
    error: function(xhr, error, status) {
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
  ajaxIndex("Business/initIndex.php",function(data) {
    var lok = document.querySelector("#lokacije");

    populateDropdowns(lok, data.lokacije);
    
    var kats = document.querySelector("#kategorije");

    populateDropdowns(kats, data.kategorije);

    var popularList = document.querySelector("#popularSearch");


    populateList(popularList, data.popularneKat);

    var popularKatDiv = document.querySelector("#popularKats");

    populatePopularKats(popularKatDiv, data.popularneKat);

    var oglasiDiv = document.querySelector("#oglasi");
    let prvih = data.oglasi.slice(0, 6);
    populateJobs(oglasiDiv, prvih);

  })  
}

function initListe(url) {
  ajaxIndex(url, function(data) {
    var lokacije = document.querySelector("#lokacije");

    populateDropdowns(lokacije, data.lokacije);

    var kategorije = document.querySelector("#kategorije");

    populateDropdowns(kategorije, data.kategorije);

    var iskustvo = document.querySelector("#iskustvo");

    populateDropdowns(iskustvo, data.iskustvo);

    var tipPosla = document.querySelector("#tipPosla");

    populateDropdowns(tipPosla, data.tipovi);

    var oglasiDiv = document.querySelector("#oglasi");

    // populateJobs(oglasiDiv, data.oglasi);


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
    
    if(el.hasOwnProperty("Ime")) {
      output += `
      <option value="${el.Id}">${el.Ime}</option>
      `;
    } else if(el.hasOwnProperty("Grad")) {
      output += `
        <option value="${el.Id}">${el.Grad}</option>
      `;
    } else if(el.hasOwnProperty("Naziv")) {
      output += `
        <option value="${el.Id}">${el.Naziv}</option>
      `;
    } else if(el.hasOwnProperty("NazivTip")) {
      output += `
        <option value="${el.Id}">${el.NazivTip}</option>
      `;
    }
  }

  element.innerHTML += output;
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
                    <a href="job_details.html"><h4>${item.Naslov} @ ${item.nazivFirme}</h4></a>
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
                    <a class="heart_mark" href="#"> <i class="ti-heart"></i> </a>
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

  if(message.value.length < 10) {
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
    success: function(odg) {
      if(odg == "Uspelo") {
        alert("You have successfully applied for this job");
      }
    },
    error: function(xhr, error, status) {
      console.log(xhr, error, status);
    }
  })

}




/* ADMIN FUNKCIJE */

var ispisTabele = `
  <table class="table table-striped table-sm" id="tabela">
    <thead id="head">
        
    </thead>
    <tbody id="data">
        
    </tbody>
  </table>
`;

function handleLink() {
  $(".link").click(function(e) {
      e.preventDefault();

      $("#mainContent").html(ispisTabele);
      
      let key = $(this).attr("href").split("=")[1];
      $("#pageTitle").html(key);
      let tableHead = "";
      if(key == "jobs") {
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

          $("#addNew").show();
      }

      if(key == "categories") {
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

      if(key == "myjobs") {
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

      if(key == "applications") {
        tableHead = `
              <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>User Name</th>
                  <th>User Cv</th>
                  <th>Edit</th>
                  <th>Delete</th>
              </tr>
                  
          `;
        prikaziPrijave();
      }

      $("#head").html(tableHead);
  });
}

function prikaziPoslove() {
  // ajaxIndex(("../Business/initIndex.php", data) => { stampajPoslove(data.oglasi)});

  let url = "../Business/initIndex.php";

  ajaxIndex(url, data => {
    stampajPoslove(data.oglasi)
  });
}

function prikaziKomPoslove() {
  let url = "Business/jobsByCompany.php";

  ajaxIndex(url, data => {
    stampajPoslove(data.firmaOglasi);
  });
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
              <td>Edit</td>
              <td>Delete</td>
          </tr>
  `;
  }

  $("#data").html(out);
}

function prikaziPrijave() {
  let url = "Business/jobsByCompany.php";

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
                  <a href="${el.Cv}">User Cv </a>
              </td>
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

function proveraFormeZaPosao() {
  
}

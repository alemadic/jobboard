window.onload = function() {

    inicijalnoUcitavanje();

}

var selKat = document.querySelector("#kats");
var xhr = new XMLHttpRequest();

function inicijalnoUcitavanje() {

    xhr.open("GET", "Business/getOglase.php", true);

    xhr.send("oglasi");

    xhr.onload = function() {
        let output = '';
        let outputKategorije = "";
        var data = JSON.parse(this.response);
        prikaziOglase(data.oglasi);
        // for (let el of data.oglasi) {
        //     output += `
        //         <div class="item">
        //             <h1>
        //                 ${el.Naslov}
        //             </h1>

        //             <p>
        //                ${el.Opis}
        //             <p>
        //                 ${el.Plata}
        //             </p>
        //         </div>
        //     `;
        // }

        // var oglasi = document.querySelector("#oglasi");

        // oglasi.innerHTML = output;

        for (let el of data.kategorije) {
            outputKategorije += `
                <option value="${el.Id}">${el.Ime}</option>
            `;
        }

        selKat.innerHTML += outputKategorije;

        selKat.addEventListener("change", promeniKategoriju);
    }
}

function prikaziOglase(oglasi) {
    let output = '';

    for (let el of oglasi) {
        output += `
            <div class="item">
                <h1>
                    ${el.Naslov}
                </h1>

                <p>
                   ${el.Opis}
                <p>
                    ${el.Plata}
                </p>
            </div>
        `;
    }

    var oglasi = document.querySelector("#oglasi");

    oglasi.innerHTML = output;   
}

function promeniKategoriju() {
    let idKat = this.value;

    xhr.open("GET", "Business/getOglase.php", true);

    xhr.send("oglasi");

    xhr.onload = function() {
        var data = JSON.parse(this.response);
        
        let oglasiKat = data.oglasi.filter(x => x.Id == idKat);

        if(idKat == 0) {
            prikaziOglase(data.oglasi);
        } else {
            prikaziOglase(oglasiKat);
        }
        
    }
}



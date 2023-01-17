const lhp ="http://localhost/VAII_SEM_2/index.php"
var clicked = false;
var nacitava=false;
window.onload = function () {
    const form = document.getElementById("form");
    if (form !== null) {
        form.addEventListener('submit', (e) => {
            let messages = []
            const username = document.getElementById("username");
            const password = document.getElementById("password");
            const errorEl = document.getElementById("error");
            const gpw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,24}$/;
            if (username.value === '' || username.value == null) {
                messages.push("Username pole nemože byť prázdne")
            } else {
                if (username.value.length < 5) {
                    messages.push("Username pole musí mať minimálne 5 znakov")
                }
                if (username.value.length > 15) {
                    messages.push("Username pole musí mať maximálne 15 znakov")
                }
            }
            if (password.value === '' || password.value == null) {
                messages.push("Pole heslo nemože byť prázdne")
            } else {
                if (password.value.length < 8) {
                    messages.push("Heslo pole musí mať minimálne 8 znakov")
                }
                if (!password.value.match(gpw)) {
                    messages.push("Heslo musí obsahovať aspoň jedno malé a veľké písmeno,číslo a špecialny znak.Heslo musí mať minimalne 8 znakov a najviac 25")
                }
            }
            if (messages.length > 0) {
                e.preventDefault()
                errorEl.innerText = messages.join(".");
            }
        })
    }
    if (window.location.href === lhp + "?c=animals") {
        document.getElementById("AJ").addEventListener('click', () => {
            errorEl = document.getElementById("error");
            meno = document.getElementById("name");
            date = document.getElementById("birth");
            weight = document.getElementById("weight");
            letters = /^[A-Za-z].{2,14}$/;
            dd = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
            let messages = [];
            if (!meno.value.match(letters)) {
                messages.push("Meno musi obsahovať iba písmena, v rozsahu 3-15")
            }
            if (date.value === '' || date.value == null) {
                messages.push("Pole dátumu nemože byť prázdne")
            } else {
                if (!date.value.match(dd)) {
                    messages.push("Zlý dátum")
                } else {
                    let datum = date.value.split("-");
                    if (datum[0] < 1940 || datum[0] > new Date().getFullYear() - 1) {
                        messages.push("Minimálny rok je 1940 a maximálny je o rok menej ako momentálny dátum!")
                    }
                }
            }
            if (weight.value === '' || weight.value == null) {
                messages.push("Pole s váhou nemože byť prázdne")

            } else {
                if (isNaN(weight.value)) {
                    messages.push("Pole s váhou musí byť číslo")
                }
                if (weight.value < 1 && weight.value > 900) {
                    messages.push("Váha musí byť v rozmedzí 1-900")
                }
            }
            if (messages.length > 0) {
                errorEl.innerText = messages.join(".") + ".";
            }
        })
    }
    if (window.location.href === lhp + "?c=owner") {
        document.getElementById("user_editB").addEventListener('click', () => {
            errorEl = document.getElementById("error");
            meno = document.getElementById("user_meno");
            priezvisko = document.getElementById("user_priezvisko");
            email = document.getElementById("user_email");
            mesto= document.getElementById("user_mesto");
            letters = /^[A-Za-z].{2,14}$/;
            email_v=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
            let messages = [];
            if(meno.value !=="" && !meno.value.match(letters)) {
                messages.push("Meno musi obsahovať iba písmena, v rozsahu 3-15")
            }
             if(priezvisko.value !=="" && !priezvisko.value.match(letters)) {
                messages.push("Priezvisko musi obsahovať iba písmena, v rozsahu 3-15")
            }
            if(mesto.value !=="" && !mesto.value.match(letters)) {
            messages.push("Mesto musi obsahovať iba písmena, v rozsahu 3-15")
            }
            if (email.value!== "" && !email.value.match(email_v)) {
                messages.push("Nesprávny email")
            }
            if (messages.length > 0) {
                errorEl.innerText = messages.join(".") + ".";
            }
        })
    }
    if (window.location.href === lhp + "?c=home" &&  document.getElementById("homebtn")!== null) {
        document.getElementById("foot").style.marginTop="50px"
        document.getElementById("homebtn").onclick = function () {
            window.location.href = lhp+"?c=auth&a=login";
        };
    }
}
if (window.location.href === lhp+"?c=animals" ) {
    class Animals {
        constructor() {
            document.getElementById("AJ").onclick = () => this.addAnimal();
            this.reloadData()
        }

        async deleteAnimal(number) {
            if (confirm("Naozaj chcete odstraniť zviera?")) {
                try {
                    let response = await fetch("?c=animals&a=delete", {
                        method: 'POST',
                        headers: {
                            'Content-Type': "application/json",
                        },
                        body: JSON.stringify({
                            id: number.value
                        })
                    });
                    let vymazane = await response.json()
                    if (vymazane === "Deleted") {
                        await this.reloadData();
                     } else {
                        document.getElementById("error").innerText = "Skušate sa vymazať zviera ktoré vám nepatrí";
                     }
                } catch (e) {
                    console.error('Chyba: ' + e.message);
                }
            }
        }

        async getAnimals() {
            try {
                let response = await fetch("?c=animals&a=animals");
                let data = await response.json();
                var tabulka = document.getElementById("spec");
                var html = ` <thead>
                             <th>Meno</th>
                             <th>Dátum narodenia</th>
                             <th>Váha</th>
                             <th>Akcie</th>
                             </thead>`;
                if (data.length !== 0) {
                    data.forEach((animal) => {
                        html += `
                                  <tr>
                                    <td>${animal.name} </td>
                                    <td>${animal.day_of_birth}</td>
                                    <td>${animal.weight}</td>
                                    <td>
                                        <button value="${animal.id}" id="edit${animal.id}" onclick="zviera.editAnimal(${"edit" + animal.id})" title="Edit" data-toggle="tooltip"><i class="bi bi-pencil-fill"></i></i></a>
                                        <button value="${animal.id}"  id="delete${animal.id}" onclick="zviera.deleteAnimal(${"delete" + animal.id})"  title="Delete" data-toggle="tooltip"><i class="bi bi-x-circle-fill"></i></button>

                                    </td>
                                  </tr>`
                    });
                }
                tabulka.innerHTML = html;
            } catch
                (e) {
                console.error('Chyba: ' + e.message);
            }
        }

        async addAnimal()
            {
                try {
                    let response = await fetch("?c=animals&a=store", {
                        method: 'POST',
                        headers: {
                            'Content-Type': "application/json",
                        },
                        body: JSON.stringify({
                            meno: document.getElementById("name").value,
                            birth: document.getElementById("birth").value,
                            weight: document.getElementById("weight").value,
                            id: (document.getElementById("AJ").value ? document.getElementById("AJ").value : null)
                        })

                    });
                    let odpoved = await response.json()
                    if (odpoved === "ok") {
                        document.getElementById("name").value = "";
                        document.getElementById("birth").value = "";
                        document.getElementById("weight").value = "";
                        document.getElementById("AJ").value = "";
                        setter();
                        await this.reloadData();
                    } else {
                        document.getElementById("error").innerText += odpoved.test;
                    }
                } catch (e) {
                    console.error('Chyba: ' + e.message);
                }
        }
        async reloadData() {
            await this.getAnimals();
        }

        async editAnimal(number) {
            try {
                let response = await fetch("?c=animals&a=edit", {
                    method: 'POST',
                    headers: {
                        'Content-Type': "application/json",
                    },
                    body: JSON.stringify({
                        id: document.getElementById(number.id).value
                    })
                });
                let n = await response.json()
                if (n !== "Something went wrong") {
                    document.getElementById("name").value = n.name;
                    document.getElementById("birth").value = n.day_of_birth;
                    document.getElementById("weight").value = n.weight;
                    document.getElementById("AJ").value = n.id;
                    if (!clicked) setter()
                } else {
                    document.getElementById("error").innerText = "Skušate sa editnut zviera ktoré vám nepatrí alebo neexistuje";
                }
            } catch (e) {
                console.error('Chyba: ' + e.message);
            }
        }
    }

    function  setter()
    {
        if (clicked)
        {
            clicked=false;
            document.getElementById("on").style.display="none";
            document.getElementById("error").innerText="";

        } else
        {
            clicked=true;
            document.getElementById("on").style.display="flex";
        }
    }
    var zviera;

    document.addEventListener(
        'DOMContentLoaded', () => {
            zviera = new Animals();
        }, false)
}
    class User {
        constructor() {
            if(window.location.href === lhp+"?c=owner")
            document.getElementById("user_editB").onclick = () => this.editUser();
        }
        async editUser() {
            try {
                let response = await fetch("?c=owner&a=edit", {
                    method: 'POST',
                    headers: {
                        'Content-Type': "application/json",
                    },
                    body: JSON.stringify( {
                        meno_user: document.getElementById("user_meno").value,
                        priezvisko_user: document.getElementById("user_priezvisko").value,
                        email_user: document.getElementById("user_email").value,
                        mesto_user: document.getElementById("user_mesto").value,
                        id_user: document.getElementById("user_editB").value
                    })
                });
                let user = await response.json()
                if (user !== "Something went wrong") {
                    document.getElementById("user_meno").value ="";
                    document.getElementById("user_priezvisko").value = "";
                    document.getElementById("user_email").value = "";
                    document.getElementById("user_mesto").value = "";
                    document.getElementById("user_meno").placeholder = user.first_name;
                    document.getElementById("user_priezvisko").placeholder = user.last_name;
                    document.getElementById("user_email").placeholder = user.email;
                    document.getElementById("user_mesto").placeholder = user.city;
                }
            } catch (e) {
                console.error('Chyba: ' + e.message);
            }
        }

      async deleteUser(id) {
            if (confirm("Naozaj chcete odstraniť uživateľa?")) {
                try {
                    let response = await fetch("?c=owner&a=uzivatelia&a=delete", {
                        method: 'POST',
                        headers: {
                            'Content-Type': "application/json",
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    });
                    let n = await response.json()
                    if (n === "Deleted") {
                        await this.nacitajVsetkych();
                    }
                } catch (e) {
                    console.error('Chyba: ' + e.message);
                }
            }
        }

        async nacitajVsetkych() {
            try {
                let response = await fetch("?c=owner&a=owners&a=getUsers");
                let data = await response.json();
                var html = ` `
                data.forEach((userr) => {
                    html += `
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    ${userr.username}| ${userr.first_name}| ${userr.last_name}|
                                    <button onclick="user.deleteUser(${userr.id})"  title="Delete" data-toggle="tooltip"><i class="bi bi-x-circle-fill"></i></button>
                                </li>`
                });
                document.getElementById("list").innerHTML = html;
            }
            catch (e) {
                console.log("Chyba: " + e)
            }
        }
    }
    var user;
    document.addEventListener(
        'DOMContentLoaded', () => {
            user = new User();
        }, false)


if (window.location.href === lhp+"?c=matches" ) {
    clicked = false;
    class Matches {
        constructor() {
            document.getElementById("search").oninput = () => this.getMatches();
            document.getElementById("searching").onclick = () => this.getMatches();
            document.getElementById("nadchadzajuce").onchange = () => this.getMatches();
            setInterval(() => {
               this.reloadData()
            }, 60000);

        }

        async getMatches() {
            var  vyhladac= document.getElementById("search");
            clicked=false;
            if (!nacitava) {
                nacitava = true;
                try {
                    let response = await fetch("?c=matches&a=matches", {
                        method: 'POST',
                        headers: {
                            'Content-Type': "application/json",
                        },
                        body: JSON.stringify({
                            vyhladaj: vyhladac.value,
                            checked : document.getElementById("nadchadzajuce").checked
                        })
                    });
                    let data = await response.json();
                    console.log(data);
                    var tabulka = document.getElementById("spec");
                    var html = ` <thead>
                                    <th>Nazov</th>
                                    <th>Mesto</th>
                                    <th>Dátum</th>
                                 </thead>`;
                    if (data.length !== 0) {
                        data.forEach((match) => {
                            html += `
                                     <tr data-value="${match.id}" onClick=zapas.getInfo(this)>
                                        <td>${match.name} </td>
                                        <td>${match.city}</td>
                                        <td>${match.date}</td>
                                        </td>
                                     </tr>`
                        });
                    }
                    tabulka.innerHTML = html;
                    nacitava=false;
                } catch
                    (e) {
                    console.error('Chyba: ' + e.message);
                }
            }
        }

        async getNameOfAnimal(id)
        {
            try {
                let response = await fetch("?c=matches&a=nameofanimal", {
                    method: 'POST',
                    headers: {
                        'Content-Type': "application/json",
                    },
                    body: JSON.stringify( {
                        id: id
                    })
                });
                let meno = await response.json();
                return  meno;
            } catch
                (e) {
                console.error('Chyba: ' + e.message);
            }
        }

        async getInfo(par) {
            var tabulka = document.getElementById("spec");
            if ((!par.dataset.value.includes('p')) && !clicked) {

                var html = ``;
                clicked = true;
                try {
                    let response = await fetch("?c=matches&a=info", {
                        method: 'POST',
                        headers: {
                            'Content-Type': "application/json",
                        },
                        body: JSON.stringify({
                            id: par.dataset.value
                        })
                    });
                    let data = await response.json()
                    if (data !== "Nothing") {
                        let header = tabulka.insertRow(par.rowIndex + 1);
                        header.innerHTML = ` 
                                            <tr>
                                                <th>Umiestnenie</th>  
                                                <th>Výhra</th>  
                                                <th>Meno zvieraťa</th>  
                                            </tr>`
                        header.style.backgroundColor = "#cfd7ff";
                        let row1 = tabulka.insertRow(par.rowIndex + 2);
                        let row2 = tabulka.insertRow(par.rowIndex + 3);
                        let row3 = tabulka.insertRow(par.rowIndex + 4);
                        var pocet = 1;
                        for (const info of data) {
                            let meno = await this.getNameOfAnimal(info.id_zvierata);
                            html = ` 
                                    <tr>
                                          <td>${info.placement} </td>  
                                          <td>${info.prize} </td>  
                                          <td>${meno} </td>  
                                    </tr> `
                            if (pocet === 1) {
                                row1.innerHTML += html;
                                row1.style.backgroundColor = "lightgray";
                            } else if (pocet === 2) {
                                row2.innerHTML += html;
                                row2.style.backgroundColor = "lightgray";
                            } else {
                                row3.innerHTML += html;
                                row3.style.backgroundColor = "lightgray";
                            }
                            pocet++;
                        }
                        par.dataset.value ="p" + par.dataset.value;
                    }
                } catch (e) {
                    console.error('Chyba: ' + e.message);
                }
            } else if (par.dataset.value.includes('p') && clicked)
            {
                for (let i = 1; i < 5; i++) {
                    tabulka.deleteRow(par.rowIndex+1);
                }
                par.dataset.value =  par.dataset.value.substring(1);
                clicked =false;
            }
        }

        async reloadData() {
            await this.getMatches();
        }

    }

    var zapas;

    document.addEventListener(
        'DOMContentLoaded', () => {
            zapas = new Matches();
        }, false)
}
if (window.location.href === lhp+"?c=evaluations" ) {
    class Evaluations {
        constructor() {
            document.getElementById("selectors").addEventListener("change", () => this.getHodnotenia())
            document.getElementById("pridajHodnotenie").onclick = () => this.addHodnotenie();
            document.getElementsByClassName("bi bi-star-fill")
            setInterval(() => {
                this.reloadData()
            }, 60000);
        }

        async getHodnotenia() {
            try {
                let response = await fetch("?c=evaluations&a=hodnotenia", {
                    method: 'POST',
                    headers: {
                        'Content-Type': "application/json",
                    },
                    body: JSON.stringify({
                       selected: document.getElementById("selectors").value
                    })
                });
                let data = await response.json();
                    var html = ``
                    var deleteE;
                if (data.length !== 0) {
                    data.forEach((zapasf) => {
                        if (zapasf.jeVlastnik!=="")
                        {
                            deleteE="Odstrániť"
                        }
                        else
                        {
                            deleteE=""
                        }
                        html += `
                                 <div class="row gutters-sm  pt-5" >
                                     <div class="col-md-8">
                                         <div class="card mb-3" ">
                                             <div class="card-body ">
                                                <div class="row">
                                                    <h2>Uživateľ ${zapasf.username} napísal: ${zapasf.title}</h2>
                                                    <div data-value="${zapasf.star}" id="hviezdičky">
                                                        ${getstarstinE(zapasf.star)}
                                                    </div>
                                                     <p> ${zapasf.comment}</p>
                                                </div>
                                                <hr>
                                                <span>
                                                <a data-value="${zapasf.id}" onclick="hodnotenia.delete(this)">${deleteE}&nbsp</a>
                                                <a data-value="${zapasf.id}" onclick="hodnotenia.editH(this)">${zapasf.jeVlastnik}&nbsp</a> Vytvorené: ${zapasf.date_created}
                                                </span>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                <hr>`
                    });
                    document.getElementById("hodnotenia").innerHTML =html;
                } else {
                    document.getElementById("hodnotenia").innerHTML = '<h2>Žiadne hodnotenie sa nenašlo</h2>';
                }
            } catch (e) {
                    console.error('Chyba: ' + e.message);
                }
            }

        async delete(id) {
            if (confirm("Naozaj chcete odstraniť hodnotenie?")) {
                try {
                    let response = await fetch("?c=evaluations&a=delete", {
                        method: 'POST',
                        headers: {
                            'Content-Type': "application/json",
                        },
                        body: JSON.stringify({
                            id: id.dataset.value
                        })
                    });
                    let n = await response.json()
                    if (n === "Deleted") {
                        console.log("Deleted")
                        await this.reloadData();
                    } else {
                        console.log("nope not deleted")
                        document.getElementById("error").innerText = "Skušate sa vymazať hodnotenie ktoré vám nepatrí";
                    }
                } catch (e) {
                    console.error('Chyba: ' + e.message);
                }
            }
        }


        async addHodnotenie()
        {
            try {
                let response = await fetch("?c=evaluations&a=addEvaluation", {
                    method: 'POST',
                    headers: {
                        'Content-Type': "application/json",
                    },
                    body: JSON.stringify( {
                        id:  document.getElementById("pridajHodnotenie").value,
                        selected: document.getElementById("selectorForAdd").value,
                        title: document.getElementById("nadpis").value,
                        comment: document.getElementById("koment").value,
                        star : document.getElementById("stars").dataset.value
                    })
                });
                let data  = await response.json();
                setErrors(data)
                if(document.getElementById("error").innerText==="")
                {
                    clearInputs()
                    addH();
                    await this.reloadData();
                }
            } catch
                (e) {
                console.error('Chyba: ' + e.message);
            }
        }

        async editH(id_e)
        {
            try {
                let response = await fetch("?c=evaluations&a=hodnotenie", {
                    method: 'POST',
                    headers: {
                        'Content-Type': "application/json",
                    },
                    body: JSON.stringify( {
                        id:  id_e.dataset.value
                    })
                });
                let data  = await response.json();
                    document.getElementById("nadpis").value =data.title;
                    document.getElementById("koment").value = data.comment;
                    document.getElementById("selectorForAdd").value = data.id_match;
                    document.getElementById("pridajHodnotenie").value =id_e.dataset.value;
                    document.getElementById("stars").dataset.value=data.star;
                    setStars( document.getElementById("stars"));
                document.getElementById("error").innerText = "";
                addH();
            } catch
                (e) {
                console.error('Chyba: ' + e.message);
            }
        }

        async reloadData() {
            await this.getHodnotenia()
        }
    }

   function  setErrors(obj)
   {
     var error = document.getElementById("error");
     error.innerText="";

       if(obj.title === null)
       {
         error.innerText+= "Pole s nadpisom nemôže byť prázdne! ";
       }
       else if (obj.comment===null)
       {
           error.innerText+= "Pole s komentárom nemôže byť prázdne! ";
       }
       else if (obj.id_match===null)
       {
           error.innerText+= "Vyberte zápas";
       }
       else if (obj.star===null)
       {
           error.innerText+= "Zadajte hodnotenie! ";
       }
        else if (obj.user_id===null)
       {
           error.innerText+= "Hodnotenie pre daný zápas už je vytvorené! ";
       }

   }

   function getstarstinE(number){
        var html =``
       number++
       for (let i = 0; i < number; i++) {
           html+= `<i class="bi bi-star-fill checked"></i>`
       }
       for (let i = number; i < 5; i++) {
           html+= `<i class="bi bi-star-fill "></i>`
       }
        return html;
   }
   function  setStars(element)
   {
       var html =``
       var pocetcelkovych =5
       var  pocetdanych = element.dataset.value
       pocetdanych++
       for (let i = 0; i < pocetdanych ; i++) {
            html += `
                    <i data-value="${i}"  onclick=setStars(this) class="bi bi-star-fill checked"></i>                
                    `
       }
       for (let i = pocetdanych ;i < pocetcelkovych ; i++) {
           html += `
                    <i data-value="${i}"  onclick=setStars(this) class="bi bi-star-fill "></i>                     
                    `
       }
        pocetdanych--
       document.getElementById("stars").innerHTML=html;
       document.getElementById("stars").dataset.value = pocetdanych;

   }
   var hodnotenia;

    document.addEventListener(
        'DOMContentLoaded', () => {
           hodnotenia = new Evaluations();
        }, false)

    function  addH()
    {
        if (clicked)
        {
            clicked=false;
            document.getElementById("selectorf").style.display="block";
            document.getElementById("hodnotenia").style.display="block";
            document.getElementById("pridavanie").style.display="none";
        } else
        {
            clicked=true;
            document.getElementById("pridavanie").style.display="block";
            document.getElementById("selectorf").style.display="none";
            document.getElementById("hodnotenia").style.display="none";
        }
    }
}

function clearInputs() {
    if (window.location.href === lhp+"?c=animals") {
        document.getElementById("name").value = "";
        document.getElementById("birth").value = "";
        document.getElementById("weight").value = "";
        document.getElementById("AJ").value = "";
    } else {
        document.getElementById("error").innerText = "";
        document.getElementById("nadpis").value ="";
        document.getElementById("koment").value = "";
        document.getElementById("selectorForAdd").value = 0;
        document.getElementById("pridajHodnotenie").value ="";
        document.getElementById("stars").dataset.value="0";
        setStars( document.getElementById("stars"));
    }
}


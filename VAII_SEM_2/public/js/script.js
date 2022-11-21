window.onload = function () {
    const form = document.getElementById("form");
    const formc = document.getElementById("formc");


    if (form !== null) {

        form.addEventListener('submit', (e) => {
            let messages = []
            const username = document.getElementById("username");
            const password = document.getElementById("password");
            const errorEl = document.getElementById("error");
            const  gpw =/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,24}$/;
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
    if (formc != null) {
        formc.addEventListener('submit', (e) => {
            const errorEl = document.getElementById("error");
            const meno = document.getElementById("meno");
            const date = document.getElementById("date");
            const weight = document.getElementById("weight");
            const letters = /^[A-Za-z].{2,14}$/
            const dd = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/
            let messages = []


            if (!meno.value.match(letters)) {
                messages.push("Meno musi obsahovať iba písmena, v rozsahu 3-15")
            }
            if (date.value === '' || date.value == null) {
                messages.push("Pole dátumu nemože byť prázdne,použite format YYYY-MM-DD")

            } else {

                if (!date.value.match(dd)) {
                    messages.push("Zlý dátum- format je YYYY-MM-DD")

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
                e.preventDefault()
                errorEl.innerText = messages.join(".");
            }
        })
    }
}

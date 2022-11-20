window.onload = function () {
     const username = document.getElementById('username');
     const password = document.getElementById('password');
    const  gpw =/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,25}$/;

    form.addEventListener('submit', (e) => {
        let messages = []
        messages.push(username.value.length)
        messages.push(meno.value.length)

        if (username.value === '' || username.value == null) {
            messages.push("Username pole nemože byť prázdne")
        }else {

            if (username.value.length < 5) {
                messages.push("Username pole musí mať minimálne 5 znakov")
            }
            if (username.value.length > 15) {
                messages.push("Username pole musí mať maximálne 15 znakov")
            }
        }
        if (password.value === '' || password.value == null) {
            messages.push("Pole heslo nemože byť prázdne")
        }
        else {

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
window.onload = function () {
    const formc = document.getElementById("formc");
    const errorEl = document.getElementById("error");
    const  meno = document.getElementById("meno");
    const  date = document.getElementById("date");
    const  weight = document.getElementById("weight");
    const letters = /^[A-Za-z].{3,15}$/

    function dateIsValid(d) {
        return d instanceof Date && !isNaN(d);
    }
    formc.addEventListener('submit', (e) => {

        let messages = []


      if (!meno.value.match(letters))
      {
         messages.push("Meno musi obsahovať iba písmena, v rozsahu 3-15")
      }
    if (!dateIsValid(date.value))
    {
        messages.push("test")

    } else if (!dateIsValid(new Date(date.value)))
    {
        messages.push("povedz ty")

    }


if (weight.value === '' || weight.value == null) {
    messages.push("Pole s váhou nemože byť prázdne")

}else
{
    if (isNaN(weight.value))
    {
        messages.push("Pole s váhou musí byť číslo")

    }
    if (weight.value <1 && weight.value > 900)
    {
        messages.push("Váha musí byť v rozmedzí 1-900")

    }
}
    if (messages.length > 0) {
        e.preventDefault()
        errorEl.innerText = messages.join(".");
    }
})

}
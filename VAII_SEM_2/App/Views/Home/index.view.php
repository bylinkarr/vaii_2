<?php
$layout = 'root';
/** @var \App\Core\IAuthenticator $auth */

?>
<div class="title-img">
    <div  class="title-text">
        <span>Vitajte!</span>
    </div>
    <div>
        <?php if (!$auth->isLogged()) { ?>
            <p class="under-text">Vytvorte si účet, pridajte si svoje zviera, pozrite si zoznam zápasov a mnoho ďalšieho. Neváhajte
                a pridajte sa k nám ešte dnes.</p>
        <?php } ?>
    </div>
    <?php if (!$auth->isLogged()) { ?>
        <button class="title-button" id="homebtn">Pridať sa !</button>
    <?php } ?>
</div>
    <div class="flex">
        <div class="img-left" >
            <img class="nn" src="public/images/horse.jpg" alt="horse">
        </div>
        <div class= "s">
            <h1 class="nadpis1">
                O nás
            </h1>
            <p class="right-text">Sme nezisková organizácia pre preteky zvierat. Založená v roku 1994 skupinov
                nadšených psíčkarov.Zkupujeme sa vo veľkom množstve, plných priateľských
                ľudí a milovnikov zvierat. Zápasy prebiehajú po celom Slovensku bez potreby zaplatiť nejaké štartovné. Pomocou tejto
                webstránky by sme chceli dať o nás vedieť a zároveň vedieť aj vašu odozvu na nás. V budúcnosti očkavajte oveľa viac noviniek.
                Pre viac informácii sa prosím prihláste alebo registrujte. V mene celého GG tímu Vám prajeme pekný deň!</p>

        </div>
</div>


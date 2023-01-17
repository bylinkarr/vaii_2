<?php
$layout = 'root';
/** @var Array $data */
?>
<div class="tb">
    <h2 class="nadpis1">Pridávanie zápasov</h2>
    <p class="right-text">Na tejto stránke možete vytvoriť zápas</p>
     <div id="error" class="text-center text-danger mb-3">
         <?= @$data['message'] ?>
     </div>
     <form id="formc" class="form-signin p-5 " method="post" action="?c=matches&a=create">
         <label for="title_konanie">Nazov zápasu:</label>
         <input name="title_konanie" type="text" id="title_konanie" class="form-control" placeholder="Name" >
         <label for="date_konanie">Dátum konania: </label>
         <input name="date_konanie" type="date" id="date_konanie" class="form-control" placeholder="Dátum konania" >
         <label for="city_konanie">Mesto: </label>
         <input name="city_konanie" type="text" id="city_konanie" class="form-control" placeholder="Mesto" >
         <label for="vyhra1">Výhra za 1. miesto:</label>
         <input name="vyhra1" type="number" id="vyhra1" class="form-control" placeholder="Výhra za 1. miesto" >
         <label for="vyhra2">Výhra za 2.miesto:</label>
         <input name="vyhra2" type="number" id="vyhra2" class="form-control" placeholder="Výhra za 2. miesto" >
         <label for="vyhra3">Výhra za 3 miesto:</label>
         <input name="vyhra3" type="number" id="vyhra3" class="form-control" placeholder="Výhra za 3. miesto" >
         <button  class="btn btn-primary m-3" id ="add_match" type="submit" name="submit" >Pridať zápas </button>
     </form>
 </div>

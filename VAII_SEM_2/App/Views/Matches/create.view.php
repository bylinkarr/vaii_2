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
         <button  class="btn btn-primary m-3" id ="add_match" type="submit" name="submit" >Pridať zápas </button>
     </form>
 </div>

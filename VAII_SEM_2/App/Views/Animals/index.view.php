<div class="tb">
    <h2 class="nadpis1">Zoznam zvierat</h2>
    <p class="right-text">Na tejto stránke vidíte svoje zvieratá</p>
    <button type="button" id="addAnimal" onclick="setter()"  class="btn btn-info m-2" >Pridaj</button>
        <div id="error" class="text-center text-danger mb-3"></div>
    <div class="addAnimalInput" id="on"  style="display: none">
            <label for="name">Meno </label>
            <input name="name" type="text" id="name" class="form-control" placeholder="Name" >
            <label for="birth">Dátum narodenia </label>
            <input name="birth" type="date" id="birth" class="form-control" placeholder="Birth" >
            <label for="weight">Váha </label>
            <input name="weight" type="number" id="weight" class="form-control" placeholder="Weight" >
            <button id="AJ" value="" ><i class="bi bi-check-circle-fill"></i></button>
            <button id="delete-animal" onclick="clearInputs()" value="" title="Delete" data-toggle="tooltip"><i class="bi bi-x-circle-fill"></i></button>
    </div>
    <div class="tbb">
    <table id="spec" class="tabulka">
    </table>
    </div>
</div>




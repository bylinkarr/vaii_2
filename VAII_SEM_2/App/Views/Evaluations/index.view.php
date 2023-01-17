<?php
$layout = 'root';
/** @var \App\Models\Tournament $data */
?>
<div class="tb" >
    <h2 class="nadpis1">Hodnotenia</h2>
    <p class="right-text">Na tejto stránke vidíte vaše hodnotenia a hodnotenia ostatných</p>
    <button type="button" id="addHodnotenie" onclick="addH()"  class="btn btn-info m-2" >Pridajte hodnotenie</button>
    <div class="my-3" id="selectorf">
        <label for="selectors">Select</label>
        <select name="zapasy" id="selectors" onselect="this.getHodnotenia()">
            <option value="0">Vyberte možnosť..</option>
            <?php foreach ($data as $zapas)  {?>
                <option value="<?php echo $zapas->getId() ?>"> <?php echo $zapas->getName()?></option>
            <?php }?>
        </select>
    </div>
    <div id="pridavanie" style="display: none">
        <div id="error" class="text-center text-danger mb-3"></div>
        <label for="nadpis">Nadpis hodnotenia: </label>
        <input name="nadpis" type="text" id="nadpis" class="form-control" placeholder="Nadpis hodnotenia" >
        <label for="koment">Komentár </label>
        <textarea name="koment"  id="koment" class="form-control" placeholder="Zadajte komentár.." ></textarea>
        <div class="m-3">
        <label for="selectorsForAdd">Vyberte zápas:</label>
        <select name="zapasy" id="selectorForAdd" onselect="this.getHodnotenia()">
            <option value="0">Vyberte možnosť..</option>
            <?php foreach ($data as $zapas)  {?>
                <option value="<?php echo $zapas->getId() ?>"> <?php echo $zapas->getName()?></option>
            <?php }?>
        </select>
        </div>
        <div class="hviezdy">
            <label class="mx-3">Hodnotenie:</label>
            <div id="stars">
                <i data-value="0"  onclick=setStars(this) class="bi bi-star-fill checked"></i>
                <i data-value="1"  onclick=setStars(this) class="bi bi-star-fill"></i>
                <i data-value="2"  onclick=setStars(this) class="bi bi-star-fill"></i>
                <i data-value="3"  onclick=setStars(this) class="bi bi-star-fill"></i>
                <i data-value="4"  onclick=setStars(this) class="bi bi-star-fill"></i>
            </div>
        </div>
        <div class="edit">
        <button id="pridajHodnotenie" value="" ><i class="bi bi-check-circle-fill"></i></button>
        <button id="delete-animal" onclick="clearInputs()" value="" title="Delete" data-toggle="tooltip"><i class="bi bi-x-circle-fill"></i></button>
        </div>
    </div>
    <div id="hodnotenia">
    </div>
</div>

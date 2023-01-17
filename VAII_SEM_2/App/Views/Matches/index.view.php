<div class="tb">
    <h2 class="nadpis1">Zoznam zápasov</h2>
    <p class="right-text">Na tejto stránke sa dá vyhľadať zoznam pretekov , ktoré už boli alebo len budú</p>
    <div class="pwd m-3">
        <label for="search">Vyhľadavanie:</label>
        <input name="search"  type="search" id="search" oninput="getMatches()" class="form-control" placeholder="Vyhľadaj.." >
        <label for="nadchadzajuce">Nadchadzajúce:</label><br>
        <input type="checkbox" id="nadchadzajuce" name="nadchadzajuce">
        <button type="button" value="0" id="searching"  class="btn btn-info m-2" >Hľadaj</button>
    </div>
    <div class=" tbb">
        <table class="tabulka" id="spec"></table>
    </div>
</div>
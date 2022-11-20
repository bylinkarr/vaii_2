
<div class="text-center p-5 ">
    <form id="formc" class="form-signin p-5 " method="post" action="?c=animals&a=store">
        <img class="img_logo" src="public/images/logo.png" title="<?= \App\Config\Configuration::APP_NAME ?>">
        <h1 class="h3 mb-3 font-weight-normal">Pridanie nového zvieraťa</h1>
        <?php
        /** @var \App\Models\Animal $data */
        if(!isset($data->text))
        {
         ?>
        <div id="error" class="text-center text-danger mb-3">
            <?php echo $data->test?>
        </div>
        <?php } ?>

        <?php if($data->getId()) {?>
        <input type="hidden" name="id" value="<?php echo $data->getId()?>">
        <?php }?>
        <label for="meno" class="sr-only">Meno</label>
        <div class="col-sm-2 mx-auto">
            <input name="meno" type="text" id="meno" class="form-control" value="<?php echo $data->getName()?>" placeholder="Meno">
        </div>
        <label for="date" class="sr-only">Dátum</label>
        <div class="col-sm-2 mx-auto">
            <input name="date" type="date" id="date" class="form-control " value="<?php echo $data->getDayOfBirth()?>" placeholder="YYYY-MM-DD" >
        </div>
        <label for="weight" class="sr-only">Hmotnosť</label>
        <div class="col-sm-2 mx-auto">
            <input name="weight" type="number" id="weight" class="form-control " value="<?php echo $data->getWeight()?>" placeholder="Váha" >
        </div>
        <button class="btn btn-lg btn-primary btn-block m-3" type="submit" name="submit">Pridaj</button>
    </form>
</div>
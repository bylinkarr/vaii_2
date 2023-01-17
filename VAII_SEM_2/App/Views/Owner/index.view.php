<?php
$layout = 'root';
/** @var \App\Models\Owner $data */
?>
<div class="tb">
    <h2 class="nadpis1">Použivateľ</h2>
    <p class="right-text">Na tejto stránke vidíte informácie o Vás</p>
    <div id="error" class="text-danger mb-3">
    </div>
            <div class="row gutters-sm pt-5" >
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Meno</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="meno" type="text" id="user_meno" class="form-control" placeholder= <?php echo $data->getFirstName() ?>>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Priezvisko</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="priezvisko" type="text" id="user_priezvisko" class="form-control" placeholder=  <?php echo $data->getLastName() ?>>

                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="email" type="email" id="user_email" class="form-control" placeholder=  <?php echo $data->getEmail()?>>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mesto</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="mesto" type="text" id="user_mesto" class="form-control" placeholder=  <?php echo $data->getCity() ?>>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" id="user_editB"  class="btn btn-info m-2" value=<?php echo $data->getId() ?>  >Edit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

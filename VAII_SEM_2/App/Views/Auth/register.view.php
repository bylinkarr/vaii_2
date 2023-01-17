<?php
$layout = 'root';
/** @var Array $data */
?>
<div class="p-5 text-center ">
    <form id="form" class="form-signin p-5 " method="post" action="<?= \App\Config\Configuration::REGISTER_URL ?>">
        <img class="img_logo" alt="logo" src="public/images/logo.png" title="<?= \App\Config\Configuration::APP_NAME ?>">
        <h1 class="h3 mb-3 font-weight-normal">Register!</h1>
        <div id="error" class="text-center text-danger mb-3">
            <?= @$data['message'] ?>
        </div>
        <div>
            <div class="regdiv">
                <div class="col-sm-2 mx-auto">
                    <label for="username" class="sr-only">Login</label>
                    <input name="username" type="text" id="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="col-sm-2 mx-auto">
                    <label for="password" class="sr-only">Password</label>
                    <input name="password" type="password" id="password" class="form-control " placeholder="Password" required>
                </div>
            </div>
            <div class="regdiv">
                <div class="col-sm-2 mx-auto">
                    <label for="first_name" class="sr-only">Meno</label>
                    <input name="first_name" type="text" id="first_name" class="form-control " placeholder="Meno">
                </div>
                <div class="col-sm-2 mx-auto">
                    <label for="last_name" class="sr-only">Priezvisko</label>
                    <input name="last_name" type="text" id="last_name" class="form-control " placeholder="Priezvisko">
                </div>
            </div>
            <div class="regdiv">
                <div class="col-sm-2 mx-auto">
                    <label for="email" class="sr-only">Email</label>
                    <input name="email" type="email" id="email" class="form-control " placeholder="Email">
                </div>
                <div class="col-sm-2 mx-auto">
                    <label for="city" class="sr-only">Mesto</label>
                    <input name="Mesto" type="text" id="city" class="form-control" placeholder="Mesto">
                </div>
            </div>
        </div>
        <hr>
        <button class="btn btn-lg btn-primary btn-block m-3" type="submit" name="submit">Sign in</button>
    </form>
</div>

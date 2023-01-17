<?php
$layout = 'root';
/** @var Array $data */
?>
<div class="text-center p-5 ">
    <form id="form" class="form-signin p-5 " method="post" action="<?= \App\Config\Configuration::LOGIN_URL ?>">
        <img class="img_logo" alt="logo" src="public/images/logo.png" title="<?= \App\Config\Configuration::APP_NAME ?>">
        <h1 class="h3 mb-3 font-weight-normal">Prihláste sa</h1>
        <div  id= "error" class="text-center text-danger mb-3">
            <?= @$data['message'] ?>
        </div>
        <div class="col-sm-2 mx-auto">
            <label for="username" class="sr-only">Username</label>
            <input name="username" type="text" id="username" class="form-control" placeholder="Username" >
        </div>
        <div class="col-sm-2 mx-auto">
            <label for="password" class="sr-only">Password</label>
            <input name="password" type="password" id="password" class="form-control " placeholder="Password" required>
        </div>
        <hr>
       <div>
           <span class="sr-only">Registrovať sa <a href="<?= \App\Config\Configuration::REGISTER_URL ?>">tu</a>!</span>
       </div>
        <button class="btn btn-lg btn-primary btn-block m-3" type="submit" name="submit">Sign in</button>
    </form>
</div>

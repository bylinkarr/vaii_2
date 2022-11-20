<?php
$layout = 'root';
/** @var Array $data */
?>
<div class="text-center p-5 ">

    <form id="form" class="form-signin p-5 " method="post" action="<?= \App\Config\Configuration::LOGIN_URL ?>">
        <img class="img_logo" src="public/images/logo.png" title="<?= \App\Config\Configuration::APP_NAME ?>">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <div  id= "error" class="text-center text-danger mb-3">
            <?= @$data['message'] ?>
        </div>
        <label for="username" class="sr-only">Login</label>
        <div class="col-sm-2 mx-auto">
        <input name="username" type="text" id="username" class="form-control" placeholder="Login" >
        </div>
        <label for="password" class="sr-only">Password</label>
        <div class="col-sm-2 mx-auto">
        <input name="password" type="password" id="password" class="form-control " placeholder="Password" required>
        </div>
        <button class="btn btn-lg btn-primary btn-block m-3" type="submit" name="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
</div>

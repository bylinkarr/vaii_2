<?php
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/styl.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="public/js/script.js"></script>
</head>
<body>
    <div class="nav">
        <a class="logo" href="?c=home">
             <img class="img_logo" src="public/images/logo.png" title="<?= \App\Config\Configuration::APP_NAME ?>"
                _title="<?= \App\Config\Configuration::APP_NAME ?>">
        </a>
        <a href="?c=home">Home</a>
        <?php if (!$auth->isLogged()) { ?>
            <a href="<?= \App\Config\Configuration::REGISTER_URL ?>">Register</a>
        <?php } ?>
        <?php if ($auth->isLogged()) { ?>
            <a href="?c=animals">Zvieratá</a>
            <a href="?c=matches">Zápasy</a>
            <?php if ($auth->isAdmin()) { ?>
                <a href="?c=matches&a=create">Pridanie Zápasu</a>
                <a href="?c=owner&a=uzivatelia">Uživatelia</a>
            <?php } ?>
            <a href="?c=evaluations">Hodnotenia zápasov</a>
            <a class="signout" href="?c=auth&a=logout">Odhlásenie</a>
            <span class="txt">Prihlásený používateľ: <a href="?c=owner"><?= $auth->getLoggedUserName() ?></a></span>
        <?php } else { ?>
            <a class="login" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlásenie</a>
        <?php } ?>
    </div>
    <div>
        <?= $contentHTML ?>
    </div>
    <div class="foot" id="foot" >Copyright © 2022 , designed & developed by Peter Neupauer</div>
</body>
</html>

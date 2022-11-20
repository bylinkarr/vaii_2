<?php /** @var \App\Core\IAuthenticator $auth */ ?>

<div class="container-fluid t-5">
    <div class="row t-5">
        <div class="col t-5">
            <div>
                Vitaj, <strong><?= $auth->getLoggedUserName() ?></strong>!<br><br>
                Táto časť aplikácie je prístupná len po prihlásení.
            </div>
        </div>
    </div>
</div>
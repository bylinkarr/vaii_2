<?php
$layout = 'root';
/** @var \App\Models\Owner $data */
?>
<div class="tb">
    <ul class="list-group" id="list">
        <?php foreach ($data as $user) {?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo $user->getUsername()?>|<?php echo $user->getFirstName()?>|<?php echo $user->getLastName()?>|
            <button onclick="user.deleteUser(<?php echo $user->getId()?>)"  title="Delete" data-toggle="tooltip"><i class="bi bi-x-circle-fill"></i></button>
        </li>
        <?php }?>
    </ul>
</div>

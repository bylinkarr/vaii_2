<?php
/** @var Animal[] $data */

use App\Models\Animal;
?>
<div class="tb ">

    <h2 class="nadpis1">Zoznam zvierat</h2>
    <p class="right-text">Na tejto stránke vidíte svoje zvieratá</p>

    <a href="?c=animals&a=create" class="btn btn-info m-5" role="button">Pridaj</a>



    <div class=" tbb px-5">

        <table class="tabulka">
            <tr>
                <th>Meno</th>
                <th>Dátum narodenia</th>
                <th>Váha</th>
                <th>Akcie</th>
            </tr>
            <?php foreach ($data as $animal) { ?>
                <tr>
                <td><?php echo $animal->getName()?></td>
                <td><?php echo $animal->getDayOfBirth()?></td>
                <td><?php echo $animal->getWeight()?></td>
                    <td>
                        <a href="?c=animals&a=edit&id=<?php echo $animal->getId()?>" class="edit" title="Edit" data-toggle="tooltip"><i class="bi bi-pencil-fill"></i></i></a>
                        <a href="?c=animals&a=delete&id=<?php echo $animal->getId()?>"    class="delete" title="Delete" data-toggle="tooltip"><i class="bi bi-x-circle-fill"></i></a>
                    </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

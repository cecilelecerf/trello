<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Workspace> $workspaces
 */
?>
<div class="pages stats  w-50">
    <h3 class="mb-3">Statistiques</h3>
    <section>
    <p>
        <p><i class="fa-solid fa-user"></i> Il y a <?=$users->count()?> utilisateurs</p>
        <hr>
        <p><i class="fa-solid fa-table"></i> Il y a <?=$workspaces->count()?> espace de travail</p>
        <hr>
        <p><i class="fa-solid fa-tags"></i> Il y a <?=$categories->count()?> catégories</p>
        <hr>
        <p><i class="fa-solid fa-cards-blank"></i> Il y a <?=$cards->count()?> cartes</p>
 
        <hr>
    </section>
    <article>
        <h4>Les utilisateurs les plus actifs sont :</h4>
        <table class="table table-striped">
            <?php foreach ($variable as $key => $value):?>
                <tr>
                    <th>
                        <!-- Nom de la personne -->
                    </th>
                    <th>
                        <!-- Nombre de workspaces -->
                    </th>
                </tr>
            <?php endforeach ?>
        </table>
    </article>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Workspace> $workspaces
 */
?>
<div class="workspaces stats  w-50">
    <h3 class="mb-3">Statistiques</h3>
    <section>
        <p>Il y a <?=$users->count()?> utilisateurs</p>
        <hr>
        <p>Il y a <?=$workspaces->count()?> espace de travail</p>
        <hr>
        <p>Il y a <?=$categories->count()?> catégories</p>
        <hr>
        <p>Il y a <?=$cards->count()?> cartes</p>
        <hr>
    </section>
    <article>
        <h4>La liste des 5 utilisateurs les plus actifs est :</h4>
    </article>
</div>

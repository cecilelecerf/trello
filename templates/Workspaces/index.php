<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Workspace> $workspaces
 */
?>
<div class="workspaces index content">
    <h3><?= __('Workspaces') ?></h3>
    <ul class="list-group list-group-horizontal-md  mb-3">
        <?php foreach($workspaces as $workspace): ;?>
        <li class="card card-body me-3 mt-3">
            <?= $this->HTML->link($workspace->name, ['action' => 'view', $workspace->id], ['class' => 'card-title link-offset-2'])?>
            <p class="card-text text-secondary">Dernière modification : <?=$workspace->modified?></p>
           
        </li>
        <?php endforeach?>
    </ul>
    <?= $this->Html->link(__('New Workspace'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
</div>

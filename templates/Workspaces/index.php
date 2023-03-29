<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Workspace> $workspaces
 */
?>
<div class="workspaces index content">
    <?= $this->Html->link(__('New Workspace'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Workspaces') ?></h3>
    <ul>
        <?php foreach($workspaces as $workspace): ;?>
            <li><?= $this->HTML->link($workspace->name, ['action' => 'view', $workspace->id])?></li>
        <?php endforeach?>
   </ul>
</div>

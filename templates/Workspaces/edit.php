<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workspace $workspace
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $workspace->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $workspace->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Workspaces'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="workspaces form content">
            <?= $this->Form->create($workspace) ?>
            <fieldset>
                <legend><?= __('Edit Workspace') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('admin');
                    echo $this->Form->control('users._ids', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

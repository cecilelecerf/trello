<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workspace $workspace
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="workspaces form content">
    <?= $this->Form->create($workspace) ?>
    <fieldset class="mb-3">
        <legend><?= __('Edit Workspace') ?></legend>
        <?php
            echo $this->Form->control('name', [
                'label' => ['class' => 'form-label label '], 
                'class'=> ['form-control'],
                'templates' => [
                    'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                ],
            ]);
            echo $this->Form->label('Admin', null, ['class' => 'form-label label']);
            echo $this->Form->select('admin', $membersList, [
                'class'=> ['form-control'],
                'templates' => [
                    'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                ],
            ]);
            echo $this->Form->control('users._ids', [
                'options' => $users, 
                'label' => ['text'=>'Membres', 'class' => 'form-label label mt-3'], 
                'class'=> ['form-control'],
                'templates' => [
                    'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
            ],]);
        ?>
    </fieldset>
    <div class="d-flex">
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary me-3']) ?>
        <?= $this->Form->end() ?>
        <?= $this->HTML->link('Back', ['action' => 'view', $workspace->id], ['class' => 'btn btn-outline-primary'])?>
    </div>
</div>



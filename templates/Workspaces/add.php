<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workspace $workspace
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="workspaces form content">
            <?= $this->Form->create($workspace) ?>
            <div class="d-flex">
                <legend>
                    <?= __('Add Workspace') ?>
                </legend>
                <?= $this->Html->link(__('List Workspaces'), 
                    ['action' => 'index'], 
                    ['class' => 'side-nav-item w-25 text-end text-secondary']) 
                ?>
            </div>
            <fieldset class="mb-3 input-group">
                <?php
                    echo $this->Form->control('name', [
                        'label' => ['class' => 'form-label label'], 
                        'class'=> ['form-control'],
                        'templates' => [
                            'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                        ],
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

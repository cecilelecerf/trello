<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\Collection\CollectionInterface|string[] $workspaces
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav d-flex justify-content-between">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-outline-primary']) ?>
        </div>
    </aside>
    <div>
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset class="mb-3 input-group">
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('username', [
                        'label' => ['class' => 'form-label label'], 
                        'class'=> ['form-control'],
                        'templates' => [
                            'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                        ],
                    ]);
                    echo $this->Form->control('password', [
                        'label' => ['class' => 'form-label label'], 
                        'class'=> ['form-control'],
                        'templates' => [
                            'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                        ],
                    ]);
                    echo $this->Form->control('email', [
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

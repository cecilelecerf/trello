<div class="users">
    <?= $this->Flash->render() ?>
    <h3>Connexion</h3>
    <?= $this->Form->create() ?>
    <fieldset class="mb-3 ">
        <legend><?= __('Veuillez s\'il vous plaît entrer votre nom d\'utilisateur et votre mot de passe') ?></legend>
        <?= $this->Form->control('email', 
            ['required' => true, 
            'label' => ['class' => 'form-label label'], 
            'class'=> ['form-control'],
            'templates' => [
                'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
            ],
        ])?>

        <?= $this->Form->control('password', ['required' => true,
            'label' => ['class' => 'form-label label'], 
            'class'=> ['form-control'],
            'templates' => [
                'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
            ],
        ]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login'), ['class' => 'btn btn-primary']); ?>
    <?= $this->Form->end() ?>

    <?= $this->Html->link("Ajouter un utilisateur", ['action' => 'add'], ['class' => 'btn btn-outline-secondary']) ?>
</div>
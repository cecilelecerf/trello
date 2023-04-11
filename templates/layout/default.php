<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['bootstrap.min', 'all.min','index', 'workspaces']) ?>
    <?= $this->Html->script(['bootstrap.bundle.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="navbar justify-content-center bg-primary-subtle mb-4">
        <div class="navbar-brand">
            <a href="<?= $this->Url->build('/') ?>" class="me-2">TRELLO</a>
        </div>
        <div class="navbar-nav d-flex flex-row w-25 justify-content-between">
            <?= $this->Html->link('Workspaces', 
                ['controller' => 'workspaces', 'action'=> 'index'], 
                ['class' => 'nav-link']
                
            )?>
            <?= $this->Html->link('Statistiques', 
                ['controller' => 'workspaces', 'action'=> 'stats'], 
                ['class' => 'nav-link']
                
            )?>

            <?php if($this->request->getAttribute('identity')==null):?>
                <?= $this->Html->link('login', 
                    ['controller' => 'Users', 'action'=> 'login'],
                    ['class' => 'nav-link ']
                )?>
                <?= $this->Html->link('Add user', ['controller' => 'Users', 'action'=> 'add'],['class' => 'nav-link '])?>
            <?php else:  ?>
                <?= $this->Html->link('Users list', 
                    ['controller' => 'Users', 'action'=> 'index'],
                    ['class' => 'nav-link ']
                )?>
                <?= $this->Html->link('Logout '.($this->request->getAttribute('identity')->login), ['controller' => 'Users', 'action'=> 'logout'], ['class' => 'nav-link '])?>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>

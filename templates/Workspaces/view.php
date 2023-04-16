<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workspace $workspace
 */
?>
<div class="workspaces view content">
    <?php if($workspace->categories !== null) :?>
        <section class="d-flex justify-content-between align-items-center mb-5">
            <h3><?= h($workspace->name) ?></h3>
            
            <!-- button open canvas right -->
            <a class="text-secondary fs-4" data-bs-toggle="offcanvas" href="#moreWorkspace" role="button" aria-controls="offcanvasRight">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </a>
        </section>

        <ul id="categories" class="d-flex justify-content-between overflow-x-scroll ps-0 ">
            <?php foreach ($workspace->categories as $categories) : ?>
                <li class="card m-2">   
                    <div class="card-header">

                        <div style="background-color:<?= h($categories->color)?>" class="card-img-top border-bottom mb-3 text-end" data-bs-toggle="modal" 
                        data-bs-target="#CategoryEditModal<?=$categories->id?>">
                            <i class="fa-solid fa-pen fs-5 me-2 mt-2 btn btn-outline-primary"></i>
                        </div>
                        <h2 class="card-title text-center"><?= h($categories->name) ?></h2>
                    </div>
                    <ul class="card-body">
                        <!-- liste de tous les cards + Modal Open Card-->
                        <?php foreach($categories->cards as $cards): ?>
                            <li>
                                <article class="card border-primary my-3" data-bs-target="#CardOpenToggle<?=$cards->id?>" data-bs-toggle="modal">
                                    <h3 class="card-title card-header"><?= h($cards->title) ?></h3>
                                    <section class="card-body">
                                        <p class="card-text "><?= h($cards->description) ?></p>
                                        <div class="d-flex">
                                            <?php if($cards->deadline !== null):?>
                                                <p class="card-text text-secondary">Deadline : <?= h($cards->deadline) ?></p>
                                            <?php endif?>
                                            <?php if($cards->manager !== null):?>
                                                <p class="card-text text-secondary">Manager : <?= h($cards->managinguser->username) ?></p>
                                            <?php endif?>
                                                
                                        </div>
                                    </section>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" data-bs-target="#CardOpenToggle<?=$cards->id?>" data-bs-toggle="modal">+ d'infos</button>
                                    </div>
                                </article>

                                    <!-- Open card en modal-->
                                <article class="modal fade" id="CardOpenToggle<?=$cards->id?>" aria-hidden="true" aria-labelledby="CardOpenLabel<?=$cards->id?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">

                                        <div class="modal-content">
                                            <section class="modal-header">
                                                <h1 class="modal-title fs-5" id="CardOpenLabel<?=$cards->id?>"><?= h($cards->title) ?></h1>
                                                <?php if($cards->deadline !== null):?>
                                                    <p class="text-secondary">  - Deadline : <?= h($cards->deadline)?></p>
                                                <?php endif?>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </section>

                                            <section class="modal-body">
                                                <p><?= h($cards->description)?></p>
                                                <p><span class="text-secondary">Category : </span><?= h($categories->name) ?></p>
                                                <?php if($cards->manager !== null):?>
                                                    <p><span class="text-secondary">Manager : </span><?= h($cards->managinguser->username)?></p>
                                                <?php endif?>
                                            </section>
                                            
                                            <section class="modal-footer justify-content-between">
                                                <div>
                                                    <button class="btn btn-primary" data-bs-target="#CardEditToggle<?=$cards->id?>" data-bs-toggle="modal">Edit</button>
                                                    <?= $this->Form->postLink(__('Delete'), 
                                                        ['controller'=>'Cards', 'action' => 'delete', $cards->id], 
                                                        [
                                                            'class' => 'btn btn-outline-primary', 
                                                            'confirm' => __('Are you sure you want to delete card :', $categories->id)
                                                    ])?>
                                                </div>
                                                <div class="d-flex justify-content-end align-items-center">
                                                        <p class="text-secondary mb-0 me-3">Author : <?= h($cards->creatoringuser->username)?></p>
                                                        <p class="text-secondary mb-0">Last modified : <?= h($cards->modified)?></p>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </article>
                                    <!-- Edit modal -->
                                <div class="modal fade" id="CardEditToggle<?=$cards->id?>" aria-hidden="true" aria-labelledby="CardEditToggleLabel<?=$cards->id?>" tabindex="-1" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">

                                        <div class="modal-content">
                                            <?= $this->Form->create($cards, ['url' => ['controller' => 'Cards', 'action' => 'edit', $cards->id]]) ?>
                                                <div class="modal-header">
                                                    <?= $this->Form->control('title' , [
                                                            'label' => ['class' => 'hidden'], 
                                                            'class'=> ['form-control'],
                                                            'templates' => [
                                                                'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                            ],
                                                        ]);
                                                    ?>
                                                    <p class="text-secondary">  - Deadline :
                                                        <?= $this->Form->control('deadline' , [
                                                            'label' => ['class' => 'hidden'], 
                                                            'class'=> ['form-control'],
                                                            'templates' => [
                                                                'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                            ],
                                                        ]); ?>
                                                    </p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <?= $this->Form->control('description' , [
                                                            'label' => ['text' => 'Description'], 
                                                            'class'=> ['form-control'],
                                                            'type' => 'textarea',
                                                            'templates' => [
                                                                'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                            ],
                                                        ]);
                                                    ?>
                                                    
                                                    <?= $this->Form->label('Category'); ?>
                                                    <?= $this->Form->select('category_id', $categoriesList, [
                                                        'class'=>['form-control'],
                                                        'templates' => [
                                                            'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                        ],
                                                    ]);
                                                    ?>
                                                    <?= $this->Form->control('workspace_id', 
                                                            ['type'=>'hidden', 
                                                            'value' => $workspace->id]);
                                                    ?>
    
                                                    <?= $this->Form->label('Manager', null, ['class' => ' mt-3']); ?>
                                                    <?= $this->Form->select('manager' , $memberList, [
                                                        'class'=>['form-control'],
                                                        'templates' => [
                                                            'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                        ],
                                                    ]);?>

                                                </div>
                                                
                                                <div class="modal-footer justify-content-between">
                                                    <div>
                                                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                                                        <button class="btn btn-outline-primary" data-bs-target="#CardOpenToggle<?=$cards->id?>" data-bs-toggle="modal" type="button">Retour</button>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="text-secondary mb-0 me-3">Author : <?= h($cards->creatoringuser->username)?></p>
                                                        <p class="text-secondary mb-0">Last modified : <?= h($cards->modified)?></p>
                                                    </div>
                                                </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        
                        
                        <?php endforeach?>
                    </ul>
                    <div class="card-footer text-center">
                        <!-- Button modal Add Card -->
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#CardAddModal<?=$categories->id?>">
                            Add Cards
                        </button>
                    </div>
                    <!-- open ajout nouvelle card en modal-->
                    <section class="modal fade" id="CardAddModal<?=$categories->id?>" tabindex="-1" aria-labelledby="CardAddLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="CardAddLabel"><?= __('Add Card') ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    <?= $this->Form->create($newCards, ['url' => ['controller' => 'Cards', 'action' => 'add']]) ?>
                                    <fieldset class="mb-3">
                                        <?php
                                            echo $this->Form->control('title' , [
                                                'label' => ['class' => 'form-label label'], 
                                                'class'=> ['form-control'],
                                                'templates' => [
                                                    'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                ],
                                            ]);
                                            echo $this->Form->control('description', [
                                                'label' => ['class' => 'form-label label'], 
                                                'type' => 'textarea',
                                                'class'=> ['form-control'],

                                                'templates' => [
                                                    'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                ],
                                            ]);
                                            echo $this->Form->control('creator', [
                                                'type'=>'hidden', 
                                                'value' => $this->request->getAttribute('identity')->id
                                            ]);
                                            echo $this->Form->label('Manager');
                                            echo $this->Form->select('manager' , $membersList, [
                                                'class'=>['form-control'],
                                                'templates' => [
                                                    'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                ],
                                            ]);
                                       
                                            echo $this->Form->control('deadline', [
                                                'empty' => true,
                                                'label' => ['class' => 'form-label label'],
                                                'class' => ['form-control'],
                                                'templates' => [
                                                    'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                ],

                                            ]);
                                            
                                            echo $this->Form->control('category_id', 
                                                ['type'=>'hidden', 
                                                'value' => $categories->id]);

                                            echo $this->Form->control('workspace_id', 
                                                ['type'=>'hidden', 
                                                'value' => $workspace->id]);
                                        ?>
                                    </fieldset>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                        <?= $this->Form->button(__('Submit'), [
                                            'class' => 'btn btn-primary'
                                        ]) ?>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- edit category en modal-->
                    <section class="modal fade" id="CategoryEditModal<?=$categories->id?>" tabindex="-1" aria-labelledby="CategoryEditLabel" aria-hidden="true">
                        <?= $this->Form->create($categories, ['url' => ['controller' => 'Categories', 'action' => 'edit', $categories->id]]) ?>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="CategoryEditLabel"><?= __('Category') ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset class="mb-3">
                                            <legend><?= __('Edit Category') ?></legend>
                                            <?php
                                                echo $this->Form->control('name', [
                                                    'label' => ['class' => 'form-label label'], 
                                                    'class'=> ['form-control'],
                                                    'templates' => [
                                                        'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                    ],
                                                ]);
                                                echo $this->Form->control('color', [
                                                    'type' => 'color',
                                                    'label' => ['class' => 'form-label label'], 
                                                    'class'=> ['form-control w-50'],
                                                    'templates' => [
                                                        'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                                                    ],
                                                ]);
                                                echo $this->Form->control('workspace_id', [
                                                    'value' => $workspace->id,
                                                    'type' => 'hidden'
                                                ]);
                                            ?>
                                        </fieldset>
                                        
                                    </div>   
                                    <div class="modal-footer">
                                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                                        <?= $this->Form->end() ?>
                                        <?= $this->Form->postLink('Delete', 
                                            ['controller'=>'Categories','action' => 'delete', $categories->id], 
                                            ['confirm' => __('Are you sure you want to delete # {0}?', $categories->name),
                                            'class' => 'btn btn-outline-primary'
                                        ])?>                           
                                    </div>
                              
                                </div>
                            </div>
                     
                    </section>
                </li>

            <?php endforeach; ?>
        
        </ul>   

        <!-- canvas right -->
        <aside
            class="offcanvas offcanvas-end" 
            tabindex="-1" 
            id="moreWorkspace" 
            aria-labelledby="moreWorkspace">

            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="moreWorkspace"><?= __('Actions') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body list-group list-group-flush">
                <?= $this->Html->link(__('Edit Workspace'), 
                    ['action' => 'edit', $workspace->id], 
                    ['class' => 'list-group-item list-group-item-action']
                ) ?>

                <!--collapse logs button-->
                <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#Logs" role="button" aria-expanded="false" aria-controls="Logs">
                    <?= __('Related Logs') ?>
                </a>

                <!-- open collapse logs -->
                <div class="collapse card " id="Logs">
                    <div class="card-header">
                        <h4>Logs de <?= $workspace->name ?></h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($workspace->logs as $log) : ?>
                            <li class="list-group-item"><p><?=$log->content?> par <?=$log->user_id?> le <?=$log->modified?></p></li>
                        <?php endforeach?>
                    </ul>
                 
                </div>

                <!-- colapse member list button -->
                <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#Memberlist" role="button" aria-expanded="false" aria-controls="Memberlist">
                    Member list
                </a>
                <!-- open collapse member list -->
                <section class="collapse card" id="Memberlist">
                    <div class="card-header">
                        List des utilisateurs
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($workspace->users as $user):?>               
                            <li class="list-group-item d-flex justify-content-between">
                                <p class="workspace_member"><?= $user->username ?></p>
                                <?= $this->Form->postLink('<i class="fa-solid fa-xmark"></i>', 
                                    ['action' => 'deleteGuests', $user->_joinData->id], 
                                    ['confirm' => __('Are you sure you want to delete # {0}?', $user->_joinData->id), 
                                    'class' => 'btn btn-outline-danger text-end mb-0' , 
                                    'escape' => false
                                ]) ?>
                               
                            </li>
                        <?php endforeach?>
                    </ul>
                    <div class="card-footer">

                        <?= $this->Form->create($newGuest, ['url' => ['action' => 'addGuest']]) ?>
                        <?php
                            echo $this->Form->control('user_id' , [
                                'label' =>  ['text'=>'Nouveau membre', 'class' => 'form-label label mb-2'],
                                'options' => $users,
                                'class'=> ['form-control mb-3'],
                            
                            ]);
                            echo $this->Form->control('workspace_id' , [ 
                                'type'=>'hidden',
                                'value'=>$workspace->id
                            ]);
                        ?>
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                                

                    </section>
                <div class="collapse" id="Logs">
                    <div class="card card-body">
                        <?php foreach ($workspace->logs as $log) : ?>
                            <p><?=$log->content?> par <?=$log->user_id?> le <?=$log->modified?></p>
                        <?php endforeach?>
                    </div>
                </div>


            </div>


            <hr>
            <div class="offcanvas-bottom d-grid gap-2 col-6 mx-auto">
                <?= $this->Form->postLink(__('Delete Workspace'), 
                    ['action' => 'delete', $workspace->id], 
                    ['confirm' => __('Are you sure you want to delete # {0}?', $workspace->id), 
                    'class' => 'btn btn-outline-danger text-center mb-3']) ?>
            </div>
        </aside>
    
        <!--Button Modal Add Category -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CategoryAddModal">
            Add Category
        </button>
    
    <?php endif ?>
</div>







<!-- ajout nouvelle category en modal-->
<div class="modal fade" id="CategoryAddModal" tabindex="-1" aria-labelledby="CategoryAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="CategoryAddLabel"><?= __('Add Card') ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($newCategory, ['url' => ['controller' => 'Categories', 'action' => 'add']]) ?>
                <fieldset class="mb-3">
                    <legend><?= __('Add Category') ?></legend>
                    <?php
                        echo $this->Form->control('name', [
                            'label' => ['class' => 'form-label label'], 
                            'class'=> ['form-control'],
                            'templates' => [
                                'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                            ],
                        ]);
                        echo $this->Form->control('color', [
                            'type' => 'color',
                            'label' => ['class' => 'form-label label'], 
                            'class'=> ['form-control w-50'],
                            'templates' => [
                                'inputContainer' => '<div class="input-group-default mb-3 {{type}}{{required}}">{{content}}</div>'
                            ],
                        ]);
                        echo $this->Form->control('workspace_id', [
                            'value' => $workspace->id,
                            'type' => 'hidden'
                        ]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php if($workspace->categories !== null): ?> 
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Workspace'), ['action' => 'edit', $workspace->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Workspace'), ['action' => 'delete', $workspace->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workspace->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Workspaces'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Workspace'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="workspaces view content">
            <h3><?= h($workspace->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($workspace->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($workspace->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Admin') ?></th>
                    <td><?= $this->Number->format($workspace->admin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($workspace->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($workspace->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($workspace->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Creted') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($workspace->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->username) ?></td>
                            <td><?= h($users->password) ?></td>
                            <td><?= h($users->email) ?></td>
                            <td><?= h($users->creted) ?></td>
                            <td><?= h($users->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Categories') ?></h4>
                <?php if (!empty($workspace->categories)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Color') ?></th>
                            <th><?= __('Workspace Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($workspace->categories as $categories) : ?>
                        <tr>
                            <td><?= h($categories->id) ?></td>
                            <td><?= h($categories->name) ?></td>
                            <td><?= h($categories->color) ?></td>
                            <td><?= h($categories->workspace_id) ?></td>
                            <td><?= h($categories->created) ?></td>
                            <td><?= h($categories->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Categories', 'action' => 'view', $categories->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Categories', 'action' => 'edit', $categories->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Categories', 'action' => 'delete', $categories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categories->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Logs') ?></h4>
                <?php if (!empty($workspace->logs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Content') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Workspace Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($workspace->logs as $logs) : ?>
                        <tr>
                            <td><?= h($logs->id) ?></td>
                            <td><?= h($logs->content) ?></td>
                            <td><?= h($logs->user_id) ?></td>
                            <td><?= h($logs->workspace_id) ?></td>
                            <td><?= h($logs->created) ?></td>
                            <td><?= h($logs->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Logs', 'action' => 'view', $logs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Logs', 'action' => 'edit', $logs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Logs', 'action' => 'delete', $logs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logs->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workspace $workspace
 */
?>
<section class="d-flex justify-content-between align-items-center mb-5">
    <h1><?= h($workspace->name) ?></h1>
    <div class="d-flex justify-content-between w-50">
        <?= $this->Html->link(__('Edit Workspace'), ['action' => 'edit', $workspace->id], ['class' => 'side-nav-item']) ?>
        <?= $this->Form->postLink(__('Delete Workspace'), ['action' => 'delete', $workspace->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workspace->id), 'class' => 'side-nav-item']) ?>
        <p>Member list</p>
        <P><?= __('Related Logs') ?></P>
    </div>
</section>
<ul id="categories">
    <?php foreach ($workspace->categories as $categories) : ?>
        <li class="card ">   
            <div style="background-color:<?= h($categories->color)?>" class="card-img-top"></div>
            <h2 class="card-title text-center"><?= h($categories->name) ?></h2>
            <ul class="card-body">
                <!-- liste de tous les cards -->
                <?php foreach($categories->cards as $cards): ?>
                    <li>
                        <h3><?= h($cards->title) ?></h3>
                        <p><?= h($cards->description) ?></p>
                        <div class="d-flex">
                            <p><?= h($cards->deadline) ?></p>
                            <p><?= h($cards->manager) ?></p>
                        </div>
                    </li>
                <?php endforeach?>
            </ul>


            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#CardAddModal">
                Add Cards
            </button>
        </li>
    <?php endforeach; ?>

</ul>   
<div class="modal fade" id="CardAddModal" tabindex="-1" aria-labelledby="CardAddLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="CardAddLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= $this->Form->create($card) ?>
            <fieldset>
            <legend><?= __('Add Card') ?></legend>
            <?php
                echo $this->Form->control('title');
                echo $this->Form->control('description');
                echo $this->Form->control('creator');
                echo $this->Form->control('manager');
                echo $this->Form->control('deadline', ['empty' => true]);
                echo $this->Form->control('category_id', ['options' => $categories]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<?= $this->Html->link(__('Add categories'), ['controller' => 'Categories', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>



        <td><?= h($categories->created) ?></td>
        <td><?= h($categories->modified) ?></td>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['controller' => 'Categories', 'action' => 'view', $categories->id]) ?>
            <?= $this->Html->link(__('Edit'), ['controller' => 'Categories', 'action' => 'edit', $categories->id]) ?>
            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Categories', 'action' => 'delete', $categories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categories->id)]) ?>
        </td>

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

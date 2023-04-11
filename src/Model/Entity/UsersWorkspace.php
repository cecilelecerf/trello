<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersWorkspace Entity
 *
 * @property int $id
 * @property int $workspace_id
 * @property string $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Workspace $workspace
 * @property \App\Model\Entity\User $user
 */
class UsersWorkspace extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'workspace_id' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'workspace' => true,
        'user' => true,
    ];
}

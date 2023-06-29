<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Workspaces Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\HasMany $Categories
 * @property \App\Model\Table\LogsTable&\Cake\ORM\Association\HasMany $Logs
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Workspace newEmptyEntity()
 * @method \App\Model\Entity\Workspace newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Workspace[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Workspace get($primaryKey, $options = [])
 * @method \App\Model\Entity\Workspace findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Workspace patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Workspace[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Workspace|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Workspace saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Workspace[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Workspace[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Workspace[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Workspace[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WorkspacesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('workspaces');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Categories', [
            'foreignKey' => 'workspace_id',
            'dependent' => true,
            'cascadeCallbacks'=>true,
        ]);
        $this->hasMany('Logs', [
            'foreignKey' => 'workspace_id',
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'workspace_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_workspaces',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 30)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('admin')
            ->requirePresence('admin', 'create')
            ->notEmptyString('admin');

        return $validator;
    }
}

<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersWorkspacesFixture
 */
class UsersWorkspacesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'workspace_id' => 1,
                'user_id' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-04-11 12:42:12',
                'modified' => '2023-04-11 12:42:12',
            ],
        ];
        parent::init();
    }
}

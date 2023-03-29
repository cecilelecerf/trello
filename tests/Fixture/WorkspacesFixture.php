<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WorkspacesFixture
 */
class WorkspacesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'admin' => 1,
                'created' => '2023-03-29 10:22:33',
                'modified' => '2023-03-29 10:22:33',
            ],
        ];
        parent::init();
    }
}

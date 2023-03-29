<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LogsFixture
 */
class LogsFixture extends TestFixture
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
                'content' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'workspace_id' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-03-29 14:32:28',
                'modified' => '2023-03-29 14:32:28',
            ],
        ];
        parent::init();
    }
}

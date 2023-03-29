<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CategoriesFixture
 */
class CategoriesFixture extends TestFixture
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
                'color' => 'Lorem',
                'workspace_id' => 1,
                'created' => '2023-03-29 14:31:30',
                'modified' => '2023-03-29 14:31:30',
            ],
        ];
        parent::init();
    }
}

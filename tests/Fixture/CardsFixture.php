<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CardsFixture
 */
class CardsFixture extends TestFixture
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
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'creator' => 1,
                'manager' => 1,
                'deadline' => '2023-03-29',
                'category_id' => 1,
                'created' => '2023-03-29 14:32:18',
                'modified' => '2023-03-29 14:32:18',
            ],
        ];
        parent::init();
    }
}

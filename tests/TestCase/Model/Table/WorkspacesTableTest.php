<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkspacesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkspacesTable Test Case
 */
class WorkspacesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkspacesTable
     */
    protected $Workspaces;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Workspaces',
        'app.Categories',
        'app.Logs',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Workspaces') ? [] : ['className' => WorkspacesTable::class];
        $this->Workspaces = $this->getTableLocator()->get('Workspaces', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Workspaces);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\WorkspacesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;


class StatsController extends AppController
{
    public function index(){
        
        $users = $this->fetchTable('Users')->find('list', ['limit' => 200])->all();
        $categories = $this->fetchTable('Categories')->find('list', ['limit' => 200])->all();
        $cards = $this->fetchTable('Cards')->find('list', ['limit' => 200])->all();
        
        $workspaces = $this->fetchTable('Workspaces')->find('list', ['limit' => 200])->all();
        $this->set(compact('cards', 'users', 'categories', 'workspaces'));
    }


}

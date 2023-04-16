<?php
declare(strict_types=1);

namespace App\Controller;


class StatsController extends AppController
{
    public function index(){
        
        $this->Authorization->skipAuthorization();


        // Récupérer les 5 utilisateurs appartenant au plus de workspaces
        $topUsers = $this->fetchTable('UsersWorkspaces')->find()
            ->select(['Users.username', 'count' => 'COUNT(DISTINCT UsersWorkspaces.workspace_id)'])
            ->contain(['Users'])
            ->group('user_id')
            ->orderDesc('count')
            ->limit(5);


        $users = $this->fetchTable('Users')->find('list')->all();
        $categories = $this->fetchTable('Categories')->find('list')->all();
        $cards = $this->fetchTable('Cards')->find('list')->all();
        $workspaces = $this->fetchTable('Workspaces')->find('list')->all();

        $this->set(compact('cards', 'users', 'categories', 'workspaces', 'topUsers'));
    }


}

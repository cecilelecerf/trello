<?php
declare(strict_types=1);

namespace App\Policy;


use App\Model\Entity\Workspace;
use App\Model\Entity\UsersWorkspaces;
use Authorization\IdentityInterface;

/**
 * Workspace policy
 */
class WorkspacePolicy
{
    /**
     * Check if $user can create Workspace
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Workspace $workspace
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Workspace $workspace)
    {
        return true;
    }

    /**
     * Check if $user can update Workspace
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Workspace $workspace
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Workspace $workspace)
    {
        // Les utilisateurs authentifiés ne peuvent modifier que leurs articles.
        return $this->isAdmin($user, $workspace);
    }

    /**
     * Check if $user can delete Workspace
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Workspace $workspace
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Workspace $workspace)
    {
        return $this->isAdmin($user, $workspace);
    }

    /**
     * Check if $user can view Workspace
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Workspace $workspace
     * @return bool
     */
    public function canView(IdentityInterface $user, UsersWorkspaces $usersworkspaces)
    {
        // Les utilisateurs authentifiés ne peuvent modifier que leurs articles.
        return $this->isMember($user, $usersworkspaces);
    }

    protected function isAdmin(IdentityInterface $user, Workspace $workspace)
    {
        return $workspace->admin === $user->getIdentifier();
    }

    protected function isMember(IdentityInterface $user, UsersWorkspaces $usersworkspaces)
    {
        return $usersworkspaces->user_id === $user->getIdentifier();
    }
}

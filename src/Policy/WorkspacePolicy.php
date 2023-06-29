<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Workspace;
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
    }

    /**
     * Check if $user can view Workspace
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Workspace $workspace
     * @return bool
     */
    public function canView(IdentityInterface $user, Workspace $workspace)
    {
        return true;
    }
}

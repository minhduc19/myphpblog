<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Answer;
use Authorization\IdentityInterface;


class AnswerPolicy
{

    public function canAdd(IdentityInterface $user, Answer $Answer)
    {
        return true;
    }

    /**
     * Check if $user can edit Answer
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Answer $Answer
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Answer $answer)
    {
        return $this->isAuthor($user, $answer);
        //return true;
    }



    /**
     * Check if $user can delete Answer
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Answer $Answer
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Answer $answer)
    {
        return $this->isAuthor($user, $answer);
    }



    /**
     * Check if $user can view Answer
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Answer $Answer
     * @return bool
     */
    public function canView(IdentityInterface $user, Answer $answer)
    {
        return $this->isAuthor($user, $answer);
    }

    public function canAjaxRemove(IdentityInterface $user, Answer $answer)
    {
        return $this->isAuthor($user, $answer);
    }

    

    protected function isAuthor(IdentityInterface $user, Answer $answer)
    {
        return $answer->user_id === $user->getIdentifier();
    }
}

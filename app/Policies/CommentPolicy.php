<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use App\Models\Course;
use App\Models\Order;

class CommentPolicy
{

    /**
     * Determine whether the user can before the models.
     */
    public function before(User $user): bool
    {
        return $user->role === 'admin';
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comment $comment): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->role === 'active' && $comment->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->role === 'active' && $comment->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Comment $comment): bool
    {
        return $user->role === 'active' && $comment->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comment $comment): bool
    {
        return $user->role === 'active' && $comment->user_id === $user->id;
    }

    protected function getCommentByCourse(User $user, Course $course)
    {
        return $user->role === 'active' && $course->user_id === $user->id;
    }

    protected function getCommentByOrder(User $user, Order $order)
    {
        return $user->role === 'active' && $order->user_id === $user->id;
    }

    protected function getCommentByUser(User $user)
    {
        return $user->role === 'active' && $user->id === $user->id;
    }
}

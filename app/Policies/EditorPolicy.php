<?php

namespace App\Policies;

use App\Models\Editor;
use Illuminate\Auth\Access\Response;

class EditorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Editor $editor): bool
    {
        return $editor->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Editor $editor, Editor $model): bool
    {
        return $editor->is_admin || $editor->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Editor $editor): bool
    {
        return $editor->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Editor $editor, Editor $model): bool
    {
        return $editor->is_admin || $editor->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Editor $editor, Editor $model): bool
    {
        return $editor->is_admin;
    }
}

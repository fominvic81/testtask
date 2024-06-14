<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Editor;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Editor $editor): bool
    {
        return $editor->is_admin;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Editor $editor): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Editor $editor, Article $article): bool
    {
        return $editor->is_admin || $editor->articles->contains($article);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Editor $editor, Article $article): bool
    {
        return $editor->is_admin || $editor->articles->contains($article);
    }
}

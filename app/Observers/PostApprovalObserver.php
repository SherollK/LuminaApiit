<?php
namespace App\Observers;

use App\Models\Post;


class PostApprovalObserver
{
    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        // Check if the hide attribute changed from true to false
        if ($post->isDirty('hide') && $post->getOriginal('hide') === true && $post->hide === false) {
            // Check if the author's role is ROLE_USER
            $author = $post->author; // Assuming 'author' relationship is defined on Post model
            if ($author && $author->role === 'ROLE_USER') {
                // Perform your desired action here
                // Example: Log the event or send a notification

          $author->notify(new PostApproved($post));
            }
        }
    }
}

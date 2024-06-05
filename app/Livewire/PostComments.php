<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;

class PostComments extends Component
{
    use WithPagination;

    public Post $post;
    public $editingCommentId;
    public $newCommentContent;

    #[Rule('required|min:3|max:200')]
    public string $comment;

    public function postComment()
    {
        if (auth()->guest()) {
            return;
        }

        $this->validateOnly('comment');

        $this->post->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id()
        ]);

        $this->reset('comment');
    }

    public function editComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment && $comment->user_id == Auth::id()) {
            $this->editingCommentId = $commentId;
            $this->newCommentContent = $comment->content;
        }
    }

    public function updateComment()
    {
        $this->validate([
            'newCommentContent' => 'required|string|max:255',
        ]);

        $comment = Comment::find($this->editingCommentId);
        if ($comment && $comment->user_id == Auth::id()) {
            $comment->comment = $this->newCommentContent;
            $comment->save();

            $this->editingCommentId = null;
            $this->newCommentContent = '';
            // $this->mount($comment->post); // Refresh comments
        }
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment && ($comment->user_id == Auth::id() || Auth::user()->isAdmin())) {
            $comment->delete();
            // $this->mount($comment->post); // Refresh comments
        }
    }
    #[Computed()]
    public function comments()
    {
        return $this?->post?->comments()->with('user')->latest()->paginate(5);
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
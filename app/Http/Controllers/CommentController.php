<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Galery;
use Illuminate\Http\Request;
use App\Services\CommentFilterService;

class CommentController extends Controller
{
    protected CommentFilterService $filter;

    public function __construct(CommentFilterService $filter)
    {
        $this->filter = $filter;
    }

    public function store(Request $request, Galery $galery)
    {
        $userId = auth('user')->id() ?? auth()->id();
        if (!$userId) {
            return redirect()->route('user.login');
        }

        $data = $request->validate([
            'body' => ['required', 'string', 'min:1'],
        ]);

        $evaluation = $this->filter->evaluate($data['body']);

        Comment::create([
            'galery_id' => $galery->id,
            'user_id' => $userId,
            'body' => $evaluation['body'],
            'status' => $evaluation['status'],
            'moderation_note' => $evaluation['moderation_note'],
        ]);

        $message = $evaluation['status'] === 'visible'
            ? 'Komentar berhasil ditambahkan!'
            : 'Komentar mengandung kata yang dibatasi dan menunggu peninjauan admin.';

        session()->flash('success', $message);
        return back();
    }

    public function reply(Request $request, Comment $comment)
    {
        $userId = auth('user')->id() ?? auth()->id();
        if (!$userId) {
            return redirect()->route('user.login');
        }

        $data = $request->validate([
            'body' => ['required', 'string', 'min:1'],
        ]);

        $evaluation = $this->filter->evaluate($data['body']);

        Comment::create([
            'galery_id' => $comment->galery_id,
            'user_id' => $userId,
            'parent_id' => $comment->id,
            'body' => $evaluation['body'],
            'status' => $evaluation['status'],
            'moderation_note' => $evaluation['moderation_note'],
        ]);

        $message = $evaluation['status'] === 'visible'
            ? 'Balasan berhasil ditambahkan!'
            : 'Balasan mengandung kata yang dibatasi dan menunggu peninjauan admin.';

        session()->flash('success', $message);
        return back();
    }

    public function destroy(Comment $comment)
    {
        $userId = auth('user')->id() ?? auth()->id();
        if (!$userId) {
            return redirect()->route('user.login');
        }

        if ($comment->user_id === (int) $userId) {
            $comment->delete();
            session()->flash('success', 'Komentar berhasil dihapus.');
        }

        return back();
    }
}

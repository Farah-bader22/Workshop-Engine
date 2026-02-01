<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    
    public function store(Request $request)
    {

        $validated = $request->validate([
            'user_name'   => 'required|string|max:50',
            'comment'     => 'required|string|max:1000',
            'workshop_id' => 'required|exists:workshops,id',
        ], [

            'user_name.required' => 'ERROR: IDENTITY_REQUIRED_TO_POST',
            'comment.required'   => 'ERROR: FEEDBACK_CANNOT_BE_EMPTY',
        ]);

        try {

            Comment::create([
                'user_name'   => $validated['user_name'],
                'comment'     => $validated['comment'],
                'workshop_id' => $validated['workshop_id'],
            ]);


            return Redirect::back()->with('success', 'FEEDBACK_LOGGED_SUCCESSFULLY');

        } catch (\Exception $e) {
            return Redirect::back()->withErrors([
                'system' => 'CRITICAL_TRANSMISSION_FAILURE: ' . $e->getMessage()
            ]);
        }
    }


    public function destroy(Comment $comment)
    {

        $comment->delete();
        return Redirect::back()->with('success', 'COMMENT_DELETED');
    }
}

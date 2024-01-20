<?php

namespace App\Http\Controllers;

use App\Contexts\Authors;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $author = Authors::get($id);
        $comments = Authors::getComments($id, with: ['author']);

        return view('authors.show', [
            'author'=> $author,
            'comments' => $comments
        ]);
    }

    public function comment(Request $request) {

        $args = [
            'content' => $request->content,
            'author_id'=> $request->user()->id,
            'recipient_id'=> $request->id
        ];

        Authors::comment($args);
        return redirect()->route('authors.show', ['id' => $request->id]);
    }
}

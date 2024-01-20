<?php

namespace App\Http\Controllers;

use App\Contexts\Chismes;
use App\Models\Chisme;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChismeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('chismes.index', [
            'chismes' => Chismes::getAll(['author'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chismes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $args = $request->all();
        $args['author_id'] = $request->user()->id;
        Chismes::create($args);
        return redirect()->route('chismes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $chisme = Chismes::get($id, with: ['author']);
        $comments = Chismes::getComments($id, with: ['author']);

        return view('chismes.show', [
            'chisme'=> $chisme,
            'comments' => $comments
        ]);
    }

    /**
     * Create a comment.
     */
    public function comment(Request $request)
    {
        $args = [
            'content' => $request->content,
            'author_id'=> $request->user()->id,
            'chisme_id'=> $request->id
        ];

        Chismes::comment($args);
        return redirect()->route('chismes.show', ['id' => $request->id]);
    }
}

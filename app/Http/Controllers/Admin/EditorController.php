<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Editor::class);

        $users = Editor::all();

        return view('admin.editor.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Editor::class);
        return view('admin.editor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Editor::class);
        
        $data = $request->validate([
            'firstname' => ['required', 'min:3', 'max:30'],
            'lastname' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', 'unique:editors,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $editor = new Editor($data);

        $editor->save();

        return redirect()->route('editors.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Editor $editor)
    {
        $this->authorize('update', $editor);
        return view('admin.editor.edit', [
            'user' => $editor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Editor $editor)
    {
        $this->authorize('update', $editor);
        
        $data = $request->validate([
            'firstname' => ['required', 'min:3', 'max:30'],
            'lastname' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', $request->input('email') == $editor->email ? '' : 'unique:editors,email'],
        ]);

        $editor->fill($data);

        $editor->save();

        return redirect()->route('editors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Editor $editor)
    {
        $this->authorize('delete', $editor);
        // TODO: add cascade
        // $editor->delete();
        return back();
    }
}

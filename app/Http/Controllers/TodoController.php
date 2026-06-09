<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        Todo::create([
            'title' => $data['title'],
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('home');
    }

    public function update(Request $request, $todo)
    {
        $todo = Todo::find($todo);

        if (!$todo) {
            return redirect()->route('home')->with('error', 'Todo not found');
        }
        $todo->update([
            'is_completed' => $todo->is_completed ? 0 : 1
        ]);

        return redirect()->route('home');
    }

    public function destroy($todo)
    {

        $todo = Todo::find($todo);

        if (!$todo) {
            return redirect()->route('home')->with('error', 'Todo not found');
        }

        $todo->delete();

        return redirect()->route('home');
    }
}

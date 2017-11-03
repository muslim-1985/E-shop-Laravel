<?php

namespace App\Http\Controllers\Admin;

use App\AdminModels\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index ()
    {
        $tasks = Tag::all();

        return response()->json([
            'tasks'    => $tasks,
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'        => 'required|max:255',
        ]);

        $task = Tag::create([
            'title'        => request('title'),
        ]);

        return response()->json([
            'task'    => $task,
            'message' => 'Success'
        ], 200);
    }

    public function update (Request $request, Tag $task)
    {
        $this->validate($request, [
            'title'=> 'required|max:255',
        ]);

        $task->title = request('title');
        $task->save();

        return response()->json([
            'message' => 'Task updated successfully!'
        ], 200);
    }

    public function destroy ($id)
    {
        Tag::find($id)->delete();
    }

    public function TagFilter ()
    {
        return true;
    }
}

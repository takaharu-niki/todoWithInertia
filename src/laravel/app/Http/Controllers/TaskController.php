<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Folder;
use App\Models\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class TaskController extends Controller
{
    public function index (int $id) 
    {
        return Inertia::render('Task/Index', [
            'folders' => Folder::all(),
            'currentFolderId' => $id,
            'tasks' => Task::getStatusLabelAttribute($id),
        ]);
    }

    public function create (int $id) 
    {
        return Inertia::render('Task/Create', ['folderId' => $id]);
    }

    public function store (CreateTask $request)
    {
        $task = Task::create([
            'folders_id' => $request->folderId,
            'title' => $request->title,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('task.index', $task->folders_id);
    }

    public function edit($folderId, $taskId)
    {
        return Inertia::render('Task/Edit', [
            'task' => Task::selectTasksToEdit($taskId),
            'rawTask' => Task::find($taskId),
            'statusType' => Task::STATUS,
        ]);
    }

    public function update(EditTask $request, $folder, $task)
    {
        Task::where('id', $task)->update([
            'title' => $request->title,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        logger()->debug('end update');

        return redirect()->route('task.index', $folder);

    }
}
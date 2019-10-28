<?php

namespace App\Repositories;

use App\User;
use App\Task;
use App\Http\Requests\TaskRequest;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->tasks()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function all()
    {
        return Task::all();
    }

    public function add(TaskRequest $request)
    {
        $tasks = new Task;
        $tasks->create([
            'name' => $request->get('name'),
        ]);
    }

    public function delete($id)
    {
        $tasks = Task::findOrFail($id);
        $tasks->delete();
        return true;
    }
}
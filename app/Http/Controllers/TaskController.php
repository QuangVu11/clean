<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{

    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    public function index()
    {
        $tasks = $this->tasks->all();
        
        return view('tasks.index', compact('tasks'));
    }

    public function store(TaskRequest $request)
    {
        $tasks = $this->tasks->add($request);

        return redirect(route('tasks'))->with('message', trans('setting.add_success'));
    }

    public function getdelete($id)
    {
        try 
        {
            $tasks = $this->tasks->delete($id);

            return redirect(route('tasks'))->with('message', trans('setting.delete_success'));
        } 
        catch (ModelNotFoundException $e) 
        {
            echo $e->getMessage();
        }

    }
}

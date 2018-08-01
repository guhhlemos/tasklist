<?php

namespace App\Http\Controllers\Tasklist;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Auth\User\User;
use App\Models\Tasklist\Tasks;
use App\Models\Tasklist\Status;

class TasklistController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Task Controller
    |--------------------------------------------------------------------------
    |
    | Description.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index() {

        $tasks = Tasks::withAll()
        ->orderBy('id', 'desc')
        ->where('user_id', Auth::id())
        ->get();

        return view('tasklist.index')->with([
            'tasks' => $tasks,
        ]);
    }

    public function create() {

        return view('tasklist.save')->with([
            'statuses' => Status::get(),
        ]);
    }

    public function edit($id) {

        return view('tasklist.save')->with([
            'task' => Tasks::withAll()->findOrFail($id),
            'statuses' => Status::get(),
        ]);
    }

    public function store(Request $request) {

        // Faltam mais validações
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'status'      => 'required',
        ]);

        $task = new Tasks();

        $task->title        = $request->input('title');
        $task->description  = $request->input('description');
        $task->status_id    = $request->input('status');
        $task->user_id      = Auth::id();

        $task->save();

        return redirect('tasklist')->with(['id' => $task->id, 'status' => 'inserted!']);
    }

    public function update(Request $request, $id) {

        // Faltam mais validações
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'status'      => 'required',
        ]);

        $task = Tasks::findOrFail($id);

        $task->title        = $request->input('title');
        $task->description  = $request->input('description');
        $task->status_id    = $request->input('status');
        $task->user_id      = Auth::id();

        $task->save();

        return redirect('tasklist')->with(['id' => $task->id, 'status' => 'updated!']);
    }

    public function destroy($id) {

        $task = Tasks::findOrFail($id);

        $task->delete();

        return redirect('tasklist')->with(['id' => $task->id, 'status' => 'excluded!']);
    }
}

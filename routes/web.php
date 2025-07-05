<?php

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;





Route::get('/', function ()  {
    return redirect()->route('tasks.index');
    // return redirect('task');

})->name('main page');

Route::get('/tasks', function ()  {
    return view('index', [
        'tasks' => Task::orderBy('id','desc')->get()
    ]);
})->name('tasks.index');


Route::get('task/{task}', function($task) {

    return view('show', $task);

})->name('tasks.show');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::post('/tasks', function (Request $request) {
    // dd($request->all());
    // $data = $request->validate(
    //     [
    //         'title'=> 'required|max:255',
    //         'description'=> 'required',
    //         'long_description'=> 'required',
    //     ]
    //     );

    // $task = new ModelsTask();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task = Task::create($request->validate());

    return redirect()->route('tasks.show', ['task'=> $task->id])->with('success','Task create successfully!');
})->name('tasks.store');


//edit task list
Route::get('/tasks/{task}/edit', function($task) {
    return view('edit', [
        'task'=> $task
    ]);
})->name('tasks.edit');


Route::put('/tasks/{task}', function ($task, Request $request) {

    $task->update($request->validate());
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success','Task updated successfully!');

})->name('tasks.update');

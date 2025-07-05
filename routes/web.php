<?php

use App\Models\Task as ModelsTask;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;





Route::get('/', function ()  {
    return redirect()->route('tasks.index');
    // return redirect('task');

})->name('main page');

Route::get('/tasks', function ()  {
    return view('index', [
        'tasks' => ModelsTask::orderBy('id','desc')->get()
    ]);
})->name('tasks.index');


Route::get('task/{id}', function($id) {

    return view('show', ['task' => ModelsTask::where('id', $id)->first()]);

})->name('tasks.show');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::post('/tasks', function (Request $request) {
    // dd($request->all());
    $data = $request->validate(
        [
            'title'=> 'required|max:255',
            'description'=> 'required',
            'long_description'=> 'required',
        ]
        );

    $task = new ModelsTask();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show', ['id'=> $task->id])->with('success','Task create successfully!');
})->name('tasks.store');

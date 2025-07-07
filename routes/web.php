<?php

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', function () {
    return redirect()->route('tasks.index');
})->name('main page');


// ==========================
// Routes liên quan đến Task
// ==========================

// 1. Hiển thị danh sách task
Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::orderBy('id', 'desc')->paginate(5)
    ]);
})->name('tasks.index');

// 2. Hiển thị form tạo task (nên đặt trước {task} để tránh xung đột)
Route::view('/tasks/create', 'create')->name('tasks.create');

// 3. Lưu task mới
Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// 4. Hiển thị form chỉnh sửa task
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

// 5. Cập nhật task
Route::put('/tasks/{task}', function (Task $task, Request $request) {
    $task->update($request->validate());
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

// 6. Xóa task
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

// 7. Hiển thị chi tiết task
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', ['task' => $task]);
})->name('tasks.show');


Route::put('/tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with('success','Task update successfully!');
})->name('tasks.toggle-complete');

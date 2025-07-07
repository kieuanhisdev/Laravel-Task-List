
@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    <div>
        <a href="{{route('tasks.create')}}">Add Task!</a>
    </div>

    @forelse ( $tasks as $task )
        <div>
            <a href="{{ route('tasks.show',['task' => $task->id])}}">
                {{$task->title}}
            </a>
        </div>
    @empty
        <div>There are no Task</div>
    @endforelse

    @if ($tasks->count())
        <nav style="width: 200px; height: 20px;">
            {{$tasks->links()}}
        </nav>
    @endif
@endsection

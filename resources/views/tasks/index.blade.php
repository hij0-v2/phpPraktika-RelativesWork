@extends('layouts.app')

@section('content')
    <h1 style="text-align: center">Task list</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        @can('create', \App\Models\Task::class)
                            <a href="{{ route('tasks.create') }}"
                               class="mb-4 inline-flex items-center px-4 py-2 bg-gray-80">Add new task</a>
                        @endcan
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium">
                                        Completed
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($tasks as $task)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-wrap text-sm text-gray-900">
                                            {{ $task->completed }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-wrap text-sm text-gray-500">
                                            {{$task->description}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-wrap text-sm text-gray-500">
                                            @can('update', $task)
                                                <a href="{{route('tasks.edit', $task)}}"
                                                   class="inline-flex items-center px-4 py-2 bg-gray-800 border">Edit</a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('delete', $task)
                                                <form action="{{route('tasks.destroy', $task)}}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="inline-flex items-center bg-gray-800 border">Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                        <td>
                                                <a href="{{asset('/' . $task->id . '/completed')}}" class="inline-flex
                                                   items-center px-4 py-2 bg-gray-800 border">Completed</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

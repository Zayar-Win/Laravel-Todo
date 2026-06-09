<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-white text-slate-800 flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
            <div class="flex items-center justify-between gap-4">
                <div class="text-left">
                    <h1 class="text-4xl font-bold text-slate-900">Todos ({{ auth()->user()->name }})</h1>
                    <p class="mt-2 text-sm text-slate-500">Keep track of what you need to get done.</p>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <form class="space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-6" action="{{ route('todos.store') }}" method="POST">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium mb-1">New todo</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="What needs to be done?"
                    class="w-full rounded-lg border border-slate-200 bg-white text-slate-900 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-300">
            </div>

            <button
                type="submit"
                class="rounded-lg bg-white border border-slate-300 px-6 py-2 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300">
                Add Todo
            </button>
        </form>

        <div class="space-y-3">
            <h2 class="text-lg font-semibold text-slate-900">Your todos</h2>

            <ul class="space-y-3">

                @foreach ($todos as $todo)
                <li class="flex items-center justify-between gap-3 rounded-lg border border-slate-200 bg-white px-4 py-3">
                    <span @class([ 'text-slate-900' , 'line-through text-slate-400'=> $todo->is_completed,
                        ])>{{ $todo->title }}</span>

                    <div class="flex items-center gap-2 shrink-0">
                        <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                @class([ 'rounded-lg border px-3 py-1.5 text-xs font-semibold focus:outline-none focus:ring-2' , 'border-green-300 bg-green-50 text-green-700 hover:bg-green-100 focus:ring-green-200'=> ! $todo->is_completed,
                                'border-slate-300 bg-white text-slate-600 hover:bg-slate-50 focus:ring-slate-300' => $todo->is_completed,
                                ])>
                                {{ $todo->is_completed ? 'Undo' : 'Complete' }}
                            </button>
                        </form>

                        <form action="{{ route("todos.destroy",$todo->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="rounded-lg border border-red-300 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-200">
                                Delete
                            </button>
                        </form>
                    </div>
                </li>
                @endforeach

            </ul>
        </div>
    </div>
</body>

</html>
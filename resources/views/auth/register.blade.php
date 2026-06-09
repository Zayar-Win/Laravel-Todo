<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register — {{ config('app.name', 'Laravel') }}</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-white text-slate-800 flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <h1 class="text-4xl font-bold mb-8 text-slate-900">Register</h1>

    @if (session('error'))
    <p class="text-red-500 text-sm mt-1">{{ session('error') }}</p>
    @endif

    <form action="{{ url('/register') }}" method="POST" class="w-full max-w-md space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium mb-1">Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                autocomplete="name"
                class="w-full rounded-lg border border-slate-200 bg-white text-slate-900 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-300">
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                class="w-full rounded-lg border border-slate-200 bg-white text-slate-900 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-300">
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium mb-1">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                autocomplete="new-password"
                class="w-full rounded-lg border border-slate-200 bg-white text-slate-900 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-300">
            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="rounded-lg bg-white border border-slate-300 px-6 py-2 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300">
            Register
        </button>
    </form>
</body>

</html>
@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center px-4 py-14">
        <div class="w-full max-w-sm bg-white rounded-xl border border-gray-200 p-8">
            <h1 class="text-2xl font-bold mb-6">Login</h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember"
                        class="rounded border-gray-300">
                    <label for="remember" class="text-sm text-gray-600">Remember me</label>
                </div>

                <button type="submit"
                    class="w-full rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 transition-colors">
                    Login
                </button>

                <p class="text-sm text-center text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-gray-900 font-medium hover:underline">Register</a>
                </p>
            </form>
        </div>
    </div>
@endsection

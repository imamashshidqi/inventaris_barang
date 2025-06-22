<x-layout>
    <x-slot:title>Login</x-slot:title>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img class="w-8 h-8 mr-2" src="{{ asset('storage/img/books/logo.png') }}" alt="logo">
            Toko Buku
        </a>
        <div
            class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Sign in to your account
                </h1>
                <form class="space-y-4 md:space-y-6" action="/login" method="post">
                    @csrf
                    <div>
                        <label for="username"
                            class="block mb-2 text-sm font-medium text-gray-900">username</label>
                        <input type="text" name="username" @error('username') is-invalid @enderror id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="budi" required="">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required="">
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-primary-900 hover:bg-primary-400 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
                    <p class="text-sm font-light text-gray-500">
                        Don’t have an account yet? <a href="/register"
                            class="font-medium text-primary-600 hover:underline">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-layout>

@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    
  <x-header/>

  <section class="bg-indigo-50 pt-10">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="{{ route('homepage') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
            <img class="w-32" src="{{asset('img/dishub.png')}}" alt="logo">
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0" data-aos="fade-up" data-aos-delay="500" data-aos-duration="500">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <form class="space-y-4 md:space-y-6" action="{{route('login.auth')}}" method="POST">

                  @csrf

                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" autofocus required="" value="{{ old('username') }}">
                        @error('username')
                            <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required="">
                    </div>
                    <button type="submit" class="w-full text-white bg-indigo-900 hover:bg-indigo-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Masuk</button>
                </form>
            </div>
        </div>
    </div>
  </section>

@endsection
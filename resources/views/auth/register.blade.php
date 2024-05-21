@extends('layouts.app')

@section('title')
    Register
@endsection

@section('content')
    
  <x-header/>

  <section class="bg-indigo-50 pt-10">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img class="w-32" src="{{asset('img/dishub.png')}}" alt="logo">
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <form class="space-y-4 md:space-y-6" action="{{route('register.regis')}}" method="POST">

                  @csrf

                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" autofocus required="">
                    </div>

                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>
                    
                    <div class="flex items-center mb-4">
                        <input id="admin" type="radio" value="admin" name="role" class="w-4 h-4 text-indigo-900 bg-gray-100 border-gray-300">
                        <label for="admin" class="ms-2 text-sm font-medium text-gray-900">Admin</label>
                    </div>
                    <div class="flex items-center">
                        <input id="user" type="radio" value="user" name="role" class="w-4 h-4 text-indigo-900 bg-gray-100 border-gray-300">
                        <label for="user" class="ms-2 text-sm font-medium text-gray-900">User</label>
                    </div>

                    <button type="submit" class="w-full text-white bg-indigo-900 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Daftar</button>
                </form>
            </div>
        </div>
    </div>
  </section>

@endsection
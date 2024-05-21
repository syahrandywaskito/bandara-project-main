@extends('layouts.admin')

@section('title')
    Pengguna | {{$user->name}}
@endsection

@section('content')

  <x-dashboard.navbar>
    {{$user->name}}
  </x-dashboard.navbar>

  <x-dashboard.sidebar/>

  <div class="py-7 md:px-5 lg:ml-64">
        <div class="pt-16 px-4 mx-auto max-w-screen-xl text-start">
          <div class="bg-primary-light rounded-lg shadow-md px-5 py-8 sm:px-8 md:p-12 md:mb-8">

            <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('user.index') }}">
                Pengguna
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                {{ $user->name }}
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>

            <div class="text-base-dark text-start mt-8 font-montserrat">
              <div class="flex justify-between items-center">
                <h1 class="page-header">
                  <x-icon.news class="mr-3" />
                  Info Pengguna
                </h1>
                <x-dashboard.link.add href="{{route('user.edit', $user->id)}}">
                  Edit Data
                </x-dashboard.link.add>
              </div>
              <p class="text-sm md font-medium pt-6">
                Username : <span class="italic">{{$user->username}}</span>
              </p>
              <p class="text-sm font-medium pt-4">
                Password : <span class="italic">Password sudah di <strong class="text-red-700">Hash</strong> silahkan masukkan password baru</span>
              </p>
            </div>
          </div>
        </div>
    </div>

@endsection
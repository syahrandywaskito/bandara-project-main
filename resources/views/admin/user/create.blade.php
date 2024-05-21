@extends('layouts.admin')

@section('title')
    Pengguna | Registrasi
@endsection

@section('content')
    
  <x-dashboard.navbar>
    Pengguna - Registrasi
  </x-dashboard.navbar>

  <x-dashboard.sidebar/>

  <div class="py-7 md:px-5 lg:ml-64">
      <div>
        <div class="py-16 px-4 mx-auto max-w-screen-xl text-start">
          <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">

            <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('user.index') }}">
                Pengguna
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                Registrasi
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8">
                <x-icon.plus class="mr-2" />
                Halaman Registrasi Pengguna
              </h1>

              <div class="flex-row items-center">
                <div class="mt-4">
                  <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">

                    @csrf 
                    <div class="grid grid-cols-1 grid-flow-row-dense gap-4">
 
                      <div class="col-span-1">
                        <x-dashboard.form.label for="name">
                          Nama
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="name" type="text" id="name" value="{{ old('name') }}" />
                        @error('name')
                            <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <div class="col-span-1">
                        <x-dashboard.form.label for="username">
                          Username
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="username" type="text" id="username" value="{{ old('username') }}"/>
                        @error('username')
                            <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <div class="col-span-1">
                        <x-dashboard.form.label for="password">
                          Password
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="password" type="text" id="password" value="{{ old('password') }}"/>
                        @error('password')
                            <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <div class="hidden">
                        <input type="radio" name="role" value="user" checked>
                      </div>

                      <x-dashboard.button.submit>
                        Registrasi
                      </x-dashboard.button.submit>
                    </div>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
  </div>

@endsection
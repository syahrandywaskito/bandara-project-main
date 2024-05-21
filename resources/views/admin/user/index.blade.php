@extends('layouts.admin')

@section('title')
    Pengguna
@endsection

@section('content')
    
    <x-dashboard.navbar>
      Pengguna
    </x-dashboard.navbar>

    <x-dashboard.sidebar/>

    <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

          <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.nonactive>
                Pengguna
              </x-dashboard.breadcrumb.nonactive>

          </x-dashboard.breadcrumb.main>

          <h1 class="page-header mt-8 mb-4">
            <x-icon.news class="mr-3" />
            Halaman Pengguna
          </h1>

          <p class="page-sub-header mb-3">
            Manage pengguna yang ter-register dan hanya terlihat oleh admin
          </p>

          <div class="grid grid-cols-3 gap-4 lg:flex lg:items-center lg:space-x-3 lg:py-3.5">

            <x-dashboard.link.add href="{{route('user.create')}}" class="col-span-3">
              Registrasi Pengguna
            </x-dashboard.link.add>

            <x-dashboard.search.main action="{{route('user.search')}}">
              <option selected>Pilih Kolom</option>
              <option value="name">Nama</option>
              <option value="username">Username</option>
            </x-dashboard.search.main>

            <x-dashboard.form.show-all action="{{route('user.index')}}" />
          </div>

          <div class="py-4 mt-4 lg:mt-0">
            <p class="page-sub-header uppercase font-semibold">Pengguna</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            @foreach ($users as $data)
              @if ($data->role !== 'admin')
                <div class="flex justify-between items-center bg-primary-light border-2 border-base-light shadow-md rounded-lg py-1.5 px-2.5">
                  <a href="{{route('user.show', $data->id)}}" class="flex items-center group">
                    <div class="text-sm group-hover:underline group-hover:text-secondary-light space-y-1">
                      <p class="text-sm font-medium">
                        {{$data->name}}
                      </p>
                    </div>
                  </a>
                  <form action="{{route('user.destroy', $data->id)}}" method="POST" onclick="return confirm('Hapus saran dari {{$data->name}} ?')" class="bg-secondary-light p-1.5 hover:opacity-75 rounded-lg text-primary-light shadow-md" title="hapus pengguna">

                    @csrf 
                    @method('DELETE')

                    <button type="submit" class="block cursor-default" title="hapus item">
                     <x-icon.cross/>
                    </button>
                  </form>
                </div>
              @endif
            @endforeach
          </div>

        </div>
      </div>
    </div>
    
    @endsection
@extends('layouts.admin')

@section('title')
    Kontak & Saran
@endsection

@section('content')
    
  <x-dashboard.navbar>
    Kontak & Saran
  </x-dashboard.navbar>

  <x-dashboard.sidebar />

  <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

          <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.nonactive>
                Kontak & Saran
              </x-dashboard.breadcrumb.nonactive>

          </x-dashboard.breadcrumb.main>

          <h1 class="page-header mt-8 mb-4">
            <x-icon.message class="mr-2" />
            Halaman Kontak & Saran
          </h1>
          <p class="page-sub-header mb-3">
            Lihat beberapa saran dan manage kontak aktif dari admin 
          </p>
          <div class="grid grid-cols-3 gap-4 lg:flex lg:items-center lg:space-x-3 lg:py-3.5">

            @if (isset($kontak))
              <x-dashboard.link.add href="{{route('contact.edit', $kontak->id)}}" class="col-span-3">
                Edit Kontak
              </x-dashboard.link.add>
            @else
              <x-dashboard.link.add href="{{route('contact.create')}}" class="col-span-3">
                Tambah Kontak
              </x-dashboard.link.add>
            @endif

            <x-dashboard.search.main action="{{route('saran.search')}}">
              <option selected>Pilih Kolom</option>
              <option value="nama">Nama</option>
              <option value="email">Email</option>
              <option value="subjek">Subjek</option>
              <option value="pesan">Pesan</option>
            </x-dashboard.search.main>

            <x-dashboard.form.show-all action="{{route('contact.index')}}" />
          </div>

          <div class="py-4 mt-4 lg:mt-0">
            <h3 class="page-sub-header uppercase font-semibold">Saran dari</h3>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach ($saran as $data)
            <div class="flex justify-between items-center bg-primary-light border-2 border-base-light shadow-md rounded-lg py-1.5 px-2.5">
              <a href="{{route('saran.show', $data->id)}}" class="flex space-x-4 items-center group">
                <div class="text-sm group-hover:underline group-hover:text-secondary-light">
                  <h3 class="text-sm font-medium">
                    {{$data->email}}
                  </h3>
                </div>
              </a>
              <form action="{{route('saran.destroy', $data->id)}}" method="POST" onclick="return confirm('Hapus saran dari {{$data->nama}} ?')" class="bg-secondary-light p-1.5 hover:opacity-75 rounded-lg text-primary-light shadow-md" title="hapus berita">

                @csrf 
                @method('DELETE')

                <button type="submit" class="block cursor-default">
                  <x-icon.cross/>
                </button>
              </form>
            </div>
            @endforeach
          </div>

        </div>
      </div>
    </div>

@endsection
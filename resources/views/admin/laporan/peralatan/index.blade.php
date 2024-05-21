@extends('layouts.admin')

@section('title')
    Peralatan
@endsection

@section('content')
    
    <x-dashboard.navbar>
      Peralatan
    </x-dashboard.navbar>

    <x-dashboard.sidebar />

    <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

          <x-dashboard.breadcrumb.main>
            <x-dashboard.breadcrumb.nonactive>
              Peralatan
            </x-dashboard.breadcrumb.nonactive>
          </x-dashboard.breadcrumb.main>

          <h1 class="page-header mt-8 mb-4">
            <x-icon.gear class="mr-3" />
            Halaman Peralatan
          </h1>

          <p class="page-sub-header mb-3">
            Manage Peralatan yang ada di Bandara Abdulrachman Saleh
          </p>
          
          <div class="grid grid-cols-3 gap-4 lg:flex lg:items-center lg:space-x-3 lg:py-3.5">

            <x-dashboard.link.add href="{{ route('peralatan.create') }}" class="col-span-3">
              Tambah Peralatan
            </x-dashboard.link.add>

            <x-dashboard.search.main action="{{ route('peralatan.search') }}">
                  <option selected>Pilih Kolom</option>
                  <option value="nama_peralatan">Nama Peralatan</option>
                  <option value="nama_personil">Nama Personil</option>
                  <option value="point">Point</option>
                  <option value="keterangan">Keterangan</option>
            </x-dashboard.search.main>

            <x-dashboard.form.show-all action="{{ route('peralatan.index') }}" />
          </div>

          <div class="py-4 mt-4 lg:mt-0">
            <p class="upage-sub-header uppercase font-semibold">Peralatan</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach ($peralatans as $data)

            <div class="flex justify-between items-center bg-primary-light border-2 border-base-light shadow-md rounded-lg py-1.5 px-2.5">
              <a href="{{ route('kegiatan.index', $data->id) }}" class="flex space-x-4 items-center group">
                <div class="text-sm group-hover:underline">
                  <p class="text-xs sm:text-sm capitalize">
                    {{ $data->nama_peralatan }}
                  </p>
                </div>
              </a>

              <div class="flex space-x-2">
                <a href="{{ route('peralatan.edit', $data->id) }}" class="bg-secondary-light p-1.5 hover:opacity-75 rounded-lg text-primary-light shadow-md" title="edit peralatan">
                  <x-icon.update/>
                </a>
  
                <form action="{{ route('peralatan.destroy', $data->id) }}" method="POST" onclick="return confirm('Hapus peralatan {{ $data->nama_peralatan }} ?')" class="bg-secondary-light p-1.5 hover:opacity-75 rounded-lg text-primary-light shadow-md" title="hapus peralatan">
  
                  @csrf 
                  @method('DELETE')
  
                  <button type="submit" class="block cursor-default">
                    <x-icon.cross/>
                  </button>
                </form>
              </div>

            </div>
            @endforeach
          </div>

        </div>
      </div>
    </div>

@endsection
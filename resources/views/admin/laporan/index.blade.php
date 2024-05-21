@extends('layouts.admin')

@section('title')
    Laporan
@endsection

@section('content')
    
    <x-dashboard.navbar>
      Laporan
    </x-dashboard.navbar>

    <x-dashboard.sidebar/>

    <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

          <x-dashboard.breadcrumb.main>
            <x-dashboard.breadcrumb.nonactive>
              Laporan
            </x-dashboard.breadcrumb.nonactive>
          </x-dashboard.breadcrumb.main>

          <h1 class="page-header mt-8 mb-4">
            <x-icon.gear class="mr-3" />
            Halaman Laporan
          </h1>

          <p class="page-sub-header mb-3">
            Input Laporan Peralatan yang ada di Bandara Abdulrachman Saleh
          </p>
          
          <div class="grid grid-cols-3 gap-4 lg:flex lg:items-center lg:space-x-3 lg:py-3.5">

            <x-dashboard.search.main action="{{ route('laporan.search') }}">
                  <option selected>Pilih Kolom</option>
                  <option value="nama_peralatan">Nama Peralatan</option>
                  <option value="nama_personil">Nama Personil</option>
                  <option value="point">Point</option>
                  <option value="keterangan">Keterangan</option>
            </x-dashboard.search.main>

            <x-dashboard.form.show-all action="{{ route('laporan.index') }}" />
          </div>

          <div class="py-4 mt-4 lg:mt-0">
            <p class="page-sub-header uppercase font-semibold">Peralatan</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">
            @foreach ($peralatans as $data)
            
            <a href="{{ route('input.index', $data->id) }}" class="flex justify-between items-center bg-primary-light border-2 border-base-light shadow-md rounded-lg py-1.5 px-2.5 hover:bg-secondary-light hover:border-secondary-light hover:text-base-light">
              <div class="flex space-x-4 items-center">
                <p class="text-xs sm:text-sm capitalize">
                  {{ $data->nama_peralatan }}
                </p>
              </div>

            </a>
            @endforeach
          </div>

        </div>
      </div>
    </div>
@endsection

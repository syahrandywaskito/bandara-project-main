@extends('layouts.admin')

@section('title')
    Edit Keterangan Laporan {{ $peralatan->nama_peralatan }}
@endsection

@section('content')
    
    <x-dashboard.navbar>
      {{ $peralatan->nama_peralatan }} - Edit Keterangan
    </x-dashboard.navbar>

    <x-dashboard.sidebar />

    <div class="py-7 md:px-5 lg:ml-64">
      <div>
        <div class="py-16 px-4 mx-auto max-w-screen-xl text-start">
          <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">

            <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('laporan.index') }}">
                Laporan
              </x-dashboard.breadcrumb.active>
              
              <x-dashboard.breadcrumb.active href="{{ route('input.index', $peralatan->id) }}">
                {{ $peralatan->nama_peralatan }}
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                ID Keterangan : {{ $keterangan->id }}
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8 mb-4">
                <x-icon.news class="mr-3"/>
                Informasi Keterangan Kegiatan {{ $periode->jenis_periode }}
              </h1>


              <div class="flex-row items-center">
                <div class="mt-4 flex justify-between items-end">
                  
                  <form action="{{ route('keterangan.update', [$peralatan->id, $keterangan->id]) }}" method="POST" enctype="multipart/form-data">

                    @csrf 
                    @method('PUT')
                    <div class="flex-row space-y-5">
 
                      <div class="">
                        <x-dashboard.form.label for="keterangan" class="">
                          Ubah Keterangan
                        </x-dashboard.form.label>

                        <textarea class="text-xs md:text-sm text-base-dark bg-primary-light shadow-md rounded-lg outline-none focus:border-secondary-light block w-full p-3" name="keterangan" id="keterangan" cols="60" rows="2" autofocus required>{{ $keterangan->keterangan }}</textarea>
                        @error('keterangan')
                            <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <x-dashboard.button.submit> 
                        Ubah
                      </x-dashboard.button.submit>
  
                    </div>
                  </form>

                  <form action="{{ route('keterangan.destroy', [$peralatan->id, $keterangan->id]) }}" onsubmit="return confirm('Hapus Keterangan ID : {{ $keterangan->id }} ?')" class="col-span-1 justify-end" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="inline-flex items-center px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-lg hover:bg-red-800 focus:z-10 focus:ring-2 focus:ring-red-600">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 mr-1 h-5">
                        <path
                          fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      Hapus
                    </button>
                  </form>

                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

@endsection
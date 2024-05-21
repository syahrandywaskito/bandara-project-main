@extends('layouts.admin')

@section('title')
    Edit Kondisi Peralatan {{ $inputLaporan->tanggal_laporan }}
@endsection

@section('content')
    
    <x-dashboard.navbar>
      Laporan - Edit Kondisi Peralatan
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
                ID Kondisi : {{ $inputLaporan->id }}
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8 mb-4">
                <x-icon.news class="mr-3"/>
                Informasi Kondisi Peralatan {{ $tanggal }}
              </h1>

              <p class="text-sm lg:text-base text-primary-dark mb-3">
                Kegiatan : <br>
                <span class="font-medium capitalize">
                  {{ $kegiatan->nama_kegiatan }}
                  @isset($detail_kegiatan)
                    [ {{ $detail_kegiatan->nama_detail_kegiatan }} ]
                  @endisset
                </span>
              </p>

              <div class="flex-row items-center">
                <div class="mt-4 flex justify-between items-end">
                  
                  <form action="{{ route('input.update', [$peralatan->id, $inputLaporan->id]) }}" method="POST" enctype="multipart/form-data">

                    @csrf 
                    @method('PUT')
                    <div class="flex-row space-y-5">
 
                      <div class="">
                        <x-dashboard.form.label for="nama-peralatan">
                          Ubah Kondisi Peralatan
                        </x-dashboard.form.label>

                        <x-dashboard.form.radio id="normal" name="kondisi" value="normal" checked="{{ $inputLaporan->kondisi == 'normal' ? 'checked' : ''}}">
                          Normal
                        </x-dashboard.form.radio>

                        <x-dashboard.form.radio id="tidak-normal" name="kondisi" value="tidak normal" checked="{{ $inputLaporan->kondisi == 'tidak normal' ? 'checked' : ''}}">
                          Ada Gangguan
                        </x-dashboard.form.radio>
                      </div>

                      <x-dashboard.button.submit> 
                        Ubah
                      </x-dashboard.button.submit>
  
                    </div>
                  </form>

                  <form action="{{ route('input.destroy', [$peralatan->id, $inputLaporan->id]) }}" onsubmit="return confirm('Hapus Kondisi Peralatan {{ $tanggal }} ?')" class="col-span-1 justify-end" method="POST">
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
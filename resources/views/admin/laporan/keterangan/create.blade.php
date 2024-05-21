@extends('layouts.admin')

@section('title')
    Keterangan {{ $peralatan->nama_peralatan }} {{ $format_bulan }}
@endsection

@section('content')
    
    <x-dashboard.navbar>
        {{ $peralatan->nama_peralatan }} - Input Keterangan
    </x-dashboard.navbar>

    <x-dashboard.sidebar/>

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
                Keterangan Bulan <span class="underline">{{ $format_bulan }}</span>
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8">
                <x-icon.plus class="mr-3"/>
                Input Keterangan bulan {{ $format_bulan }}
              </h1>

              @foreach ($periodes as $periode)
                <div class="flex-row items-center">
                  <div class="mt-5">
                    <form action="{{ route('keterangan.store', [$peralatan->id, $bulan]) }}" method="POST" enctype="multipart/form-data">

                      @csrf 
                      <div class="">
  
                        <div class="">
                          <x-dashboard.form.label for="keterangan-{{ $periode->id }}" class="font-medium">
                            Keterangan Kegiatan {{ $periode->jenis_periode }}
                          </x-dashboard.form.label>

                          <div class="lg:flex space-y-3 lg:space-y-0 lg:space-x-4 items-center">

                            <textarea class="text-xs md:text-sm text-base-dark bg-primary-light shadow-md rounded-lg outline-none focus:border-secondary-light block w-full lg:w-[50%] p-3" name="keterangan" id="keterangan-{{ $periode->id }}" required rows="1" autofocus></textarea>
                            @error('keterangan')
                                <x-error-alert>{{ $message }}</x-error-alert>
                            @enderror

                            <x-dashboard.form.input type="hidden" name="id_periode" value="{{ $periode->id }}" readonly />

                            <x-dashboard.button.submit>
                              Tambah
                            </x-dashboard.button.submit>
                          </div>

                        </div>
                        
                      </div>
                    </form>
                  </div>
                </div>
              @endforeach
              
          </div>
        </div>
      </div>
    </div>


@endsection

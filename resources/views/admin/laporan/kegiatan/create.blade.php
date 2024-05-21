@extends('layouts.admin')

@section('title')
    Tambah Kegiatan
@endsection

@section('content')

    <x-dashboard.navbar>
      Kegiatan - Tambah
    </x-dashboard.navbar>

    <x-dashboard.sidebar />

    <div class="py-7 md:px-5 lg:ml-64">
      <div>
        <div class="py-16 px-4 mx-auto max-w-screen-xl text-start">
          <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">

            <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('peralatan.index') }}">
                Peralatan
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.active href="{{ route('kegiatan.index', $peralatan->id) }}">
                Kegiatan {{ $peralatan->nama_peralatan }}
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                Tambah Kegiatan
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8">
                <x-icon.plus class="mr-3"/>
                Halaman Tambah Kegiatan
              </h1>

              @foreach ($periodes as $periode)
                <div class="flex-row items-center">
                  <div class="mt-5">
                    <form action="{{ route('kegiatan.store', $peralatan->id) }}" method="POST" enctype="multipart/form-data">

                      @csrf 
                      <div class="grid grid-cols-1 md:grid-cols-2 grid-flow-row-dense gap-4">
  
                        <div class="col-span-2 xl:w-3/4">
                          <x-dashboard.form.label for="nama-peralatan-{{ $periode->id }}" class="font-medium">
                            Nama Kegiatan {{ $periode->jenis_periode }}
                          </x-dashboard.form.label>

                          <div class="lg:flex space-y-3 lg:space-y-0 lg:space-x-4">
                            <x-dashboard.form.input name="nama_kegiatan" type="text" id="nama-kegiatan-{{ $periode->id }}" value="{{ old('nama_kegiatan') }}" autofocus/>
                            @error('nama_kegiatan')
                                <x-error-alert>{{ $message }}</x-error-alert>
                            @enderror

                            <x-dashboard.form.input type="hidden" name="id_periode" value="{{ $periode->id }}" />

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
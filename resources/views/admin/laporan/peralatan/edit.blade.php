@extends('layouts.admin')

@section('title')
    Edit | {{ $peralatan->nama_peralatan }}
@endsection

@section('content')
    <x-dashboard.navbar>
      Peralatan - Edit
    </x-dashboard.navbar>

    <x-dashboard.sidebar/>

    <div class="py-7 md:px-5 lg:ml-64">
      <div>
        <div class="py-16 px-4 mx-auto max-w-screen-xl text-start">
          <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">

            <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('peralatan.index') }}">
                Peralatan
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                Edit Peralatan {{ $peralatan->nama_peralatan }}
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8">
                <x-icon.update class="mr-2"/>
                Halaman Edit Peralatan
              </h1>

              <div class="flex-row items-center">
                <div class="mt-4">
                  <form action="{{ route('peralatan.update', $peralatan->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf 
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 grid-flow-row-dense gap-4">
 
                      <div class="col-span-2">
                        <x-dashboard.form.label for="nama-peralatan">
                          Nama Peralatan
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="nama_peralatan" type="text" id="nama-peralatan" value="{{ $peralatan->nama_peralatan }}"/>
                        @error('nama_peralatan')
                          <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <div class="col-span-2 md:col-span-1">
                        <x-dashboard.form.label for="point">
                          Point
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="point" type="text" id="point" value="{{ $peralatan->point }}" />
                        @error('point')
                          <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <div class="col-span-2 md:col-span-1">
                        <x-dashboard.form.label for="keterangan">
                          Keterangan
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="keterangan" type="text" id="keterangan" value="{{ $peralatan->keterangan }}"/>
                        @error('keterangan')
                          <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <x-dashboard.button.submit>
                        Ubah
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
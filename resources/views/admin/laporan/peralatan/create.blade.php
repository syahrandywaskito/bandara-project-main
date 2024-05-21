@extends('layouts.admin')

@section('title')
    Tambah Peralatan
@endsection

@section('content')
    
    <x-dashboard.navbar>
      Peralatan - Tambah
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

              <x-dashboard.breadcrumb.nonactive>
                Tambah Peralatan
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8">
                <x-icon.plus class="mr-3"/>
                Halaman Tambah Peralatan
              </h1>

              <div class="flex-row items-center">
                <div class="mt-4">
                  <form action="{{ route('peralatan.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf 
                    <div class="grid grid-cols-1 md:grid-cols-2 grid-flow-row-dense gap-4">
 
                      <div class="col-span-2">
                        <x-dashboard.form.label for="nama-peralatan">
                          Nama Peralatan
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="nama_peralatan" type="text" id="nama-peralatan" value="{{ old('nama_peralatan') }}" autofocus/>
                        @error('nama_peralatan')
                          <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <div class="col-span-2 md:col-span-1">
                        <x-dashboard.form.label for="point">
                          Point
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="point" type="text" id="point" value="{{ old('point') }}"/>
                        @error('point')
                          <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <div class="col-span-2 md:col-span-1">
                        <x-dashboard.form.label for="keterangan">
                          Keterangan
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="keterangan" type="text"  id="keterangan" value="{{ old('keterangan') }}"/>
                        @error('keterangan')
                          <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <x-dashboard.form.input name="nama_personil" type="hidden" value="{{ auth()->user()->name }}" readonly/>

                      <x-dashboard.button.submit>
                        Tambah
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

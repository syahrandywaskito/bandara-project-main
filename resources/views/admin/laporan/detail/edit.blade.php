@extends('layouts.admin')

@section('title')
    Edit Detail Kegiatan
@endsection

@section('content')

    <x-dashboard.navbar>
      Detail Kegiatan - Edit
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

              <x-dashboard.breadcrumb.active href="{{ route('detail.index', [$peralatan->id, $kegiatan->id]) }}">
                Detail Kegiatan {{ $periode->jenis_periode }}
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                Edit Detail
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8">
                <x-icon.update class="mr-2"/>
                Halaman Edit Detail Kegiatan
              </h1>

              <div class="flex-row items-center">
                <div class="mt-4">
                  <form action="{{ route('detail.update', [$peralatan->id, $kegiatan->id, $detail->id]) }}" method="POST" enctype="multipart/form-data">

                    @csrf 
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 grid-flow-row-dense gap-4">
 
                      <div class="col-span-2">
                        <x-dashboard.form.label for="nama-detail-kegiatan">
                          Nama Detail Kegiatan
                        </x-dashboard.form.label>

                        <x-dashboard.form.input name="nama_detail_kegiatan" type="text" id="nama-detail-kegiatan" value="{{ $detail->nama_detail_kegiatan }}" />
                        @error('nama_detail_kegiatan')
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


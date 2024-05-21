@extends('layouts.admin')

@section('title')
    Detail kegiatan
@endsection

@section('content')
    
    <x-dashboard.navbar>
      Kegiatan - Detail
    </x-dashboard.navbar>

    <x-dashboard.sidebar />

     <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

           <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('peralatan.index') }}">
                Peralatan
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.active href="{{ route('kegiatan.index', $peralatan->id) }}">
                Kegiatan {{ $peralatan->nama_peralatan }}
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                Detail Kegiatan {{ $periode->jenis_periode }}
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>

          <h1 class="page-header mt-8 mb-4">
            <x-icon.gear class="mr-3" />
            Halaman Detail Kegiatan
          </h1>

          <p class="page-sub-header mb-3">
              Dari Uraian Kegiatan "<span class="italic font-semibold">{{ $kegiatan->nama_kegiatan }}</span>" <br>
              Tambah detail kegiatan jika diperlukan untuk pengecekan peralatan yang ada di Bandara Abdulrachman Saleh
          </p>
          
          <div class="grid grid-cols-3 gap-4 lg:flex lg:items-center lg:space-x-3 lg:py-3.5">

            <x-dashboard.link.add href="{{ route('detail.create', [$peralatan->id, $kegiatan->id]) }}" class="col-span-3">
              Tambah Detail
            </x-dashboard.link.add>

          </div>

          <div class="py-4 mt-4 lg:mt-0">
            <h3 class="page-sub-header uppercase font-semibold">Detail Tambahan</h3>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            @foreach ($details as $data)
            
            <div class="flex justify-between items-center bg-primary-light border-2 border-base-light shadow-md rounded-lg py-1.5 px-2.5">
              <div class="flex space-x-4 items-center group">
                <div class="text-sm cursor-default">
                  <p class="text-xs sm:text-sm capitalize">
                    {{ $data->nama_detail_kegiatan }}
                  </p>
                </div>
              </div>

              <div class="flex space-x-2">
                <a href="{{ route('detail.edit', [$peralatan->id, $kegiatan->id, $data->id]) }}" class="bg-secondary-light p-1.5 hover:opacity-75 rounded-lg text-primary-light shadow-md" title="edit peralatan">
                  <x-icon.update/>
                </a>
  
                <form action="{{ route('detail.destroy', [$peralatan->id, $kegiatan->id, $data->id]) }}" method="POST" onclick="return confirm('Hapus detail kegiatan {{ $data->nama_detail_kegiatan }} ?')" class="bg-secondary-light p-1.5 hover:opacity-75 rounded-lg text-primary-light shadow-md" title="hapus peralatan">
  
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
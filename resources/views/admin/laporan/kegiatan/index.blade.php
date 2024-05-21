@extends('layouts.admin')

@section('title')
    Kegiatan
@endsection

@section('content')

    <x-dashboard.navbar>
      {{ $peralatan->nama_peralatan }} - Kegiatan
    </x-dashboard.navbar>

    <x-dashboard.sidebar />

    <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

          <x-dashboard.breadcrumb.main>

            <x-dashboard.breadcrumb.active href="{{ route('peralatan.index') }}" >
                Peralatan
            </x-dashboard.breadcrumb.active>

            <x-dashboard.breadcrumb.nonactive>
                Kegiatan {{ $peralatan->nama_peralatan }}
            </x-dashboard.breadcrumb.nonactive>

          </x-dashboard.breadcrumb.main>

          <div class="flex justify-between items-center mt-8 mb-4">
            <h1 class="page-header">
              <x-icon.news class="mr-3" />
              Halaman Kegiatan
            </h1>
            <x-dashboard.link.add href="{{ route('input.index', $peralatan->id) }}">
              Input Laporan
            </x-dashboard.link.add>
          </div>

          <p class="page-sub-header mb-3">
            Manage kegiatan untuk keperluan pengecekan peralatan yang ada di Bandara Abdulrachman Saleh <br>
            <span class="text-red-600">* </span>
            <span class="italic">Jika kegiatan memiliki detail tambahan maka akan berwarna 
              <span class="text-indigo-500 underline">Biru</span>
            </span>
          </p>

          <p class="page-sub-header mb-3 capitalize">
            <span class="font-medium underline">
              Informasi Peralatan
            </span>
              
            <table class="capitalize">
              <tr>
                <td  class="">Nama Peralatan </td>
                <td  class="px-4"> : {{ $peralatan->nama_peralatan }}</td>
              </tr>
              <tr>
                <td  class="">{{ $peralatan->point }}</td>
                <td  class="px-4"> : {{ $peralatan->keterangan }}</td>
              </tr>
            </table>

          </p>

          <div class="grid grid-cols-3 gap-4 lg:flex lg:items-center lg:space-x-3 lg:py-3.5">

            <x-dashboard.link.add href="{{ route('kegiatan.create', $peralatan->id) }}" class="col-span-3">
              Tambah Kegiatan
            </x-dashboard.link.add>
          </div>

          <div class="lg:flex lg:justify-between lg:gap-x-5 xl:gap-x-0">

            @foreach ($periodes as $periode)
            
            <div>
              <div class="pb-3 pt-6 lg:mt-0">
                  <h3 class="page-sub-header uppercase font-semibold text-center">{{ $periode->jenis_periode }}</h3>
              </div>

              <div class="grid grid-cols-1 gap-4">
              
              @php
                  $kegiatans = $object_kg->where('id_periode', $periode->id)->get();
              @endphp

              @foreach ($kegiatans as $data)

              @php
                  
                  $id_kegiatan = $data->id;

                  $detail_kegiatan = DB::table('detail_kegiatans')
                                    ->whereExists(function ($query) use ($id_kegiatan) {
                                        $query->select('id')
                                            ->from('kegiatans')
                                            ->whereColumn('kegiatans.id', 'detail_kegiatans.id_kegiatan')
                                            ->where('kegiatans.id', $id_kegiatan);
                                    })->get();
              @endphp

              <div  @if (count($detail_kegiatan) > 0)
                      class="flex justify-between items-center bg-indigo-300 border-2 border-indigo-300 shadow-md rounded-lg py-1.5 px-2.5 gap-x-4"
                    @else
                      class="flex justify-between items-center bg-primary-light border-2 border-base-light shadow-md rounded-lg py-1.5 px-2.5 gap-x-4"
                    @endif
                    >
                <a href="{{ route('detail.index', [$peralatan->id, $data->id]) }}" class="flex space-x-4 items-center group" title="{{ $data->nama_kegiatan }}">
                  <div class="text-sm group-hover:underline">
                    <p class="text-xs sm:text-sm capitalize">
                      {!! Str::limit(strip_tags($data->nama_kegiatan), $limit = 25, $end = '...') !!}
                    </p>
                  </div>
                </a>
  
                <div class="flex space-x-2">
                  <a href="{{ route('kegiatan.edit', [$peralatan->id, $data->id]) }}" class="bg-secondary-light p-1.5 hover:opacity-75 rounded-lg text-primary-light shadow-md" title="edit peralatan">
                    <x-icon.update/>
                  </a>
    
                  <form action="{{ route('kegiatan.destroy', [$peralatan->id, $data->id]) }}" method="POST" onclick="return confirm('Hapus Kegiatan ( {{ $data->nama_kegiatan }} ) ?')" class="bg-secondary-light p-1.5 hover:opacity-75 rounded-lg text-primary-light shadow-md" title="hapus peralatan">
    
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
                
            @endforeach


          </div>

        </div>
      </div>
    </div>

@endsection

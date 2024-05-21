@extends('layouts.admin')

@section('title')
    Laporan
@endsection

@section('content')
    
    <x-dashboard.navbar>
      {{ $peralatan->nama_peralatan }} - Input Laporan
    </x-dashboard.navbar>

    <x-dashboard.sidebar />

    <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

          <x-dashboard.breadcrumb.main>

            <x-dashboard.breadcrumb.active href="{{ route('laporan.index') }}">
              Laporan
            </x-dashboard.breadcrumb.active>

            <x-dashboard.breadcrumb.nonactive>
              {{ $peralatan->nama_peralatan }}
            </x-dashboard.breadcrumb.nonactive>

          </x-dashboard.breadcrumb.main>

          <h1 class="page-header mt-8 mb-4">
            <x-icon.gear class="mr-3" />
            Laporan {{ $peralatan->nama_peralatan }}
          </h1>

          <p class="page-sub-header mb-3">
            Input laporan berupa kondisi <em>harian, mingguan</em> dan <em>bulanan</em> untuk peralatan <span class="font-medium text-secondary-light underline">{{ $peralatan->nama_peralatan }} - {{ $peralatan->keterangan }}</span>  <br>
            Bulan
            <span class="font-medium underline text-secondary-light">
               {{ $format_month }}
            </span>
          </p>
          
          <div class="grid grid-cols-3 gap-4 lg:flex lg:items-center lg:space-x-3 lg:py-3.5">

            <div class="flex-initial w-60">
                <form class="flex items-center" method="get" action="{{ route('input.index', $peralatan->id) }}">
                  <label for="date" class="sr-only">Search</label>

                  <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <x-icon.clock/>
                    </div>
                    <input
                      type="month"
                      id="date"
                      name="date"
                      class="z-20 text-xs md:text-sm text-base-dark bg-base-light rounded-lg outline-none focus:border-secondary-light block w-full pl-10 p-2"
                      required
                    />
                  </div>

                  <x-dashboard.button.date />
                </form>
            </div>

          </div>

          <div class="py-4 mt-4 lg:mt-0">
            <h3 class="page-sub-header uppercase font-semibold">Tabel Laporan</h3>
          </div>
          
          <div class="relative overflow-x-auto">
            <table class="w-full border-collapse border border-slate-500">
              <thead class="uppercase text-sm">  
                <tr>
                  <th rowspan="2" colspan="2" class="border border-slate-500 font-medium hover:bg-secondary-light hover:text-primary-light">
                    <a href="{{ route('kegiatan.index', $peralatan->id) }}" class="p-1">Uraian Kegiatan</a>
                  </th>
                  <th colspan="{{ $jumlah_hari }}" class="border border-slate-500 p-1 font-medium">Tanggal Kegiatan</th>
                  <th rowspan="2" class="border border-slate-500 p-1 font-medium hover:bg-secondary-light hover:text-primary-light">
                    <a href="{{ route('keterangan.create', [$peralatan->id, $date]) }}">Keterangan</a>
                  </th>
                </tr>
                <tr>
                  @for ($i = 1; $i <= $jumlah_hari; $i++)

                    <th class="border border-slate-500 p-1 font-medium hover:bg-secondary-light hover:text-base-light">
                      <a href="{{ route('input.create', [$peralatan->id, $date.'-'.$i]) }}">
                        {{ $i }}
                      </a>
                    </th>

                  @endfor
                </tr>
              </thead>    
              <tbody class="text-sm">
                @foreach ($periodes as $periode)

                  @php
                      $kegiatans = $KEGIATAN->where('id_periode', $periode->id)->get();

                      $field_keterangan = ['bulan' => $date.'-1', 'id_periode' => $periode->id];
                      $keterangans = $KETERANGAN->where($field_keterangan)->get();
                      $alfanum = 'a';
                  @endphp

                    <tr>
                      <td colspan="2" class="border border-slate-500 p-1 font-medium">
                       Pemeliharaan {{ $periode->jenis_periode }}
                      </td>
                      <td colspan="{{ $jumlah_hari }}" class="border border-slate-500 p-1"></td>

                      @foreach ($kegiatans as $kegiatan)
                          @php
                              $jumlah_data_detail = $DETAIL_KEGIATAN->where('id_kegiatan', $kegiatan->id)->count();
                          @endphp
                      @endforeach

                      <td class="border border-slate-500 align-text-top" rowspan="{{ count($kegiatans) + $jumlah_data_detail + 1}}">
                        @foreach ($keterangans as $keterangan)
                            <a href="{{ route('keterangan.edit', [$peralatan->id, $keterangan->id]) }}" class="block hover:bg-secondary-light hover:text-primary-light py-2 px-1 ">
                              {{ $keterangan->keterangan }}
                            </a>
                        @endforeach
                      </td>
                    </tr>
                    
                    @foreach ($kegiatans as $kegiatan)

                        <tr>
                          <td class="border border-slate-500 p-1">{{ $alfanum++ }}</td>
                          <td class="border border-slate-500 p-1">{{ $kegiatan->nama_kegiatan }}</td>

                          @php
                              $id_kegiatan = $kegiatan->id;

                              $detail_kegiatan = DB::table('detail_kegiatans')
                                                ->whereExists(function ($query) use ($id_kegiatan) {
                                                    $query->select('id')
                                                        ->from('kegiatans')
                                                        ->whereColumn('kegiatans.id', 'detail_kegiatans.id_kegiatan')
                                                        ->where('kegiatans.id', $id_kegiatan);
                                                })->get();
                          @endphp

                          @if (count($detail_kegiatan) <= 0)

                              @for ($i = 1; $i <= $jumlah_hari; $i++)

                                @php

                                    $tanggal_laporan = $date. '-' .$i;
                                    $kolom_kegiatan = [
                                      'tanggal_laporan' => $tanggal_laporan,
                                      'id_kegiatan' => $kegiatan->id,
                                    ];
                                    $laporan_kegiatans = $INPUT_LAPORAN->where($kolom_kegiatan)->get();

                                @endphp

                                <td  class="border border-slate-500 hover:bg-secondary-light hover:text-primary-light">

                                    @foreach ($laporan_kegiatans as $laporan)
                                    
                                      @php
                                          $date_array = explode('-', $laporan->tanggal_laporan);
                                          $tanggal = (int)$date_array[2];
                                      @endphp
  
                                      @isset($tanggal)
  
                                        @if ($tanggal === $i )
                                          
                                          <a href="{{ route('input.edit', [$peralatan->id, $laporan->id]) }}" class="block p-1">
                                            {{ $laporan->kondisi === 'normal' ? '√' : 'G' }}
                                          </a>
  
                                        @endif
                                          
                                      @endisset
                                    
                                    @endforeach

                                </td>

                              @endfor

                          @else
                             <td colspan="{{ $jumlah_hari }}" class="border border-slate-500 p-1"></td>
                          @endif

                        </tr>

                        @php
                            $detail_k = $DETAIL_KEGIATAN->where('id_kegiatan', $kegiatan->id)->get();
                        @endphp

                        @foreach ($detail_k as $detail)

                          <tr>
                            <td class="border border-slate-500 p-1"></td>
                            <td class="border border-slate-500 p-1">{{ $detail->nama_detail_kegiatan }}</td>

                            @for ($i = 1; $i <= $jumlah_hari; $i++)

                              @php
                                  
                                  $tanggal_laporan = $date.'-'.$i;
                                  $kolom_detail_k = [
                                    'tanggal_laporan' => $tanggal_laporan,
                                    'id_detail_kegiatan' => $detail->id,
                                  ];
                                  $laporan_detail_k = $INPUT_LAPORAN->where($kolom_detail_k)->get();    
                              @endphp

                              <td class="border border-slate-500 p-1 hover:bg-secondary-light hover:text-primary-light">

                                @foreach ($laporan_detail_k as $laporan)
                                
                                  @php
                                      $date_array = explode('-', $laporan->tanggal_laporan);
                                      $tanggal = (int)$date_array[2];
                                  @endphp

                                  @isset($tanggal)
  
                                    @if ($tanggal === $i )
                                      
                                      <a href="{{ route('input.edit', [$parameter_peralatan, $laporan->id]) }}">
                                        <span>{{ $laporan->kondisi === 'normal' ? '√' : 'G' }}</span>            
                                      </a>
  
                                    @endif
                                          
                                  @endisset

                                @endforeach

                              </td>
                                
                            @endfor

                          </tr>

                        @endforeach

                    @endforeach

                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
@endsection

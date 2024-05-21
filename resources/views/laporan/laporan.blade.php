<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengecekan {{ $peralatan->nama_peralatan }}</title>

    <link rel="icon" href="{{asset('img/dishub.png')}}" type="image/x-icon">

    @vite('resources/css/app.css')
</head>
<body onload="window.print()" class="text-black">
{{-- <body class="text-black"> --}}
    <h1 class="font-bold text-base text-center uppercase">
      JADWAL PELAKSANAAN KEGIATAN PEMELIHARAAN PENCEGAHAN
    </h1>
    <h3 class="text-center text-sm">(Pemeliharaan Harian, Mingguan dan Bulanan)</h3>
    <div class="mt-3 mr-52 text-sm">
      <div class="flex w-full justify-between">
        <div>
          <table class="capitalize">
            <tr>
              <td class="">Nama Peralatan </td>
              <td class="">
                <span class="px-1">:</span> {{ $peralatan->nama_peralatan }}
              </td>
            </tr>
            <tr>
              <td class="">{{ $peralatan->point }} </td>
              <td class="">
                <span class="px-1">:</span> {{ $peralatan->keterangan }}
              </td>
            </tr>
          </table>
        </div>
  
        <div>
          <table class="capitalize">
            <tr>
              <td class="">Bulan </td>
              <td class="">
                <span class="px-2">:</span> {{ $format_bulan }}
              </td>
            </tr>
            <tr>
              <td class="">Tahun </td>
              <td class="">
                <span class="px-2">:</span> {{ $format_tahun }}
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

   <div class="relative overflow-x-auto mt-3">
      <table class="w-[95%] border-collapse border border-gray-700">
        <thead class="uppercase text-xs">  
          <tr>
            <th rowspan="2" colspan="2" class="border border-gray-700 font-medium">
              Uraian Kegiatan
            </th>
            <th colspan="{{ $jumlah_hari }}" class="border border-gray-700 font-medium">Tanggal Kegiatan</th>
            <th rowspan="2" class="border border-gray-700 font-medium">
              <span>Keterangan</span>
            </th>
          </tr>

          <tr>
            @for ($i = 1; $i <= $jumlah_hari; $i++)

              <th class="border border-gray-700 px-1 font-medium">
                {{ $i }}
              </th>

            @endfor
          </tr>

        </thead>

        <tbody class="text-xs">
          @foreach ($periodes as $periode)

            @php
              $kegiatans = $KEGIATAN->where('id_periode', $periode->id)->get();

              $field_keterangan = ['bulan' => $date.'-1', 'id_periode' => $periode->id];
              $keterangans = $KETERANGAN->where($field_keterangan)->get();
              $alfanum = 'a';
            @endphp

            <tr>
              <td colspan="2" class="border border-gray-700 py-0.5 px-1 font-medium">
                Pemeliharaan {{ $periode->jenis_periode }}
              </td>
              <td colspan="{{ $jumlah_hari }}" class="border border-gray-700 p-0.5"></td>

                @foreach ($kegiatans as $kegiatan)
                  @php
                    $jumlah_data_detail = $DETAIL_KEGIATAN->where('id_kegiatan', $kegiatan->id)->count();
                  @endphp
                @endforeach

                <td class="border border-gray-700 align-text-top" rowspan="{{ count($kegiatans) + $jumlah_data_detail + 1}}">
                  @foreach ($keterangans as $keterangan)
                    <span class="p-1 block">
                      {{ $keterangan->keterangan }}
                    </span>
                  @endforeach
                </td>
            </tr>
                    
            @foreach ($kegiatans as $kegiatan)

              <tr>
                <td class="border border-gray-700 px-1">{{ $alfanum++ }}</td>
                <td class="border border-gray-700 py-0.5 px-1">{{ $kegiatan->nama_kegiatan }}</td>

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
                      $kolom_kegiatan = [
                        'tanggal_laporan' => $date.'-'.$i,
                        'id_kegiatan' => $kegiatan->id,
                      ];
                      $laporan_kegiatans = $INPUT_LAPORAN->where($kolom_kegiatan)->get();

                    @endphp

                    <td  class="border border-gray-700">
                      <div class="flex justify-center items-center">
                        @foreach ($laporan_kegiatans as $laporan)     
                          @php
                            $date_array = explode('-', $laporan->tanggal_laporan);
                            $tanggal = (int)$date_array[2];
                          @endphp
      
                          @isset($tanggal)
                            @if ($tanggal === $i )
                              {{ $laporan->kondisi === 'normal' ? '√' : 'G' }}
                            @endif    
                          @endisset      
                        @endforeach
                      </div>
                    </td>

                  @endfor

                  @else
                    <td colspan="{{ $jumlah_hari }}" class="border border-gray-700 p-0.5"></td>
                  @endif

              </tr>

              @php
                $detail_k = $DETAIL_KEGIATAN->where('id_kegiatan', $kegiatan->id)->get();
              @endphp

              @foreach ($detail_k as $detail)

                <tr>
                  <td class="border border-gray-700 px-1"></td>
                  <td class="border border-gray-700 py-0.5 px-1">{{ $detail->nama_detail_kegiatan }}</td>

                    @for ($i = 1; $i <= $jumlah_hari; $i++)

                      @php
                        $kolom_detail_k = [
                            'tanggal_laporan' => $date.'-'.$i,
                            'id_detail_kegiatan' => $detail->id,
                          ];
                        $laporan_detail_k = $INPUT_LAPORAN->where($kolom_detail_k)->get();    
                      @endphp

                      <td class="border border-gray-700">
                        <div class="flex justify-center items-center">
                          @foreach ($laporan_detail_k as $laporan)
                                  
                            @php
                              $date_array = explode('-', $laporan->tanggal_laporan);
                              $tanggal = (int)$date_array[2];
                            @endphp
  
                            @isset($tanggal)
                              @if ($tanggal === $i )
                                {{ $laporan->kondisi === 'normal' ? '√' : 'G' }}            
                              @endif
                            @endisset
  
                          @endforeach
                        </div>
                      </td>
                                
                    @endfor
                </tr>

              @endforeach

            @endforeach

          @endforeach

          <tr>
            <td colspan="2" class="border border-gray-700 px-1 font-medium text-center">PELAKSANA</td>
            <td colspan="{{ $jumlah_hari }}" class="border border-gray-700"></td>
            <td rowspan="2"></td>
          </tr>

          <tr>
            <td colspan="2" class="border border-gray-700 px-1 font-medium text-center">PENGAWAS</td>
            <td colspan="{{ $jumlah_hari }}" class="border border-gray-700"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="flex mt-2 justify-between items-center ml-28 mr-52">

      <div class="text-sm">
        <table>
          <tr>
            <td>Keterangan :</td>
          </tr>
          <tr>
            <td>√ = Normal</td>
          </tr>
          <tr>
            <td>G = Ada gangguan</td>
          </tr>
        </table>
        <table class="mt-4">
          <tr>
            <td>Personil </td>
            <td>
              <span class="px-2.5">:</span> {{ $peralatan->nama_personil }}</td>
          </tr>
        </table>
      </div>

      <div class="text-sm">
        <p class="text-center">
          Penanggung jawab : <br>
          Kepala Seksi <br>
          Teknik dan Pelayanan Jasa
        </p>

        <div class="my-14">
          
        </div>
        
        <p class="text-center">
          <span class="font-bold underline">
            DIAN TUNJUNGSARI IKA W. S.Sos., M.M
          </span>
          <br>
          NIP. 19771212 199903 2 001
        </p>
      </div>
    </div>
</body>
</html>

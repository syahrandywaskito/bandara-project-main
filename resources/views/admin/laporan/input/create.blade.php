@extends('layouts.admin')

@section('title')
    Tambah Kondisi Peralatan {{ $tanggal }}
@endsection

@section('content')
    <x-dashboard.navbar>
      Laporan - Tambah Kondisi Peralatan
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
                Input Kondisi <u>{{ $formated_tanggal }}</u>
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8">
                <x-icon.plus class="mr-3"/>
                Input Kondisi {{ $formated_tanggal }}
              </h1>

              <div class="flex-row items-center">
                <div class="mt-4">
                  <form action="{{ route('input.store', [$peralatan->id, $tanggal]) }}" method="POST" enctype="multipart/form-data">

                    @csrf 

                    @foreach ($periodes as $periode)    

                      @php
                          $kegiatans = $KEGIATAN->where('id_periode', $periode->id)->get()
                      @endphp
                      <table class="my-4 border border-slate-300 w-full">
                        <tr>
                          <td class="border py-1 px-2 bg-gray-100" colspan="4">
                            <p class="text-xs md:text-sm  text-primary-dark capitalize font-medium">
                              {{ $periode->jenis_periode }}
                            </p>
                          </td>
                        </tr>
                        @foreach ($kegiatans as $kegiatan)

                          @php
                              $id_kegiatan = $kegiatan->id;

                              $detail_kegiatan = DB::table('detail_kegiatans')
                                                ->whereExists(function ($query) use ($id_kegiatan) {
                                                    $query->select('id')
                                                        ->from('kegiatans')
                                                        ->whereColumn('kegiatans.id', 'detail_kegiatans.id_kegiatan')
                                                        ->where('kegiatans.id', $id_kegiatan);
                                                })->get();

                              $field_kegiatan = ['tanggal_laporan' => $tanggal, 'id_kegiatan' => $kegiatan->id];
                              $laporan_kegiatan = $INPUT_LAPORAN->where($field_kegiatan)->first();
                          @endphp
                          <tr>
                            <td class="border border-slate-300 px-2 py-1 w-[60%] capitalize text-xs md:text-sm" colspan="2">
                              {{ $kegiatan->nama_kegiatan }}
                            </td>

                            @if (count($detail_kegiatan) <= 0 &&!isset($laporan_kegiatan))
                              @if ($periode->jenis_periode === 'harian')
                                <td class="border border-slate-300 px-2 py-1">
                                  <x-dashboard.form.radio id="normal-{{ $kegiatan->id }}" name="kondisi_kegiatan[{{ $kegiatan->id }}]" value="normal">
                                    Normal
                                  </x-dashboard.form.radio>
                                </td>
                                <td class="border border-slate-300 px-2 py-1">
                                  <x-dashboard.form.radio id="tidak-normal-{{ $kegiatan->id }}" name="kondisi_kegiatan[{{ $kegiatan->id }}]" value="tidak normal">
                                  Ada Gangguan
                                  </x-dashboard.form.radio>
                                </td>
                                <td class="hidden">
                                  <input type="hidden" name="id_kegiatan[{{ $kegiatan->id }}]" value="{{ $kegiatan->id }}">
                                </td>

                              @elseif($periode->jenis_periode === 'mingguan')
                                @foreach ($jadwal_mingguan as $item => $value)
                                  @if ($value === $tanggal_int)
                                    <td class="border border-slate-300 px-2 py-1">
                                      <x-dashboard.form.radio id="normal-{{ $kegiatan->id }}" name="kondisi_kegiatan[{{ $kegiatan->id }}]" value="normal">
                                        Normal
                                      </x-dashboard.form.radio>
                                    </td>
                                    <td class="border border-slate-300 px-2 py-1">
                                      <x-dashboard.form.radio id="tidak-normal-{{ $kegiatan->id }}" name="kondisi_kegiatan[{{ $kegiatan->id }}]" value="tidak normal">
                                        Ada Gangguan
                                      </x-dashboard.form.radio>
                                    </td>
                                    <td class="hidden">
                                      <input type="hidden" name="id_kegiatan[{{ $kegiatan->id }}]" value="{{ $kegiatan->id }}">
                                    </td>
                                  @endif
                                @endforeach
                              
                              @elseif($periode->jenis_periode === 'bulanan' && $tanggal_int === 1)
                                <td class="border border-slate-300 px-2 py-1">
                                  <x-dashboard.form.radio id="normal-{{ $kegiatan->id }}" name="kondisi_kegiatan[{{ $kegiatan->id }}]" value="normal">
                                    Normal
                                  </x-dashboard.form.radio>
                                </td>
                                <td class="border border-slate-300 px-2 py-1">
                                  <x-dashboard.form.radio id="tidak-normal-{{ $kegiatan->id }}" name="kondisi_kegiatan[{{ $kegiatan->id }}]" value="tidak normal">
                                    Ada Gangguan
                                  </x-dashboard.form.radio>
                                </td>
                                <td class="hidden">
                                  <input type="hidden" name="id_kegiatan[{{ $kegiatan->id }}]" value="{{ $kegiatan->id }}">
                                </td>
                              @endif
                            @endif

                          </tr>

                          @php
                              $details = $DETAIL_KEGIATAN->where('id_kegiatan', $kegiatan->id)->get();
                              $point_list = 'a';
                          @endphp
                          @foreach ($details as $detail)
                              @php
                                   $field_detail = ['tanggal_laporan' => $tanggal, 'id_detail_kegiatan' => $detail->id];
                                   $laporan_kegiatan_d = $INPUT_LAPORAN->where($field_detail)->first();
                              @endphp

                              <tr>

                                <td class="border border-slate-300 px-2 py-1 w-[1%] capitalize text-xs md:text-sm">{{ $point_list++ }}</td>
                                <td class="border border-slate-300 px-2 py-1 w-[57.6%] capitalize text-xs md:text-sm">
                                  {{ $detail->nama_detail_kegiatan }}
                                </td>
                                
                                @if (!isset($laporan_kegiatan_d))
                                  @if ($periode->jenis_periode === 'harian')
                                      <td class="border border-slate-300 px-2 py-1">
                                        <x-dashboard.form.radio id="normal-d-{{ $detail->id }}" name="kondisi_detail[{{ $detail->id }}]" value="normal">
                                          Normal
                                        </x-dashboard.form.radio>
                                      </td>
                                      <td class="border border-slate-300 px-2 py-1">
                                        <x-dashboard.form.radio id="tidak-normal-d-{{ $detail->id }}" name="kondisi_detail[{{ $detail->id }}]" value="tidak normal">
                                         Ada Gangguan
                                        </x-dashboard.form.radio>
                                      </td>
                                      <td class="hidden">
                                        <input type="hidden" name="id_detail[{{ $detail->id }}]" value="{{ $detail->id }}">
                                      </td>
                              
                                  @elseif ($periode->jenis_periode === 'mingguan')
                                    @foreach ($jadwal_mingguan as $item => $value)
                                        @if ($value === $tanggal_int )
                                              <td class="border border-slate-300 px-2 py-1">
                                                <x-dashboard.form.radio id="normal-d-{{ $detail->id }}" name="kondisi_detail[{{ $detail->id }}]" value="normal">
                                                  Normal
                                                </x-dashboard.form.radio>
                                              </td>
                                              <td class="border border-slate-300 px-2 py-1">
                                                <x-dashboard.form.radio id="tidak-normal-d-{{ $detail->id }}" name="kondisi_detail[{{ $detail->id }}]" value="tidak normal">
                                                  Ada Gangguan
                                                </x-dashboard.form.radio>
                                              </td>
                                              <td class="hidden">
                                                <input type="hidden" name="id_detail[{{ $detail->id }}]" value="{{ $detail->id }}">
                                              </td>
                                        @endif
                                    @endforeach  
                                  
                                  @elseif ($periode->jenis_periode === 'bulanan' && $tanggal_int === 1)
                                      <td class="border border-slate-300 px-2 py-1">
                                        <x-dashboard.form.radio id="normal-d-{{ $detail->id }}" name="kondisi_detail[{{ $detail->id }}]" value="normal">
                                          Normal
                                        </x-dashboard.form.radio>
                                      </td>
                                      <td class="border border-slate-300 px-2 py-1">
                                        <x-dashboard.form.radio id="tidak-normal-d-{{ $detail->id }}" name="kondisi_detail[{{ $detail->id }}]" value="tidak normal">
                                          Ada Gangguan
                                        </x-dashboard.form.radio>
                                      </td>
                                      <td class="hidden">
                                        <input type="hidden" name="id_detail[{{ $detail->id }}]" value="{{ $detail->id }}">
                                      </td>
                                  @endif
                                @endif

                              </tr>
                          @endforeach

                        @endforeach

                      </table>
                    @endforeach

                    <x-dashboard.button.submit>
                      Tambah
                    </x-dashboard.button.submit>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection
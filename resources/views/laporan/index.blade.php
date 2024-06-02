@extends('layouts.app')

@section('title')
    Laporan 
@endsection

@section('content')

  <x-header/>

  <section class="py-32 md:py-44 bg-indigo-50">
    <div class="container">
      <div class="w-full px-0 md:px-4">
          <div class="bg-white shadow-lg rounded-lg" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
            <div class="py-10 px-4">
              <div class="font-montserrat p-2 md:p-12 mb-8">
                <h1 class="text-gray-900 uppercase text-base md:text-lg lg:text-2xl font-bold mb-2 text-start md:text-center">Laporan Pengecekan Peralatan</h1>
                <p class="text-sm md:text-base font-normal text-gray-700 mt-5 mb-6 text-start">
                  Laporan pengecekan dibuat berdasarkan <strong>Peralatan</strong> yang ada. Untuk melihat dan mengunduh Laporan, anda harus memilih <strong>Peralatan</strong> yang akan menghantarkan pada pemilihan bulan dan tahun Laporan itu ditulis.
                </p>

                <div class="pb-4 mt-2.5 lg:mt-0">
                  <h3 class="page-sub-header uppercase font-semibold">list Peralatan</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">
                    @foreach ($peralatans as $data)
                   
                    <a href="{{ route('laporan.bulan', $data->id) }}" class="flex justify-between items-center bg-primary-light border-2 border-base-light shadow-md rounded-lg py-1.5 px-2.5 hover:bg-secondary-light hover:border-secondary-light hover:text-base-light" title="{{ $data->nama_peralatan }} - {{ $data->keterangan }}">
                      <div class="flex space-x-4 items-center">
                        <p class="text-xs sm:text-sm capitalize">
                          {{ $data->nama_peralatan }}
                        </p>
                      </div>

                  </a>
                  @endforeach
                </div>

              </div>
            </div>
          </div>
      </div>
    </div>
  </section>

  <x-footer/>

@endsection
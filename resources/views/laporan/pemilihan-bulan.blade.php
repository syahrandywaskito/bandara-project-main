@extends('layouts.app')

@section('title')
    Laporan | {{ $peralatan->nama_peralatan }}
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
                <p class="text-sm md:text-base font-normal text-primary-dark mt-5 mb-6 text-start">
                  Laporan pengecekan <span class="font-semibold text-secondary-light underline capitalize">{{ $peralatan->nama_peralatan }} - {{ $peralatan->keterangan }}</span>. Silahkan pilih bulan dan tahun laporan dibuat. Isikan tahun pada form input dibawah ini.
                </p>

                <form method="GET" action="{{ route('laporan.download', $peralatan->id) }}" target="_blank">

                    <x-dashboard.form.label>Pilih Bulan & Tahun</x-dashboard.form.label>

                    <div class="flex">
                        <div class="relative w-full flex">
                            <input
                            type="month"
                            name="bulan"
                            id="search-dropdown"
                            class="block p-2.5 w-full lg:w-[45%] text-xs md:text-sm text-primary-dark bg-base-light rounded-l-lg focus:ring-secondary-light focus:ring-4 outline-none focus:border-none"
                            required
                            />
                            <button
                            type="submit"
                            class=" p-2.5 text-sm font-medium h-full text-primary-light bg-secondary-light rounded-r-lg border border-secondary-light hover:bg-indigo-500 focus:ring-4 focus:outline-none focus:ring-secondary-light"
                            >
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

              </div>
            </div>
          </div>
      </div>
    </div>
  </section>

  <x-footer/>

@endsection

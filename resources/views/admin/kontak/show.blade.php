@extends('layouts.admin')

@section('title')
    Saran | {{$saran->nama}}
@endsection

@section('content')

  <x-dashboard.navbar>
    Saran - Lihat
  </x-dashboard.navbar>

  <x-dashboard.sidebar/>

  <div class="py-7 md:px-5 lg:ml-64">
        <div class="pt-16 px-4 mx-auto max-w-screen-xl text-start">
          <div class="bg-primary-light rounded-lg shadow-md px-5 py-8 sm:px-8 md:p-12 md:mb-8">

            <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('contact.index') }}">
                Kontak & Saran
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                Saran dari {{ $saran->nama }}
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>

            <div class="text-start mt-8 font-montserrat">
              <h1 class="text-gray-900 text-base md:text-lg xl:text-xl uppercase font-bold">
                Lihat Saran
              </h1>
              <p class="text-xs md:text-sm capitalize pt-3">
                Dari : <br>
                {{$saran->nama}}
              </p>
              <p class="text-xs md:text-sm pt-3">
                Alamat Email : <br>
                <a href="mailto:{{$saran->email}}" class="text-secondary-light hover:border-b border-secondary-light">
                  {{$saran->email}}
                </a>
              </p>
            </div>

            <hr class="h-px my-7 bg-gray-400 border-0" />

            <div class="font-montserrat">

              <div>
                <h2 class="uppercase font-semibold text-sm md:text-base">Subjek</h2>
                <p class="pt-3 text-xs sm:text-sm md:text-base">
                  {{$saran->subjek}}
                </p>
              </div>

              <div class="mt-8">
                <h2 class="uppercase font-semibold">Pesan</h2>
                <p class="pt-3 text-xs sm:text-sm md:text-base">
                  {{$saran->pesan}}
                </p>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection
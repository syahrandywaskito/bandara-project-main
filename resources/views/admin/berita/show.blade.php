@extends('layouts.admin')

@section('title')
    Berita | {{$berita->judul}}
@endsection

@section('content')
    
  <x-dashboard.navbar>
    Berita - {{$berita->judul}}
  </x-dashboard.navbar>

  <x-dashboard.sidebar/>

  <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

          <x-dashboard.breadcrumb.main>

            <x-dashboard.breadcrumb.active href="{{ route('berita.index') }}">
              Berita
            </x-dashboard.breadcrumb.active>

            <x-dashboard.breadcrumb.nonactive>
              {{ $berita->judul }}
            </x-dashboard.breadcrumb.nonactive>

          </x-dashboard.breadcrumb.main>
          
          <div class="flex items-center justify-between mt-8 mb-4">
            <h1 class="page-header">
              <x-icon.news class="mr-3" />
              {{$berita->judul}}
            </h1>
            
            <x-dashboard.link.add href="{{route('berita.edit', $berita->id)}}">
              Edit Berita
            </x-dashboard.link.add>
          </div>
        
          <div class="flex justify-center">
            <img src="{{asset('/storage/berita/'.$berita->image)}}" alt="{{$berita->judul}}" class="w-[45%] rounded-lg">
          </div>

          <hr class="w-80 h-1 mx-auto my-4 bg-slate-300 border-0 rounded md:mt-9 md:mb-6">
          
          <div class="text-xs sm:text-sm md:text-base">
              {!! $berita->isi !!}
          </div>

        </div>
      </div>
    </div>

    @endsection
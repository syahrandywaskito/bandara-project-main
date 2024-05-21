@extends('layouts.admin')

@section('title')
    Berita
@endsection

@section('content')
    
    <x-dashboard.navbar>
      Berita
    </x-dashboard.navbar>

    <x-dashboard.sidebar/>

    <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

          <x-dashboard.breadcrumb.main>
            <x-dashboard.breadcrumb.nonactive>
              Berita
            </x-dashboard.breadcrumb.nonactive>
          </x-dashboard.breadcrumb.main>

          <h1 class="page-header mt-8 mb-4">
            <x-icon.news class="mr-3" />
            Halaman Berita
          </h1>

          <p class="page-sub-header mb-3">
            Manage berita terbaru dan ter-aktual seputar Bandara Abdulrachman Saleh
          </p>
          
          <div class="grid grid-cols-3 gap-4 lg:flex lg:items-center lg:space-x-3 lg:py-3.5">

            <x-dashboard.link.add href="{{route('berita.create')}}" class="col-span-3">
              Tambah Berita
            </x-dashboard.link.add>

            <x-dashboard.search.main action="{{route('berita.search')}}">
              <option selected>Pilih Kolom</option>
              <option value="judul">Judul</option>
              <option value="isi">Isi</option>
            </x-dashboard.search.main>

            <x-dashboard.form.show-all action="{{route('berita.index')}}" />
          </div>

          <div class="py-4 mt-4 lg:mt-0">
            <p class="page-sub-header uppercase font-semibold">Berita</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach ($berita as $data)
            <div class="flex justify-between items-center bg-primary-light border-2 border-base-light shadow-md rounded-lg py-1.5 px-2.5">
              <a href="{{route('berita.show', $data->id)}}" class="flex space-x-4 items-center group">
                <img src="{{asset('/storage/berita/'.$data->image)}}" class="w-24 rounded-lg group-hover:grayscale" alt="{{ $data->judul }}" />
                <div class="text-sm group-hover:underline">
                  <p class="font-semibold text-sm">
                    {{$data->judul}}
                  </p>
                  <p class="text-xs sm:text-sm">
                    {!! Str::limit(strip_tags($data->isi), $limit = 20, $end = '...') !!}
                  </p>
                </div>
              </a>
              <form action="{{route('berita.destroy', $data->id)}}" method="POST" onclick="return confirm('Hapus berita berjudul {{$data->judul}}?')" class="bg-secondary-light p-1.5 hover:opacity-75 rounded-lg text-primary-light shadow-md" title="hapus berita">

                @csrf 
                @method('DELETE')

                <button type="submit" class="block cursor-default" title="hapus item">
                  <x-icon.cross/>
                </button>
              </form>
            </div>
            @endforeach
          </div>

        </div>
      </div>
    </div>
    
    @endsection
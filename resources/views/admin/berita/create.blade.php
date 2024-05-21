@extends('layouts.admin')

@section('title')
    Berita | Tambah
@endsection

@section('content')
    
    <x-dashboard.navbar>
      Berita - Tambah
    </x-dashboard.navbar>

    <x-dashboard.sidebar/>

    <div class="py-7 md:px-5 lg:ml-64">
      <div>
        <div class="pt-16 px-4 mx-auto max-w-screen-xl text-start">
          <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">

            <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('berita.index') }}">
                Berita
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                Tambah Berita
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>

            <h1 class="page-header mt-8">
              <x-icon.plus class="mr-2" />              
              Halaman Tambah Berita
            </h1>

            <div class="flex-row items-center">
              <div class="mt-4">
                <form action="{{route('berita.store')}}" method="POST" enctype="multipart/form-data" class="">
                  @csrf
                  <div class="grid grid-cols-1 grid-flow-row-dense gap-5">

                    <div>
                      <x-dashboard.form.label for="image-input">
                        Input Gambar
                      </x-dashboard.form.label>
                      
                      <x-dashboard.form.input name="image" type="file" id="image-input" multiple class="image-field @error('image') is-invalid @enderror"/>

                      <div class="mt-2">
                        <p class="flex space-x-4 text-xs md:text-sm text-base-dark">
                          <span id="original-size"></span>
                          <span id="compressed-size"></span>
                        </p>
                      </div>

                      @error('image')
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror
                    </div>

                    <div>
                      <x-dashboard.form.label for="judul">
                        Judul Berita
                      </x-dashboard.form.label>
    
                       <x-dashboard.form.input name="judul" type="text" id="judul" value="{{ old('judul') }}" class="@error('judul') is-invalid @enderror"/>

                      @error('judul')
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror
                    </div>
  
                    <div>
                      <x-dashboard.form.label for="isi">
                        Isi Berita
                      </x-dashboard.form.label>

                      <textarea name="isi" id="isi" cols="30" rows="10" class="text-xs md:text-sm text-base-dark bg-primary-light shadow-md rounded-lg outline-none focus:border-secondary-light block w-full p-3
                      @error('isi') is-invalid @enderror"> </textarea>

                      @error('isi')
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror
                    </div>
                    
                    <x-dashboard.button.submit>
                      Tambah
                    </x-dashboard.button.submit>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <script src="{{asset('js/dashboard/compress-image.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace("isi");
    </script>

@endsection
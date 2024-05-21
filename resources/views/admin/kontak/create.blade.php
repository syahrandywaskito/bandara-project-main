@extends('layouts.admin')

@section('title')
    Kontak | {{$title}}
@endsection

@section('content')
    
  <x-dashboard.navbar>
    Kontak - {{$title}}
  </x-dashboard.navbar>

  <x-dashboard.sidebar/>

  <div class="py-7 md:px-5 lg:ml-64">
      <div>
        <div class="py-16 px-4 mx-auto max-w-screen-xl text-start">
          <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">

            <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('contact.index') }}">
                Kontak & Saran
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                {{ $title }} Data
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>
            
              <h1 class="page-header mt-8">

                  @if ($title == 'ubah')
                     <x-icon.update class="mr-3" />
                  @else
                     <x-icon.plus class="mr-2"/>
                  @endif
                  Halaman {{$title}} Kontak
              </h1>

              <div class="flex-row items-center">
                <div class="mt-4">
                  <form 
                  
                    @if ($title == "ubah")  
                      action="{{route('contact.'. $route_name, $kontak->id)}}"
                    @else
                      action="{{route('contact.'. $route_name)}}"
                    @endif

                    method="POST" 
                    enctype="multipart/form-data"
                  >

                    @csrf 

                    @if($title == 'ubah')
                      @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 grid-flow-row-dense gap-4">
 
                      <div class="col-span-1">
                        <x-dashboard.form.label for="no_telepon">
                          No telepon
                        </x-dashboard.form.label>

                        <div class="flex items-center pt-1 shadow-md">
                          <span class="text-xs md:text-sm text-base-light bg-secondary-light rounded-l-lg outline-none block w-fit p-3"> +62 </span>
                          <input
                            type="tel"
                            id="no_telepon"
                            class="text-xs md:text-sm text-primary-dark bg-primary-light rounded-r-lg outline-none block w-full p-3"
                            required
                            name="no_telepon"
                            title="Masukan no telpon tanpa 0 diawal"
                            @if ($title === 'ubah')
                              value="{{$kontak->no_telepon}}" 
                            @else
                              value="{{ old('no_telepon') }}" 
                            @endif
                          />
                          @error('no_telepon')
                              <x-error-alert>{{ $message }}</x-error-alert>
                          @enderror
                        </div>
                      </div>

                      <div class="col-span-1">
                        <x-dashboard.form.label for="email">
                          Email
                        </x-dashboard.form.label>

                        <input
                          type="email"
                          id="email"
                          class="text-xs md:text-sm text-primary-dark bg-primary-light rounded-lg outline-none block w-full p-3 shadow-md"
                          required
                          name="admin_email"
                          @if ($title === "ubah")
                            value="{{$kontak->admin_email}}"  
                          @else
                            value="{{ old('admin_email') }}"
                          @endif
                        />
                        @error('admin_email')
                            <x-error-alert>{{ $message }}</x-error-alert>
                        @enderror
                      </div>

                      <x-dashboard.button.submit>
                        @if ($title === "ubah")
                            Ubah
                        @else
                            Tambah
                        @endif
                      </x-dashboard.button.submit>
                    </div>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

@endsection
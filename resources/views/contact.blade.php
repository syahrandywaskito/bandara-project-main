@extends('layouts.app')

@section('title')
    Hubungi Kami
@endsection

@section('content')
    
    <x-header/>

    <section class="py-32 md:py-44 bg-indigo-50">
      <div class="container">
        <div class="w-full px-0 md:px-4">

          <div class="bg-white shadow-lg rounded-lg" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
            <div class="py-10 px-4 mx-auto">
              <div class="p-2 md:p-12 mb-4">
                <h1 class=" uppercase text-base md:text-lg lg:text-2xl font-bold mb-2 text-start md:text-center">
                  Hubungi Kami
                </h1>
                <p class="text-sm md:text-base font-normal text-gray-700 mt-5 mb-6 text-start">
                  Anda dapat menghubungi kami dengan membuka No Telepon atau Alamat Email yang sudah tersedia. Anda juga dapat memberikan saran dan masukan terhadap web ini ataupu saran dan masukan untuk kami. Diharapkan saran dan masukan dapat menjadi perbaikan untuk kami kedepannya.
                </p>

                  <div class="text-start font-semibold mt-10 mb-4 uppercase">
                    <h4 class="text-base">Kontak</h4>
                  </div>
      
                    <div class="md:flex flex-row justify-between items-center">
                      <div class="text-start text-sm md:tex-base">
                        <p>Alamat Email</p>
                        @if(isset($kontak))
                          <a href="mailto:{{$kontak->admin_email}}" target="_blank" class="inline-flex items-center pt-2">
                            <x-icon.email class="mr-3"/>
                            <span class="text-secondary-light hover:underline py-1">
                              {{$kontak->admin_email}}
                            </span>
                          </a>
                        @else
                          <p class="inline-flex items-center pt-2">
                            <x-icon.email class="mr-3"/>
                            <span>
                              Email tidak tersedia
                            </span>
                          </p>
                        @endif
                      </div>

                      <div class="text-start md:text-end pt-3 md:pt-0 text-sm md:tex-base">
                        <p>No Telepon</p>
                          @if (isset($kontak))
                            <a href="https://wa.me/62{{$kontak->no_telepon}}" class=" inline-flex items-center pt-2" target="_blank">
                              <x-icon.wa class="mr-3"/>
                              <span class="text-secondary-light hover:underline py-1">
                                +62 {{$kontak->no_telepon}}
                              </span>
                            </a> 
                          @else
                              <p class=" inline-flex items-center pt-2">
                                <x-icon.wa class="mr-3"/>
                                <span>
                                  No Telepon tidak tersedia
                                </span>
                            </p>
                          @endif    
                      </div>
                    </div>
                
                  @if ($message = Session::get('success'))
                    <div class="p-4 mt-4 text-sm text-green-900 rounded-lg bg-green-100" role="alert">
                      {{ $message }}
                    </div>
                  @endif

                  <div class="text-start font-semibold mt-7 mb-4 uppercase">
                    <p class="text-base">Saran & Masukan</p>
                  </div>

                  <form action="{{route('saran.send')}}" method="POST" enctype="multipart/form-data" class="text-start">
                    @csrf

                    <div class="grid grid-cols-1 grid-flow-row-dense md:grid-cols-2 gap-7">
                      
                      <div class="col-span-2 md:col-span-1">
                        <label for="nama" class="block mb-2 text-sm font-medium ">Nama</label>
                        <input type="text" id="nama" class="bg-gray-50 border border-gray-300  text-xs md:text-sm rounded-lg block w-full p-2.5 @error('nama') is-invalid @enderror" required name="nama" />

                        
                        @error('nama')
                        <div class="mt-3">
                          @include('components.dashboard._input-error-notif')
                        </div>
                        @enderror
                      </div>

                      
                      <div class="col-span-2 md:col-span-1">
                        <label for="email" class="block mb-2 text-sm font-medium ">Email</label>
                        <input type="email" id="email" class="bg-gray-50 border border-gray-300  text-xs md:text-sm rounded-lg block w-full p-2.5 @error('email') is-invalid @enderror" required name="email" />

                        
                        @error('email')
                        <div class="mt-3">
                          @include('components.dashboard._input-error-notif')
                        </div>
                        @enderror
                      </div>

                      
                      <div class="col-span-2">
                        <label for="subjek" class="block mb-2 text-sm font-medium ">Subjek</label>
                        <input type="text" id="subjek" class="bg-gray-50 border border-gray-300  text-xs md:text-sm rounded-lg block w-full p-2.5 @error('subjek') is-invalid @enderror" required name="subjek" />

                        
                        @error('subjek')
                        <div class="mt-3">
                          @include('components.dashboard._input-error-notif')
                        </div>
                        @enderror
                      </div>

                      
                      <div class="col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium ">
                          Pesan
                        </label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-xs md:text-sm  bg-gray-50 rounded-lg border border-gray-300 @error('pesan') is-invalid @enderror" name="pesan"></textarea>

                        @error('pesan')
                        <div class="mt-3">
                          @include('components.dashboard._input-error-notif')
                        </div>
                        @enderror
                      </div>
                    </div>
                    <button type="submit" class="mt-5 text-white bg-secondary-light hover:bg-indigo-500 transition duration-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                      Kirim
                    </button>
                  </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <x-footer/>

@endsection
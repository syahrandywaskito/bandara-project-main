@extends('layouts.app')

@section('title')
    Homepage
@endsection

@section('content')

  <x-header/>
    
    <section id="home" class="pt-36 pb-32">
      <div class="container">
        <div class="flex flex-wrap">

          <div class="w-full px-4 self-center lg:w-1/2" data-aos="fade-right" data-aos-duration="500">
            <h1 class="text-base font-semibold text-primary md:text-xl mb-5 tracking-wider">Bandara Abdulrachman Saleh
              <span class="block font-bold text-dark text-3xl mt-2 lg:text-5xl">Teknik dan Pelayanan Jasa</span>
            </h1>
            <p class="font-medium text-sm md:text-base text-secondary mb-10 leading-relaxed">
              Didukung oleh tim profesional berpengalaman dan infrastruktur modern, kami berkomitmen untuk menghadirkan pengalaman penerbangan yang aman, nyaman, dan tepat waktu.
            </p>
          </div>

          <div class="w-full self-end px-4 lg:w-1/2" data-aos="fade-left" data-aos-duration="500"> 
            <div class="mt-10 relative lg:mt-9 lg:right-0">
              <img src="{{asset('img/dishub.png')}}" alt="dishub" class="max-w-full lg:max-w-[75%] mx-auto">
            </div>  
          </div>

        </div>
      </div>
    </section>

    <section id="berita" class="pt-36 pb-32 bg-indigo-50">
      <div class="container">

        <div class="max-w-xl mx-auto text-center mb-20">
            <h4 class="font-semibold text-base  md:text-lg text-primary mb-2 font-monobuntu tracking-widest uppercase">Berita</h4>
            <h2 class="font-bold text-dark text-2xl md:text-3xl mb-4">Terbaru & Terkini</h2>
            <p class="font-medium text-sm md:text-base text-secondary">Berita terbaru dan terkini seputar Bandara Abdulrachman Saleh</p>
        </div>

        <div class="flex flex-wrap">
          @if ($berita_main)
          <div class="w-full px-0 md:px-4 self-center lg:w-1/2" data-aos="fade-right" data-aos-delay="500" data-aos-duration="500">
            @foreach ($berita_main as $list)
              <div class="bg-primary-light border border-gray-200 rounded-lg shadow">
                  <a href="{{ route('lihat-berita', $list->id) }}">
                    <div class="flex justify-center p-5">
                      <img class="rounded-lg hover:grayscale transition duration-200 w-[55%] text-center" src="{{asset('storage/berita/'.$list->image)}}" alt="" />
                    </div>

                    <div class="p-5 font-montserrat">
                      <div>
                        <h5 class="mb-1 text-sm sm:text-base md:text-lg font-bold tracking-tight text-gray-900">
                          {{ $list->judul }}
                        </h5>
                      </div>
                      <div class="truncate text-xs sm:text-sm md:text-base">
                        {!! Str::limit(strip_tags($list->isi), $limit = 100, $end = '...') !!}
                      </div>
                    </div>
                  </a>
              </div>
            @endforeach
          </div>
                
          
          <div class="w-full px-0 md:px-4 self-center lg:w-1/2">
              <div class="flex-row space-y-5 mt-5 xl:mt-0" data-aos="fade-left" data-aos-delay="500" data-aos-duration="500">
                @foreach ($berita_side as $list)
                  <a href="{{ route('lihat-berita', $list->id) }}" class="flex space-x-5 items-center bg-primary-light rounded-lg shadow-md hover:translate-x-1 transition duration-200 pr-5 hover:grayscale">
                    <div>
                      <img src="{{asset('storage/berita/'.$list->image)}}" class=" w-28 xl:w-32 rounded-l-lg" alt="">
                    </div>
                    <div>
                      <h3 class="text-sm font-bold">{{ $list->judul }}</h3>
                      <p class="truncate text-xs sm:text-sm md:text-base mt-1">
                        
                        {!! Str::limit(strip_tags($list->isi), $limit = 35, $end = '...') !!}
                      </p>
                    </div>
                  </a>
                @endforeach
              </div>
          </div>

          @elseif(!$berita_main)
            <div class="w-full px-0 md:px-4 self-center lg:w-1/2">
              <div class="bg-white border border-gray-200 rounded-lg shadow">
                  <a href="">

                    <img class="rounded-t-lg hover:grayscale transition duration-200" src="{{asset('img/forest.jpg')}}" alt="" />

                    <div class="p-5 font-montserrat">
                      <div>
                        <h5 class="mb-1 text-sm sm:text-base md:text-lg font-bold tracking-tight text-gray-900">
                          Judul Berita
                        </h5>
                      </div>
                      <div class="truncate text-xs sm:text-sm md:text-base">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam quos necessitatibus eos ex aut sunt itaque pariatur maiores in cumque consequatur, ad voluptas cum, sapiente ipsam nulla facere accusantium minus!
                      </div>
                    </div>
                  </a>
              </div>
            </div>
          @endif
        </div>

      </div>
    </section>

    <section id="jadwal" class="pt-36 pb-32">
      <div class="container">
        <div class="w-full px-0 md:px-4">
          
          <div class="max-w-xl mx-auto text-center mb-20">
            <h4 class="font-semibold text-base md:text-lg text-primary mb-2 font-monobuntu tracking-widest uppercase">Jadwal</h4>
            <h2 class="font-bold text-dark text-2xl md:text-3xl mb-4">Penerbangan Komersial</h2>
            <p class="font-medium text-sm md:text-base text-secondary">Jadwal penerbangan <strong>Departrue</strong> dan <strong>Arrival</strong></p>
            <div class="pt-7 space-x-4 text-sm md:text-base">
              <button type="button" id="btn-departure" class="py-2.5 px-3 bg-indigo-900 text-white rounded-lg hover:bg-indigo-400 shadow-md">Departure</button>
              <button type="button" id="btn-arrival" class="py-2.5 px-3 bg-indigo-900 text-white rounded-lg hover:bg-indigo-400 shadow-md">Arrival</button>
            </div>
          </div>

          <div class="pt-2 text-right" data-aos="fade-up" data-aos-delay="500" data-aos-duration="500">
              <div class="pb-6 flex justify-between items-center">
                <div class="text-sm md:text-base">
                  <h2 id="header-jadwal" class="font-montserrat font-semibold uppercase inline-flex items-center cursor-default">
                    Departure
                  </h2>
                </div>
                <div class="text-sm md:text-base">
                  <p class="font-montserrat hidden sm:block">
                    {{now()->isoFormat('dddd, D MMMM Y')}}
                  </p>
                  <p class="font-montserrat clock hidden sm:block"></p>
                </div>
              </div>
          </div>

          <div class="relative overflow-x-auto overflow-y-hidden rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="700" data-aos-duration="500">
            <table id="jadwal-departure" class="w-full text-sm text-left bg-gray-50" >
              <thead class="text-xs font-montserrat sm:text-sm text-center text-gray-50 uppercase bg-indigo-900">
                <tr>
                  <th scope="col" class="px-6 py-3">
                    maskapai
                  </th>
                  <th scope="col" class="px-6 py-3">
                    id Penerbangan
                  </th>
                  <th scope="col" class="px-6 py-3">
                    tujuan
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Jam Keberangkatan
                  </th>
                </tr>
              </thead>

              <tbody id="scheduleData" class="text-center text-xs md:text-sm lg:text-base">
                @foreach ($jadwal_departure as $data) 
                    <tr class="border-b border-slate-300">
                      <td class="py-6 px-3">
                        <div class="flex justify-center items-center">
                          <img src="
                              @if ($data->nama_maskapai == 'Citilink') 
                                  {{asset('img/QG.png')}}
                              @elseif ($data->nama_maskapai == 'Garuda Indonesia')
                                  {{asset('img/GA.png')}}
                              @else 
                                  {{asset('img/ID.png')}}
                              @endif
                              " class="w-[10rem]">
                        </div>
                      </td>

                      <td class="px-6 py-4">
                        {{ $data->id_penerbangan }}
                      </td>

                      <td class="px-6 py-4">
                        {{ $data->tujuan }}
                      </td>

                      <td class="px-6 py-4">
                        @php 
                          $jam = $data->waktu_berangkat; 
                          $carbon = \Carbon\Carbon::parse($jam); 
                          $formatted = $carbon->isoFormat('HH:m')
                        @endphp 
                        {{$formatted }}
                      </td>

                    </tr> 
                @endforeach
              </tbody>
            </table>

            <table id="jadwal-arrival" class=" w-full text-sm text-left bg-slate-50 hidden">
              
              <thead class="text-xs font-montserrat sm:text-sm text-center text-gray-50 uppercase bg-indigo-900">
                <tr>
                  <th scope="col" class="px-6 py-3">
                    maskapai
                  </th>
                  <th scope="col" class="px-6 py-3">
                    id Penerbangan
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Dari
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Jam Kedatangan
                  </th>
                </tr>
              </thead>

              <tbody id="scheduleData" class="text-center text-xs md:text-sm lg:text-base">
                @foreach ($jadwal_arrival as $data)  
                    <tr class="border-b border-slate-300">
                      <td class="py-6 px-3">
                        <div class="flex justify-center items-center">
                          <img src="
                              @if ($data->nama_maskapai == 'Citilink') 
                                  {{asset('img/QG.png')}}
                              @elseif ($data->nama_maskapai == 'Garuda Indonesia')
                                  {{asset('img/GA.png')}}
                              @else 
                                  {{asset('img/ID.png')}}
                              @endif
                              " class="w-[10rem]">
                        </div>
                      </td>

                      <td class="px-6 py-4">
                        {{ $data->id_penerbangan }}
                      </td>

                      <td class="px-6 py-4">
                        {{ $data->tujuan }}
                      </td>

                      <td class="px-6 py-4">
                        @php 
                          $jam = $data->waktu_berangkat; 
                          $carbon = \Carbon\Carbon::parse($jam); 
                          $formatted = $carbon->isoFormat('HH:m')
                        @endphp 
                        {{$formatted }}
                      </td>

                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </section>

  <x-footer />
@endsection
@extends('layouts.admin')

@section('title')
    Jadwal
@endsection

@section('content')
  
  <x-dashboard.navbar>
    Jadwal
  </x-dashboard.navbar>

  <x-dashboard.sidebar/>

  <div class="py-7 md:px-5 lg:ml-64">
      <div class="pt-16 px-4 mx-auto max-w-screen-xl">
        <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">

          <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.nonactive>
                Jadwal
              </x-dashboard.breadcrumb.nonactive>

          </x-dashboard.breadcrumb.main>

          <h1 class="page-header mt-8 mb-4">
            <x-icon.calendar class="mr-3" />
            Halaman Jadwal
          </h1>
          <p class="page-sub-header mb-3">
            Manage jadwal penerbangan di Bandara Abdulrachman Saleh
          </p>
          <div class="flex items-center space-x-3 py-2">

            <button type="button" id="btn-departure" class="py-2 px-3 text-sm bg-secondary-light text-white rounded-lg hover:bg-indigo-400 shadow-md">Departure</button>

            <button type="button" id="btn-arrival" class="py-2 px-3 text-sm bg-secondary-light text-white rounded-lg hover:bg-indigo-400 shadow-md">Arrival</button>
          
          </div>

          <div id="jadwal-departure" class="hidden">
            <div class="py-4 mt-3 md:flex md:justify-between md:items-center">
              <h3 class="page-sub-header uppercase font-semibold mb-2 md:mb-0">Jadwal Departure</h3>
  
              <x-dashboard.link.add href="{{route('jadwal.create.departure')}}">
                Tambah Jadwal Departure
              </x-dashboard.link.add>
            </div>
  
            <div class="mx-auto max-w-screen-xl">
              <div class="relative overflow-x-auto rounded-lg">
                <table class="w-full text-sm text-left">
                  <thead class="text-xs text-base-light uppercase bg-secondary-light text-center">
                    <tr>
                      <th scope="col" class="px-6 py-3">
                        Maskapai
                      </th>
                      <th scope="col" class="px-6 py-3">
                        ID Penerbangan
                      </th>
                      <th scope="col" class="px-6 py-3">
                        Tujuan
                      </th>
                      <th scope="col" class="px-6 py-3">
                        Waktu Keberangkatan
                      </th>
                      <th scope="col" class="px-6 py-3">
                        Aksi
                      </th>
                    </tr>
                  </thead>
                  <tbody class="text-center text-xs sm:text-sm">
                    @foreach ($departure as $data)
                    <tr>
                      <td class="px-6 py-4">
                        <img src="
                                  @if($data->nama_maskapai == 'Citilink')
                                      {{asset('img/QG.png')}}
                                  @elseif($data->nama_maskapai == 'Batik Air')
                                      {{asset('img/ID.png')}}
                                  @else
                                      {{asset('img/GA.png')}}
                                  @endif
                                 " 
                             style="width: 130px;" 
                             class="rounded-lg" />
                      </td>
                      <td class="px-6 py-4">
                        {{$data->id_penerbangan}}
                      </td>
                      <td class="px-6 py-4">
                        {{ $data->tujuan }}
                      </td>
                      <td class="px-6 py-4">
                        @php 
                          $waktu = $data->waktu_berangkat; 
                          $carbon = \Carbon\Carbon::parse($waktu); 
                          $formatted = $carbon->isoFormat('HH : m');
                        @endphp
                        {{$formatted }}
                      </td>
                      <td class="px-6 py-4">
                        <form onsubmit="return confirm('Anda yakin ingin menghapus data ini ?')" action="{{route('jadwal.destroy.departure', $data->id)}}" method="POST">
                          @csrf 
                          @method('DELETE')
                          <div class="inline-flex rounded-md shadow-md" role="group">
  
                            <x-dashboard.link.edit href="{{route('jadwal.edit.departure', $data->id)}}" class="rounded-l-lg">
                              Edit
                            </x-dashboard.link.edit>
  
                            <x-dashboard.button.delete class="rounded-r-lg">
                              Hapus
                            </x-dashboard.button.delete>
  
                          </div>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div id="jadwal-arrival" class="hidden">
            <div class="py-4 mt-3 md:flex md:justify-between md:items-center">
              <h3 class="uppercase text-sm lg:text-base font-semibold text-base-dark mb-2 md:mb-0">Jadwal Arrival</h3>
  
              <x-dashboard.link.add href="{{route('jadwal.create.arrival')}}">
                Tambah Jadwal Arrival
              </x-dashboard.link.add>
            </div>
  
            <div class="mx-auto max-w-screen-xl">
              <div class="relative overflow-x-auto rounded-lg">
                <table class="w-full text-sm text-left">
                  <thead class="text-xs text-base-light uppercase bg-secondary-light text-center">
                    <tr>
                      <th scope="col" class="px-6 py-3">
                        Maskapai
                      </th>
                      <th scope="col" class="px-6 py-3">
                        ID Penerbangan
                      </th>
                      <th scope="col" class="px-6 py-3">
                        Dari
                      </th>
                      <th scope="col" class="px-6 py-3">
                        Waktu Kedatangan
                      </th>
                      <th scope="col" class="px-6 py-3">
                        Aksi
                      </th>
                    </tr>
                  </thead>
                  <tbody class="text-center text-xs sm:text-sm">
                    @foreach ($arrival as $data)
                    <tr>
                      <td class="px-6 py-4">
                        <img src="
                                  @if($data->nama_maskapai == 'Citilink')
                                      {{asset('img/QG.png')}}
                                  @elseif($data->nama_maskapai == 'Batik Air')
                                      {{asset('img/ID.png')}}
                                  @else
                                      {{asset('img/GA.png')}}
                                  @endif
                                 " 
                             style="width: 130px;" 
                             class="rounded-lg" />
                      </td>
                      <td class="px-6 py-4">
                        {{$data->id_penerbangan}}
                      </td>
                      <td class="px-6 py-4">
                        {{ $data->dari }}
                      </td>
                      <td class="px-6 py-4">
                        @php 
                          $waktu = $data->waktu_datang; 
                          $carbon = \Carbon\Carbon::parse($waktu); 
                          $formatted = $carbon->isoFormat('HH : m');
                        @endphp
                        {{$formatted }}
                      </td>
                      <td class="px-6 py-4">
                        <form onsubmit="return confirm('Anda yakin ingin menghapus data ini ?')" action="{{route('jadwal.destroy.arrival', $data->id)}}" method="POST">
                          @csrf 
                          @method('DELETE')
                          <div class="inline-flex rounded-md shadow-md" role="group">
  
                            <x-dashboard.link.edit href="{{route('jadwal.edit.arrival', $data->id)}}" class="rounded-l-lg">
                              Edit
                            </x-dashboard.link.edit>
  
                            <x-dashboard.button.delete class="rounded-r-lg">
                              Hapus
                            </x-dashboard.button.delete>
  
                          </div>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

@endsection

@push('script')
    <script>
      const departure = document.querySelector("#jadwal-departure");
      const arrival = document.querySelector("#jadwal-arrival");
      const btnDeparture = document.querySelector("#btn-departure");
      const btnArrival = document.querySelector("#btn-arrival");

      btnDeparture.addEventListener("click", function () {
          if (departure.classList.contains("hidden")) {
              departure.classList.remove("hidden");
              arrival.classList.add("hidden");
          }
      });

      btnArrival.addEventListener("click", function () {
          if (arrival.classList.contains("hidden")) {
              arrival.classList.remove("hidden");
              departure.classList.add("hidden");
          }
      });
    </script>
@endpush
@extends('layouts.admin')

@section('title')
    Jadwal | {{$data->id_penerbangan}}
@endsection

@section('content')
    
  <x-dashboard.navbar>
    Jadwal - Edit
  </x-dashboard.navbar>

  <x-dashboard.sidebar/>

  <div class="py-7 md:px-5 lg:ml-64">
      <div>
        <div class="pt-16 px-4 mx-auto max-w-screen-xl text-start">
          <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">

            <x-dashboard.breadcrumb.main>

              <x-dashboard.breadcrumb.active href="{{ route('jadwal.index') }}">
                Jadwal
              </x-dashboard.breadcrumb.active>

              <x-dashboard.breadcrumb.nonactive>
                Edit Jadwal {{ $data->id_penerbangan }}
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>

            <h1 class="page-header mt-8">
              <x-icon.update class="mr-2" />             
              Halaman Edit Jadwal
            </h1>

            <div class="font-roboto flex-row items-center">
              <div class="mt-4">
                <form action="{{route('jadwal.update.'.$title, $data->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="grid grid-cols-1 grid-flow-row-dense md:grid-cols-2 gap-4">

                    <div class="col-span-1">

                      <x-dashboard.form.label for="nama_maskapai">
                        nama maskapai
                      </x-dashboard.form.label>

                      <x-dashboard.form.input value="{{$data->nama_maskapai}}" class="capitalize" id="nama_maskapai" name="nama_maskapai" />
                      @error('nama_maskapai')
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror
                    </div>
                    
                    <div class="col-span-1">

                      <x-dashboard.form.label for="id_penerbangan">
                        ID penerbangan
                      </x-dashboard.form.label>
                      
                      <x-dashboard.form.input value="{{$data->id_penerbangan}}" id="id_penerbangan" name="id_penerbangan" />
                      @error('id_penerbangan')
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror

                    </div>
                    <div class="col-span-1">
                      
                      <x-dashboard.form.label for="{{$context}}">
                        {{ $context }}
                      </x-dashboard.form.label>
                      
                      <x-dashboard.form.input value="{{$context_value}}" id="{{$context}}" name="{{$context}}" />
                      @error($context)
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror

                    </div>
                    <div class="col-span-1">
                      
                      <x-dashboard.form.label for="waktu">
                        Waktu {{$activity}}
                      </x-dashboard.form.label>
                      
                      <x-dashboard.form.input value="{{$time_value}}" id="waktu" name="waktu_{{$activity}}" type="time" />
                      @error('waktu_'.$activity)
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror
                      
                    </div>

                    <x-dashboard.button.submit>
                      Ubah
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
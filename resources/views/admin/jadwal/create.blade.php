@extends('layouts.admin')

@section('title')
    Jadwal | {{$title}}
@endsection

@section('content')
    
  <x-dashboard.navbar>
    Jadwal - Tambah
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
                Tambah Jadwal {{ $title }}
              </x-dashboard.breadcrumb.nonactive>

            </x-dashboard.breadcrumb.main>

            <h1 class="page-header mt-8">
              <x-icon.plus class="mr-2"/>
              Halaman Tambah Jadwal
            </h1>

            <div class="flex-row items-center">
              <div class="mt-4">
                <form action="{{route('jadwal.store.'.$title)}}" method="POST" enctype="multipart/form-data" class="">
                  @csrf
                  <div class="grid grid-cols-1 grid-flow-row-dense md:grid-cols-2 gap-4">

                    <div class="col-span-1">

                      <x-dashboard.form.label for="nama_maskapai">
                        nama maskapai
                      </x-dashboard.form.label>

                      <x-dashboard.form.input name="nama_maskapai" class="capitalize" type="text" id="nama_maskapai" value="{{ old('nama_maskapai') }}" />
                      @error('nama_maskapai')
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror
                    </div>
                    
                    <div class="col-span-1">
                      
                      <x-dashboard.form.label for="id_penerbangan">
                        ID Penerbangan
                      </x-dashboard.form.label>

                      <x-dashboard.form.input name="id_penerbangan" type="text" id="id_penerbangan" value="{{ old('id_penerbangan') }}"/>
                      @error('id_penerbangan')
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror
                    </div>

                    <div class="col-span-1">
                      
                      <x-dashboard.form.label for="{{$context}}">
                        {{ $context }}
                      </x-dashboard.form.label>

                      <x-dashboard.form.input name="{{$context}}" type="text" id="{{$context}}" value="{{ old($context) }}"/>
                      @error($context)
                          <x-error-alert>{{ $message }}</x-error-alert>
                      @enderror
                    </div>
                    <div class="col-span-1">
                      
                      <x-dashboard.form.label for="waktu">
                        waktu {{$activity}}
                      </x-dashboard.form.label>

                      <x-dashboard.form.input name="waktu_{{$activity}}" type="time" id="waktu" value="{{ old('waktu_'.$activity) }}" />
                      @error('waktu_'.$activity)
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

@endsection
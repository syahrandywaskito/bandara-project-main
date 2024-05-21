@extends('layouts.app')

@section('title')
    Berita
@endsection

@section('content')
    
    <x-header/>

    <section class="py-32 md:py-44 bg-indigo-50">
      <div class="container">
        <div class="w-full px-0 md:px-4">

            <div class="w-full p-4 text-center bg-primary-light rounded-lg shadow-lg sm:p-8">
                <h5 class="mb-2 md:mb-4 text-sm sm:text-base lg:text-xl uppercase font-bold font-montserrat text-primary-dark" data-aos="fade-up" data-aos-delay="100">
                    {{$berita->judul}}
                </h5>
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{asset('storage/berita/'.$berita->image)}}" alt="" class="rounded-lg my-2 w-[40%]" />
                </div>
                <div data-aos="fade-up" data-aos-delay="300" data-aos-ease="ease-in-out">
                    <p class="my-5 text-primary-dark">
                    {!!str_replace('<p>', '<p class="text-xs sm:text-sm md:text-base font-montserrat">', $berita->isi)!!}
                    </p>
                </div>
            </div>

        </div>
      </div>
    </section>
        

    

    <x-footer/>

@endsection

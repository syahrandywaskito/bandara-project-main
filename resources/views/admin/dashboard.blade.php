@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')

    <x-dashboard.navbar>
      Dashboard
    </x-dashboard.navbar>

    <x-dashboard.sidebar/>

    <div class="py-7 md:px-5 lg:ml-64">

        <div class="pt-16 pb-5 px-4 mx-auto max-w-screen-xl">
          <div class="bg-primary-light dark:bg-primary-dark rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12 lg:mb-8">
            <h1 class="text-base-dark dark:text-primary-light text-base text-center uppercase md:text-lg xl:text-2xl font-bold mb-4">Selamat Datang di Dashboard</h1>
            <p class="text-sm lg:text-base xl:text-lg text-center font-normal text-primary-dark dark:text-base-light mb-3">
              <strong>Dashboard</strong> adalah bagian yang berfungsi agar pengguna yang terdaftar untuk masuk ke Dashboard dapat menambahkan, menghapus, dan mengedit data-data yang ditampilkan pada halaman non-Dashboard atau yang biasa disebut
              <em>Tampilan Pengguna</em> atau <em>Landing Page</em>. Jika anda sudah masuk ke halaman Dashboard maka anda sudah mendaftar dan mendapat izin dari pihak yang mengelola website ini.
            </p>
          </div>
        </div>

        {{-- Timeline Pembuatan Laporan --}}
        {{-- <div class="px-4 pb-8 mx-auto max-w-screen-xl">
          <div class="bg-primary-light rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">
            <h2 class="inline-flex items-center text-primary-dark text-base uppercase md:text-lg xl:text-xl font-bold mb-6">

              <x-icon.square class="mr-3"/>
              
              Panduan dalam pembuatan laporan 
            </h2>
            <p class="text-sm lg:text-base xl:text-lg font-normal text-primary-dark mb-4 font-roboto">
              Selamat datang di <em>Panduan Pembuatan Laporan</em>. Panduan ini akan membantu anda memahami langkah-langkah yang diperlukan untuk menginput data laporan dengan benar dan efisien.
            </p>
            
            <ol class="relative border-l border-gray-200 dark:border-gray-700 mt-10 font-roboto">
              <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Penambahan Perangkat
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Menambahkan nama perangkat yang akan di cek 
                </h3>
                <p class="mb-4 text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Penambahan perangkat berfungsi untuk menambahkan input laporan yang ada pada bagian laporan tambah data.
                </p>
              </li>
              <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Pembuatan Laporan
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Pembuatan laporan dari hasil pengecekan perangkat
                </h3>
                <p class="text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Laporan dibuat dari data pengecekan yang dilakukan setiap hari. Input data akan muncul sesuai dengan perangkat yang ditambahkan sebelumnya. Pembuatan laporan akan di atur perhari, jika ingin memasukkan laporan pada tanggal yang diinginkan, maka ubah tanggal pada input tanggal.
                </p>
              </li>
              <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Tampilan Laporan
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Menampilkan laporan dalam bentuk tabel
                </h3>
                <p class="text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Laporan akan ditampilkan dalam bentuk tabel yang lengkap dengan <em>Aksi</em> yang dapat dilakukan kepada data seperti : <strong>Edit</strong>, <strong>Lihat</strong>, dan <strong>Delete</strong>. Laporan akan ditampilkan sesuai hari ini saja, jika ingin melihat laporan tanggal sebelumnya, maka ubah pada input tanggal.
                </p>
              </li>
              <li class="ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Download Laporan
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Mendownload laporan dalam bentuk PDF
                </h3>
                <p class="text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Laporan dapat di download oleh semua orang yang ingin melihat laporan tersebut yang tersedia dalam bentuk PDF yang akan direkap perbulan.
                </p>
              </li>
            </ol>

          </div>
        </div> --}}

        {{-- Timeline Pembuatan berita --}}
        {{-- <div class="px-4 pb-8 mx-auto max-w-screen-xl">
          <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">
            <h2 class="inline-flex items-center text-gray-900 dark:text-gray-100 text-base uppercase md:text-lg xl:text-xl font-roboto font-bold mb-6">

              <x-icon.news class="mr-3"/>

              Panduan dalam pembuatan berita
            </h2>
            <p class="text-sm lg:text-base xl:text-lg font-normal text-gray-600 dark:text-gray-100 mb-4 font-roboto">
              Selamat datang di <em>Panduan Pembuatan Berita</em>. Panduan ini akan membantu anda memahami langkah-langkah dalam membuat berita terkini sesuai peristiwa yang ada dan terjadi.
            </p>
            
            <ol class="relative border-l border-gray-200 dark:border-gray-700 mt-10 font-roboto">
              <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Penambahan Berita
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Menambahkan berita pada halaman tambah berita
                </h3>
                <p class="mb-4 text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Penambahan berita ini dapat dilakukan oleh siapa saja yang dapat mengakses dashboard. Syarat yang harus dipatuhi yaitu berita harus bersifat fakta dan aktual
                </p>
              </li>
              <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Tampilan Berita
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Tampilan berita dalam bentuk tabel
                </h3>
                <p class="text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Berita ditampilkan dalam bentuk tabel, lengkap dengan aksi yang dapat dipilih seperti : <strong>Edit</strong>, <strong>Lihat</strong>, dan <strong>Delete</strong>.
                </p>
              </li>
              <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Landing Page Berita
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Menampilkan berita pada landing page
                </h3>
                <p class="text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Berita akan ditampilkan pada <em>Landing Page</em>, dan dapat di buka untuk melihat secara lengkap isi berita.
                </p>
              </li>
            </ol>
          
          </div>
        </div> --}}

        {{-- Timeline Pembuatan Jadwal --}}
        {{-- <div class="px-4 pb-8 mx-auto max-w-screen-xl">
          <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg px-5 py-8 sm:px-8 md:p-12">
            <h2 class="inline-flex items-center text-gray-900 dark:text-gray-100 text-base uppercase md:text-lg xl:text-xl font-roboto font-bold mb-6">
              
              <x-icon.calendar class="mr-3"/>

              Panduan dalam pembuatan jadwal
            </h2>
            <p class="text-sm lg:text-base xl:text-lg font-normal text-gray-600 dark:text-gray-100 mb-4 font-roboto">
              Selamat datang di <em>Panduan Pembuatan Jadwal</em>. Panduan ini akan membantu anda memahami langkah-langkah dalam membuat jadwal penerbangan yang sesuai dengan FIDS pada bandara.
            </p>
            
            <ol class="relative border-l border-gray-200 dark:border-gray-700 mt-10 font-roboto">
              <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Penambahan Jadwal
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Menambahkan jadwal pada halaman tambah jadwal
                </h3>
                <p class="mb-4 text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Penambahan berita ini dapat dilakukan oleh siapa saja yang dapat mengakses dashboard. Syarat yang harus dipatuhi yaitu jadwal harus sesuai dengan data yang ada, usahakan tidak ada kesalahan yang disengaja dalam menginput jadwal. 
                </p>
              </li>
              <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Tampilan Jadwal
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Tampilan berita dalam bentuk tabel
                </h3>
                <p class="text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Berita ditampilkan dalam bentuk tabel yang dibagi menjadi tabel keberangkatan dan kedatangan, lengkap dengan aksi yang dapat dipilih seperti : <strong>Edit</strong>, <strong>Lihat</strong>, dan <strong>Delete</strong>.
                </p>
              </li>
              <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-indigo-800 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-400"></div>
                <span class="mb-1 text-xs md:text-sm font-normal leading-none text-indigo-700 dark:text-gray-300">
                  Landing Page Jadwal
                </span>
                <h3 class="text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-gray-50 uppercase">
                  Menampilkan jadwal pada landing page
                </h3>
                <p class="text-xs sm:text-sm lg:text-base font-normal text-gray-600 dark:text-gray-300">
                  Jadwal akan ditampilkan pada <em>Landing Page</em>, dan dibagi menjadi jadwal keberangkatan dan kedatangan.
                </p>
              </li>
            </ol>
          
          </div>
        </div> --}}
      
    </div>

@endsection

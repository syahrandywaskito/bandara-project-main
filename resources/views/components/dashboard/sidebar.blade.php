<aside id="sidebar-body" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full lg:translate-x-0 shadow-xl lg:shadow-none bg-base-light ">
  <div class="h-full px-3 pb-4 flex flex-col overflow-y-auto text-sm  md:text-base">

    {{-- side bar item --}}
    <ul class=" space-y-2.5 mt-4 font-medium">

      <li>
        <x-dashboard.sidebar-link href="{{route('dashboard')}}" icon="dashboard">
            Dashboard
        </x-dashboard.sidebar-link>
      </li>

      <li>
        <x-dashboard.sidebar-link href="{{ route('laporan.index') }}" icon="square">
            Laporan
        </x-dashboard.sidebar-link>
      </li>

      <li>
        <x-dashboard.sidebar-link href="{{ route('peralatan.index') }}" icon="gear">
            Peralatan
        </x-dashboard.sidebar-link>
      </li>

      <li>
        <x-dashboard.sidebar-link href="{{route('berita.index')}}" icon="news">
            Berita
        </x-dashboard.sidebar-link>
      </li>

      <li>
        <x-dashboard.sidebar-link href="{{route('jadwal.index')}}" icon="calendar">
            Jadwal
        </x-dashboard.sidebar-link>
      </li>

      @if (Gate::allows('isAdmin'))
        <li>
          <x-dashboard.sidebar-link href="{{route('user.index')}}" icon="people">
            Pengguna
          </x-dashboard.sidebar-link>
        </li>
        
        {{-- kontak --}}
        <li>
          <x-dashboard.sidebar-link href="{{route('contact.index')}}" icon="message">
            Kontak & Saran
          </x-dashboard.sidebar-link>
        </li>
      @endif

      
      <li>
        <x-dashboard.sidebar-link href="{{route('logout')}}" icon="logout">
            Logout
        </x-dashboard.sidebar-link>
      </li>
    </ul>

      {{-- <div class=" mt-auto py-4 font-roboto">
        <x-dashboard.sidebar-link href="https://github.com/syahrandywaskito" icon="github">
            Project on Github
        </x-dashboard.sidebar-link>
      </div> --}}

  </div>
</aside>


@push('script')
    <script>
      const sidebarBtn = document.querySelector("#sidebar-button");
      const sidebar = document.querySelector("#sidebar-body");

      sidebarBtn.addEventListener("click", () => {
        
        sidebar.classList.toggle("-translate-x-full");
        
      });
    </script>
@endpush
<div>
  <header class="bg-transparent absolute top-0 left-0 w-full flex items-center z-10">
    <div class="container">
      <div class="flex items-center justify-between relative">

        <div class="px-4">
          <a href="{{route('homepage')}}" class="font-bold text-lg lg:text-xl text-primary block py-6 tracking-wide uppercase">Teknik & Jasa</a>
        </div>

        <div class="flex items-center px-4">
          <button id="hamburger" name="hamburger" type="button" class="block absolute right-4 lg:hidden">
            <span class="hamburger-line origin-top-left transition duration-150 ease-in-out"></span>
            <span class="hamburger-line transition duration-150 ease-in-out"></span>
            <span class="hamburger-line origin-bottom-left transition duration-150 ease-in-out"></span>
          </button>

          <nav id="nav-menu" class="hidden absolute py-5 bg-primary-light shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none font-monobuntu">
            <ul class="block lg:flex ">
              <li class="group">
                <a href="{{route('homepage')}}" class="text-base text-dark py-2.5 mx-6 flex group-hover:underline group-hover:text-primary tracking-wider">Home Page</a>
              </li>
              <li class="group">
                <a href="{{ route('laporan.peralatan') }}" class="text-base text-dark py-2.5 mx-6 flex group-hover:text-primary group-hover:underline tracking-wider">Laporan</a>
              </li>
              <li class="group">
                <a href="{{route('hubungi.kami')}}" class="text-base text-dark py-2.5 mx-6 flex group-hover:text-primary group-hover:underline tracking-wider">Hubungi Kami</a>
              </li>
              <li class="group">
                <a href="{{route('login')}}" class="text-base bg-indigo-900 text-white py-2 px-2.5 mt-2 lg:mt-0 rounded-lg shadow-md mx-6 flex group-hover:text-primary group-hover:bg-indigo-400 tracking-wider">Login</a>
              </li>
            </ul>
          </nav>
        </div>

      </div>
    </div>
  </header>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
</div>
<div class="flex items-center ml-3">
  <div>
    <button type="button" class="flex text-sm bg-primary-light shadow-lg p-1 rounded-full focus:ring-4 focus:ring-secondary-light dark:focus:ring-slate-700" aria-expanded="false" data-dropdown-toggle="dropdown-user">
      <span class="sr-only">Open user menu</span>
      <img class="w-8 h-8 p-1 rounded-full" src="{{ asset('img/user.png') }}" alt="user photo" />
    </button>
  </div>
  <div class="z-50 hidden my-4 text-base list-none bg-primary-light rounded-lg shadow-lg absolute top-full right-9" id="dropdown-user">
    <div class="px-4 py-3 text-primary-dark text-xs md:text-sm uppercase" role="none">
      <p class="font-semibold" role="none">
        {{auth()->user()->name}}
      </p>
      <p class="font-medium truncate pt-1" role="none">
        {{auth()->user()->role}}
      </p>
    </div>

    <ul class="p-1.5 text-primary-dark text-xs md:text-sm" role="none">
      <li>
        <a href="{{route('dashboard')}}" class="block px-4 rounded-lg py-2 hover:bg-secondary-light hover:text-primary-light" role="menuitem">Dashboard</a>
      </li>
      <li>
        <a href="{{route('logout')}}" class="block px-4 py-2 rounded-lg hover:bg-secondary-light hover:text-primary-light" role="menuitem">Logout</a>
      </li>
    </ul>
  </div>
</div>

@push('script')
    <script>
        const dropdownButton = document.querySelector('[data-dropdown-toggle="dropdown-user"]');
        const dropdownMenu = document.getElementById('dropdown-user');

        dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
        });
    </script>
@endpush
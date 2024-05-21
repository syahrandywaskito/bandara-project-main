<div>
    {{-- * navbar & sidebar --}}
    <nav class="fixed top-0 z-50 w-full bg-base-light">
      <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
          <div class="flex items-center justify-start">
            
            <x-dashboard.sidebar-button/>

            <h2 class="flex ml-2 md:mr-24 cursor-default">
              <img src="{{asset('img/dishub.png')}}" class="h-8 mr-3" alt="logo dishhub"/>
              <span class="self-center uppercase font-semibold hidden sm:block sm:text-base md:text-lg lg:text-xl text-base-dark whitespace-nowrap">
                {{$slot}}
              </span>
            </h2>
          </div>

          <div class="flex items-center">

            {{-- * Dark toggle --}} 
            
            <x-dashboard.user-profile/>

          </div>
        </div>
      </div>
    </nav>
    
</div>
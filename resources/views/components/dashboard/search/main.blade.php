<form {{ $attributes->merge(['action']) }} method="GET" class="col-span-2 lg:col-span-1">
              
    <div class="flex">
        <label for="kolom" class="sr-only">select</label>
        <select id="kolom" class="block p-3.5 w-full z-20 text-base-dark bg-base-light rounded-l-lg outline-none focus:border-secondary-light text-xs md:text-sm" name="kolom">
            {{ $slot }}
        </select>

        <div class="relative w-full font-montserrat">
            <input
                type="text"
                name="cari"
                class="block p-3.5 w-full z-20 text-base-dark bg-base-light rounded-r-lg outline-none focus:border-secondary-light text-xs md:text-sm"
                placeholder="Cari"
                required
            />

            <x-dashboard.button.search/>
        </div>
    </div>
    
</form>
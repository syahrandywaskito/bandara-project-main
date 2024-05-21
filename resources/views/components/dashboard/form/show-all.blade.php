<form {{ $attributes->merge(['action']) }} method="GET" class="col-span-1">
    <input type="text" name="all" class="hidden" readonly value="all" />

    <x-dashboard.button.all/>
</form>
<a {{$attributes->merge(['href', 'class' => 'group text-secondary-light text-sm lg:text-base cursor-default'])}} >
    <span class="hover:border-b-2 hover:border-secondary-light font-medium">
    {{ $slot }}
    </span>
</a>
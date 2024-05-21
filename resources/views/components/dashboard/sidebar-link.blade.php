@props(['icon'])

<a class="flex items-center p-2 text-base-dark rounded-lg hover:bg-secondary-light hover:text-base-light"
    {{$attributes->merge(['href'])}}
    >
          
    <x-dynamic-component :component="'icon.' . $icon" />

    <span class="ml-3">
        {{$slot}}
    </span>
</a>
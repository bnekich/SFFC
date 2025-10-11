@props(['item'])

@props(['item'])

<li x-data="{ open: false }" class="relative">
    @if (isset($item['action']) && $item['action'] === 'logout')
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="block w-full text-left py-2 px-4 rounded hover:bg-gray-700">
                {{ $item['name'] }}
            </button>
        </form>
    @elseif(isset($item['submenu']))
        <button @click="open = !open"
            class="flex items-center justify-between w-full text-left py-2 px-4 rounded hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
            {{ $item['name'] }}
            <svg class="w-4 h-4 ml-2 transition-transform" :class="{ 'transform rotate-180': open }" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <ul x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-y-100"
            x-transition:leave-end="opacity-0 scale-y-0" class="pl-4 mt-1 space-y-1">
            @foreach ($item['submenu'] as $subitem)
                <x-menu-item :item="$subitem" />
            @endforeach
        </ul>
    @else
        <a href="{{ $item['url'] }}" class="block py-2 px-4 rounded hover:bg-gray-700">
            {{ $item['name'] }}
        </a>
    @endif
</li>

{{-- <li x-data="{ open: false }" @mouseover.away="open = false" class="relative">
    @if (isset($item['action']) && $item['action'] === 'logout')
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="block w-full text-left py-2 px-4 rounded hover:bg-gray-700">
                {{ $item['name'] }}
            </button>
        </form>
    @elseif(isset($item['submenu']))
        <button @mouseover="open = true" @click="open = !open"
            class="flex items-center justify-between w-full text-left py-2 px-4 rounded hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
            {{ $item['name'] }}
            <svg class="w-4 h-4 ml-2 transition-transform" :class="{ 'transform rotate-180': open }" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <ul x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="md:absolute z-10 w-48 md:mt-2 space-y-1 bg-gray-800 text-white rounded shadow-lg">
            @foreach ($item['submenu'] as $subitem)
                <x-menu-item :item="$subitem" />
            @endforeach
        </ul>
    @else
        <a href="{{ $item['url'] }}" class="block py-2 px-4 rounded hover:bg-gray-700">
            {{ $item['name'] }}
        </a>
    @endif
</li> --}}

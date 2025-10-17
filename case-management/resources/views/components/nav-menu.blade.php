<nav class="bg-blue-600 text-white w-min">
    <a href="{{ url('/dashboard') }}">
        <img src="{{ asset('images/sffc_logo.jpg') }}" alt="Logo">
    </a>


    <ul class="flex flex-col space-y-1 p-4">
        @foreach ($links as $link)
            <x-menu-item :link=$link />
        @endforeach
    </ul>
</nav>

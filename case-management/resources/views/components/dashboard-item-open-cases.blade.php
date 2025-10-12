<div class="max-w-sm bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
    <a href="#_" class="block mb-3">
        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{ $openCasesCount }} Open Cases</h5>
    </a>
    <a class="sffc-btn-primary" href="{{ route('case.index', 'case_status_id=1') }}">View
        <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </a>
</div>

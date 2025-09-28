<div class="card">
    <div class="card-header">Open Cases</div>
    <div class="card-body">
        <!-- Fetch and display open cases logic here -->
        <p>{{ $openCasesCount }} <a href="{{ route('case.index', 'case_status_id=1') }}"> Open Cases</a></p>
    </div>
</div>

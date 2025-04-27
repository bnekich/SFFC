<div class="card">
    <div class="card-header">Open Cases</div>
    <div class="card-body">
        <!-- Fetch and display open cases logic here -->
        <p>{{ $openCasesCount }} <a href="{{ route('case.index', 'status=O') }}"> Open Cases</a></p>
    </div>
</div>

@extends('layouts.app')

@section('title', 'Status do Coletor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-activity text-dark"></i> Status do Coletor
    </h4>
    <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Voltar
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4 d-flex align-items-center gap-2">
                <i class="bi bi-file-text fs-4 text-secondary"></i>
                <div>
                    <div class="small text-muted">Arquivo de log</div>
                    <div class="fw-semibold">{{ $logPath }}</div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center gap-2">
                <i class="bi bi-clock-history fs-4 text-secondary"></i>
                <div>
                    <div class="small text-muted">Última execução</div>
                    <div class="fw-semibold">{{ $lastRun ?? 'Nenhuma execução registrada' }}</div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center gap-2">
                @if(str_contains($lastStatus, 'Falha'))
                    <i class="bi bi-x-circle-fill fs-4 text-danger"></i>
                @else
                    <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                @endif
                <div>
                    <div class="small text-muted">Status</div>
                    <div class="fw-semibold {{ str_contains($lastStatus, 'Falha') ? 'text-danger' : 'text-success' }}">
                        {{ $lastStatus }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(empty($log))
    <div class="card p-4 text-center text-muted">
        <i class="bi bi-journal-x fs-1 mb-2"></i>
        <p class="mb-0">Nenhum log encontrado. Execute o coletor para gerar o arquivo.</p>
    </div>
@else
    <div class="card">
        <div class="card-header bg-dark text-white d-flex align-items-center gap-2">
            <i class="bi bi-terminal"></i> Log (últimas 50 linhas)
        </div>
        <div class="card-body p-0">
            <pre class="mb-0 p-3 bg-light" style="max-height:400px; overflow-y:auto; font-size:.85rem;">@foreach($log as $line){{ $line }}
@endforeach</pre>
        </div>
    </div>
@endif
@endsection

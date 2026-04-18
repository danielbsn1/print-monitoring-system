@extends('layouts.app')

@section('title', 'Lista de Impressoras')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-printer text-dark"></i> Lista de Impressoras
    </h4>
    <a href="{{ url('/status') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-activity me-1"></i> Ver Status do Coletor
    </a>
</div>

@if($stats->isEmpty())
    <div class="card p-4 text-center text-muted">
        <i class="bi bi-inbox fs-1 mb-2"></i>
        <p class="mb-0">Nenhuma impressora cadastrada.</p>
    </div>
@else
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="bi bi-tag me-1"></i>Nome</th>
                        <th><i class="bi bi-cpu me-1"></i>Modelo</th>
                        <th><i class="bi bi-upc me-1"></i>Série</th>
                        <th><i class="bi bi-wifi me-1"></i>IP</th>
                        <th><i class="bi bi-arrow-left-right me-1"></i>Contador Anterior</th>
                        <th><i class="bi bi-arrow-up-right me-1"></i>Contador Atual</th>
                        <th><i class="bi bi-file-earmark-text me-1"></i>Consumo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats as $impressora)
                    <tr>
                        <td class="text-muted">{{ $impressora->id }}</td>
                        <td class="fw-semibold">{{ $impressora->nome }}</td>
                        <td>{{ $impressora->modelo }}</td>
                        <td><code>{{ $impressora->serie }}</code></td>
                        <td><span class="badge bg-secondary">{{ $impressora->ip }}</span></td>
                        <td class="text-muted">{{ $impressora->contador_anterior ?? '-' }}</td>
                        <td>{{ $impressora->contador_atual ?? '-' }}</td>
                        <td>
                            <span class="badge bg-primary rounded-pill">
                                <i class="bi bi-file-earmark me-1"></i>{{ $impressora->consumo }} pág.
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection

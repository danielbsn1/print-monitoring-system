@extends('layouts.app')

@section('title', 'Impressoras')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-printer text-dark"></i> Impressoras
    </h4>
</div>

@if($stats->isEmpty())
    <div class="card p-4 text-center text-muted">
        <i class="bi bi-inbox fs-1 mb-2"></i>
        <p class="mb-0">Nenhuma impressora cadastrada.</p>
    </div>
@else
    {{-- Cards de resumo --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-4">
            <div class="stat-card bg-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">Total de Impressoras</div>
                        <div class="fs-3 fw-bold">{{ $stats->count() }}</div>
                    </div>
                    <i class="bi bi-printer-fill fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="stat-card bg-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">Total de Páginas</div>
                        <div class="fs-3 fw-bold">{{ $stats->sum('consumo') }}</div>
                    </div>
                    <i class="bi bi-file-earmark-text-fill fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="stat-card bg-warning text-dark">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">Maior Consumo</div>
                        <div class="fs-3 fw-bold">{{ $stats->max('consumo') ?? 0 }}</div>
                    </div>
                    <i class="bi bi-graph-up-arrow fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabela --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 rounded overflow-hidden">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="bi bi-tag me-1"></i>Nome</th>
                        <th><i class="bi bi-cpu me-1"></i>Modelo</th>
                        <th><i class="bi bi-upc me-1"></i>Série</th>
                        <th><i class="bi bi-wifi me-1"></i>IP</th>
                        <th><i class="bi bi-file-earmark me-1"></i>Consumo</th>
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
                        <td>
                            <span class="badge bg-primary rounded-pill">
                                <i class="bi bi-file-earmark-text me-1"></i>{{ $impressora->consumo }} pág.
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

@extends('layouts.app')

@section('title', 'Histórico - {{ $impressora->nome }}')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-clock-history text-dark"></i> Histórico — {{ $impressora->nome }}
    </h4>
    <a href="{{ route('impressoras.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Voltar
    </a>
</div>

{{-- Info da impressora --}}
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="small text-muted">Modelo</div>
                <div class="fw-semibold">{{ $impressora->modelo }}</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="small text-muted">Série</div>
                <div class="fw-semibold"><code>{{ $impressora->serie }}</code></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="small text-muted">IP</div>
                <div class="fw-semibold"><span class="badge bg-secondary">{{ $impressora->ip }}</span></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="small text-muted">Total de Leituras</div>
                <div class="fw-semibold">{{ $impressora->leituras->count() }}</div>
            </div>
        </div>
    </div>
</div>

@if($impressora->leituras->isEmpty())
    <div class="card p-5 text-center text-muted">
        <i class="bi bi-journal-x fs-1 mb-2"></i>
        <p class="mb-0">Nenhuma leitura registrada para esta impressora.</p>
    </div>
@else
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="bi bi-calendar me-1"></i>Data da Leitura</th>
                        <th><i class="bi bi-arrow-left-right me-1"></i>Contador Anterior</th>
                        <th><i class="bi bi-arrow-up-right me-1"></i>Contador Atual</th>
                        <th><i class="bi bi-file-earmark-text me-1"></i>Consumo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($impressora->leituras as $leitura)
                    @php
                        $consumo = $leitura->contador_anterior
                            ? max(0, $leitura->contador - $leitura->contador_anterior)
                            : 0;
                    @endphp
                    <tr>
                        <td class="text-muted">{{ $leitura->id }}</td>
                        <td>{{ optional($leitura->data_leitura)->format('d/m/Y H:i') ?? '-' }}</td>
                        <td class="text-muted">{{ $leitura->contador_anterior ?? '-' }}</td>
                        <td class="fw-semibold">{{ $leitura->contador }}</td>
                        <td>
                            @if($consumo > 0)
                                <span class="badge bg-primary rounded-pill">{{ $consumo }} pág.</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection

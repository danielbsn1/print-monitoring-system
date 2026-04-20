@extends('layouts.app')

@section('title', 'Impressoras')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-printer text-dark"></i> Impressoras
    </h4>
    <a href="{{ route('impressoras.create') }}" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Nova Impressora
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

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

@if($stats->isEmpty())
    <div class="card p-5 text-center text-muted">
        <i class="bi bi-inbox fs-1 mb-2"></i>
        <p class="mb-0">Nenhuma impressora cadastrada.</p>
        <a href="{{ route('impressoras.create') }}" class="btn btn-dark btn-sm mt-3 mx-auto" style="width:fit-content">
            <i class="bi bi-plus-lg me-1"></i> Cadastrar agora
        </a>
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
                        <th>Contador Ant.</th>
                        <th>Contador Atual</th>
                        <th><i class="bi bi-file-earmark-text me-1"></i>Consumo</th>
                        <th class="text-center">Ações</th>
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
                                {{ $impressora->consumo }} pág.
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('impressoras.show', $impressora->id) }}" class="btn btn-sm btn-outline-info" title="Ver histórico">
                                <i class="bi bi-clock-history"></i>
                            </a>
                            <a href="{{ route('impressoras.edit', $impressora->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('impressoras.destroy', $impressora->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Excluir {{ $impressora->nome }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection

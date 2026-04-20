@extends('layouts.app')

@section('title', 'Editar Impressora')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-pencil text-dark"></i> Editar Impressora
    </h4>
    <a href="{{ route('impressoras.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Voltar
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('impressoras.update', $impressora->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nome</label>
                    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                           value="{{ old('nome', $impressora->nome) }}">
                    @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Modelo</label>
                    <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror"
                           value="{{ old('modelo', $impressora->modelo) }}">
                    @error('modelo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Número de Série</label>
                    <input type="text" name="serie" class="form-control @error('serie') is-invalid @enderror"
                           value="{{ old('serie', $impressora->serie) }}">
                    @error('serie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Endereço IP</label>
                    <input type="text" name="ip" class="form-control @error('ip') is-invalid @enderror"
                           value="{{ old('ip', $impressora->ip) }}">
                    @error('ip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                    <a href="{{ route('impressoras.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-floppy me-1"></i> Atualizar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

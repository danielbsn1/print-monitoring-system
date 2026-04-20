@extends('layouts.app')

@section('title', 'Nova Impressora')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-printer text-dark"></i> Nova Impressora
    </h4>
    <a href="{{ route('impressoras.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Voltar
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('impressoras.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nome</label>
                    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                           value="{{ old('nome') }}" placeholder="Ex: Impressora RH">
                    @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Modelo</label>
                    <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror"
                           value="{{ old('modelo') }}" placeholder="Ex: Konica C258">
                    @error('modelo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Número de Série</label>
                    <input type="text" name="serie" class="form-control @error('serie') is-invalid @enderror"
                           value="{{ old('serie') }}" placeholder="Ex: A1B2C3D4">
                    @error('serie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Endereço IP</label>
                    <input type="text" name="ip" class="form-control @error('ip') is-invalid @enderror"
                           value="{{ old('ip') }}" placeholder="Ex: 192.168.1.100">
                    @error('ip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                    <a href="{{ route('impressoras.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-floppy me-1"></i> Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

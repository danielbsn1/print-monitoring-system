<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Status do Coletor</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        .card { background: #fff; border: 1px solid #ddd; padding: 18px; margin-bottom: 16px; border-radius: 6px; }
        pre { background: #f4f4f4; border: 1px solid #ccc; padding: 16px; overflow-x: auto; white-space: pre-wrap; word-break: break-word; }
        .notice { margin: 16px 0; padding: 12px; background: #eef6ff; border: 1px solid #b8d6ff; }
        .status-ok { color: #0a7a07; }
        .status-error { color: #a00; }
        a { color: #1a73e8; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Status do Coletor</h1>

    <div class="card">
        <p><strong>Arquivo de log:</strong> {{ $logPath }}</p>
        <p><strong>Última execução:</strong> {{ $lastRun ?? 'Nenhuma execução registrada' }}</p>
        <p><strong>Status:</strong>
            <span class="{{ str_contains($lastStatus, 'Falha') ? 'status-error' : 'status-ok' }}">
                {{ $lastStatus }}
            </span>
        </p>
    </div>

    @if(empty($log))
        <div class="notice">
            <p>Nenhum log encontrado ainda. Execute o coletor para gerar o arquivo.</p>
        </div>
    @else
        <div class="card">
            <p>Últimas linhas do log (máx. 50):</p>
            <pre>
@foreach($log as $line)
{{ $line }}
@endforeach
            </pre>
        </div>
    @endif

    <p><a href="{{ url('/') }}">← Voltar para a lista de impressoras</a></p>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Impressoras</title>
</head>
<body>
    <h1>Lista de Impressoras</h1>

    @if($stats->isEmpty())
        <p>Nenhuma impressora cadastrada.</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Modelo</th>
                    <th>Serie</th>
                    <th>IP</th>
                    <th>Consumo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats as $impressora)
                    <tr>
                        <td>{{ $impressora->id }}</td>
                        <td>{{ $impressora->nome }}</td>
                        <td>{{ $impressora->modelo }}</td>
                        <td>{{ $impressora->serie }}</td>
                        <td>{{ $impressora->ip }}</td>
                        <td>{{ $impressora->consumo }} pagina(s)</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>

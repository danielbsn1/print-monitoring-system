$taskName = 'StartLaravelServer'
$scriptPath = Join-Path $PSScriptRoot 'start_laravel.bat'
$action = "cmd.exe /c `"$scriptPath`""

Write-Host "Registrando tarefa para iniciar Laravel: $taskName"

schtasks /Create /TN $taskName /TR $action /SC WEEKLY /D FRI /ST 15:55 /F /RL HIGHEST /RU SYSTEM

if ($LASTEXITCODE -eq 0) {
    Write-Host "Tarefa criada com sucesso. Ela executará toda sexta-feira às 15:55."
}
else {
    Write-Error "Falha ao criar a tarefa. Código: $LASTEXITCODE"
}
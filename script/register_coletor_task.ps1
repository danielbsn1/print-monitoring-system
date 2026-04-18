$taskName = 'ColetorImpressora'
$scriptPath = Join-Path $PSScriptRoot 'run_coletor.bat'
$logPath = Join-Path $PSScriptRoot 'coletor_task.log'


$action = "`"$scriptPath`""

Write-Host "Registrando tarefa agendada: $taskName"
Write-Host "Script: $scriptPath"
Write-Host "Log: $logPath"


schtasks /Delete /TN $taskName /F 2>$null


schtasks /Create /TN $taskName /TR $action /SC WEEKLY /D FRI /ST 16:00 /F /RL HIGHEST /RU SYSTEM

if ($LASTEXITCODE -eq 0) {
    Write-Host "Tarefa criada com sucesso. Ela executará toda sexta-feira às 16:00."
    Write-Host "Logs salvos em: $logPath"
}
else {
    Write-Error "Falha ao criar a tarefa. Código: $LASTEXITCODE"
}

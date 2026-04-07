@echo off
setlocal
cd /d %~dp0
if exist "%~dp0venv311\Scripts\python.exe" (
    "%~dp0venv311\Scripts\python.exe" coletor.py
) else if exist "%~dp0venv3\Scripts\python.exe" (
    "%~dp0venv3\Scripts\python.exe" coletor.py
) else if exist "%~dp0venv2\Scripts\python.exe" (
    "%~dp0venv2\Scripts\python.exe" coletor.py
) else if exist "%~dp0snmp_env\Scripts\python.exe" (
    "%~dp0snmp_env\Scripts\python.exe" coletor.py
) else (
    py -3 coletor.py 2>nul || python coletor.py
)
endlocal

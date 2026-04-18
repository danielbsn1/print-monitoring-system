@echo off
setlocal enabledelayedexpansion
cd /d "%~dp0"

REM Log com timestamp
echo [%date% %time%] 

REM 
if exist "%~dp0venv311\Scripts\python.exe" (
    echo [%date% %time%] 
    "%~dp0venv311\Scripts\python.exe" 
) else if exist "%~dp0venv3\Scripts\python.exe" (
    echo [%date% %time%] 
    "%~dp0venv3\Scripts\python.exe" 
) else if exist "%~dp0venv2\Scripts\python.exe" (
    echo [%date% %time%] 
    "%~dp0venv2\Scripts\python.exe" 
) else if exist "%~dp0snmp_env\Scripts\python.exe" (
    echo [%date% %time%] 
    "%~dp0snmp_env\Scripts\python.exe" 
) else (
    echo [%date% %time%] 
    py -3 coletor.py 2>nul || 
)

if %errorlevel% equ 0 (
    echo [%date% %time%] 
) else (
    echo [%date% %time%] 
)

endlocal

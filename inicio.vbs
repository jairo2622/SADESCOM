Set WshShell = CreateObject("WScript.Shell")
Set fso = CreateObject("Scripting.FileSystemObject")

' 📂 Obtener la ruta del directorio actual (donde está este script)
currentPath = fso.GetParentFolderName(WScript.ScriptFullName)

' 📁 Cambiar el directorio actual al del proyecto
WshShell.CurrentDirectory = currentPath

' ▶️ Iniciar el servidor Laravel en segundo plano (sin mostrar consola)
WshShell.Run "cmd /c php artisan serve", 0, False

' ⏳ Esperar unos segundos para que el servidor se inicie correctamente
WScript.Sleep 1000

' 🌐 Buscar la ruta del ejecutable de Edge
edgePath = "C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe"
If Not fso.FileExists(edgePath) Then
    edgePath = "C:\Program Files\Microsoft\Edge\Application\msedge.exe"
End If

' 🚀 Abrir Edge en modo aplicación y pantalla completa
WshShell.Run """" & edgePath & """ --app=http://127.0.0.1:8000 --start-fullscreen", 0, False

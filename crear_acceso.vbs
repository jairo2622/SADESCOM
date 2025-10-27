Set WshShell = CreateObject("WScript.Shell")
Set fso = CreateObject("Scripting.FileSystemObject")

' 📂 Carpeta actual donde está este script
currentPath = fso.GetParentFolderName(WScript.ScriptFullName)

' 🟢 Ruta del archivo que ejecuta Laravel
targetPath = currentPath & "\inicio.vbs"

' 🟢 Ruta donde se creará el acceso directo (en el escritorio del usuario actual)
desktopPath = WshShell.SpecialFolders("Desktop")
shortcutPath = desktopPath & "\SADESCOM.lnk"

' 🟢 Crear el acceso directo
Set shortcut = WshShell.CreateShortcut(shortcutPath)
shortcut.TargetPath = targetPath
shortcut.WorkingDirectory = currentPath
shortcut.IconLocation = currentPath & "\public\images\icono2.ico"
shortcut.Save

MsgBox "Acceso directo 'SADESCOM.lnk' creado correctamente en el escritorio.", vbInformation, "Listo"

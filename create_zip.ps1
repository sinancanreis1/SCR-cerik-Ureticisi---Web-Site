$source = (Get-Item .).FullName
$destination = "C:\Users\sinan\Desktop\samsun-sehir-isitme-sunucu.zip"

If (Test-Path $destination) { Remove-Item $destination }

Add-Type -AssemblyName System.IO.Compression.FileSystem
$compressionLevel = [System.IO.Compression.CompressionLevel]::Optimal

$zip = [System.IO.Compression.ZipFile]::Open($destination, 'Create')

Get-ChildItem $source -Recurse -Force -ErrorAction SilentlyContinue | Where-Object {
    $_.FullName -notmatch '\\node_modules(\\|$)' -and
    $_.FullName -notmatch '\\\.git(\\|$)' -and
    $_.Extension -ne '.zip'
} | ForEach-Object {
    $relativePath = $_.FullName.Substring($source.Length + 1)
    if (-not $_.PSIsContainer) {
        try {
            [void][System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zip, $_.FullName, $relativePath, $compressionLevel)
        } catch {}
    }
}

$zip.Dispose()
Write-Host "Basariyla zipleme yapildi. Dosya Masaustunuzde: $destination"

<?php
/**
 * Script de verificación de assets de Vite
 * Sube este archivo a la raíz y accede vía: https://intranet.cifco.gob.sv/verificar_assets.php
 * ELIMÍNALO después de verificar por seguridad
 */

header('Content-Type: text/html; charset=utf-8');

echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Verificación de Assets</title>";
echo "<style>body{font-family:monospace;padding:20px;background:#1e1e1e;color:#d4d4d4}";
echo ".success{color:#4ec9b0}.error{color:#f48771}.warning{color:#ce9178}";
echo "h1{color:#4ec9b0}h2{color:#dcdcaa;border-bottom:1px solid #404040;padding-bottom:10px}";
echo "pre{background:#252526;padding:10px;border-radius:5px;overflow-x:auto}</style></head><body>";

echo "<h1>🔍 Verificación de Assets de Vite - Laravel</h1>";

// 1. Verificar directorio actual
echo "<h2>📂 Directorio Actual</h2>";
echo "<pre class='success'>".getcwd()."</pre>";

// 2. Verificar estructura de carpetas
echo "<h2>📁 Estructura de Carpetas</h2>";
$dirs = [
    'public' => __DIR__ . '/public',
    'public/build' => __DIR__ . '/public/build',
    'public/build/assets' => __DIR__ . '/public/build/assets',
];

foreach ($dirs as $name => $path) {
    if (is_dir($path)) {
        echo "<div class='success'>✅ $name existe</div>";
    } else {
        echo "<div class='error'>❌ $name NO existe</div>";
    }
}

// 3. Verificar manifest.json
echo "<h2>📄 Manifest.json</h2>";
$manifestPath = __DIR__ . '/public/build/manifest.json';
if (file_exists($manifestPath)) {
    echo "<div class='success'>✅ Manifest existe (".filesize($manifestPath)." bytes)</div>";
    $manifest = json_decode(file_get_contents($manifestPath), true);
    echo "<pre>Total de entradas: ".count($manifest)."</pre>";

    // Mostrar primeros 5 archivos
    echo "<h3>Primeros 5 archivos en manifest:</h3><pre>";
    $count = 0;
    foreach ($manifest as $key => $value) {
        if ($count++ >= 5) break;
        echo "$key → ".$value['file']."\n";
    }
    echo "</pre>";
} else {
    echo "<div class='error'>❌ Manifest NO existe</div>";
}

// 4. Verificar archivos CSS y JS principales
echo "<h2>🎨 Archivos Principales (según tu error)</h2>";
$assetsToCheck = [
    'app-CQ-GOKG0.css',
    'Welcome-DPKPCHpZ.css',
    'app-CmE-UuGV.js',
    'Welcome-DaLWBDKQ.js',
    '_plugin-vue_export-helper-DlAUqK2U.js',
];

foreach ($assetsToCheck as $asset) {
    $fullPath = __DIR__ . '/public/build/assets/' . $asset;
    if (file_exists($fullPath)) {
        echo "<div class='success'>✅ $asset (".number_format(filesize($fullPath))." bytes)</div>";
    } else {
        echo "<div class='error'>❌ $asset NO ENCONTRADO</div>";
    }
}

// 5. Contar total de archivos en assets
echo "<h2>📊 Contenido de /public/build/assets/</h2>";
$assetsPath = __DIR__ . '/public/build/assets';
if (is_dir($assetsPath)) {
    $files = scandir($assetsPath);
    $files = array_diff($files, ['.', '..']);
    echo "<div class='success'>Total de archivos: ".count($files)."</div>";
    echo "<details><summary>Ver todos (click para expandir)</summary><pre>";
    foreach ($files as $file) {
        $size = filesize($assetsPath.'/'.$file);
        echo sprintf("%-50s %10s\n", $file, number_format($size).' bytes');
    }
    echo "</pre></details>";
} else {
    echo "<div class='error'>❌ Directorio de assets no existe</div>";
}

// 6. Verificar permisos
echo "<h2>🔐 Permisos</h2>";
foreach ($dirs as $name => $path) {
    if (is_dir($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        $readable = is_readable($path) ? '✅ Lectura' : '❌ Lectura';
        echo "<div>$name: $perms - $readable</div>";
    }
}

// 7. Verificar .htaccess
echo "<h2>⚙️ Archivos .htaccess</h2>";
$htaccessFiles = [
    'Raíz' => __DIR__ . '/.htaccess',
    'Public' => __DIR__ . '/public/.htaccess',
];

foreach ($htaccessFiles as $name => $path) {
    if (file_exists($path)) {
        echo "<div class='success'>✅ .htaccess en $name (".filesize($path)." bytes)</div>";
    } else {
        echo "<div class='error'>❌ .htaccess en $name NO existe</div>";
    }
}

// 8. Variables de entorno
echo "<h2>🌍 Variables del Servidor</h2>";
echo "<pre>";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "\n";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "</pre>";

// 9. Test de acceso directo
echo "<h2>🔗 Test de Acceso Directo</h2>";
echo "<p>Intenta acceder directamente a estos URLs:</p>";
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$baseUrl = $protocol . '://' . $_SERVER['HTTP_HOST'];

foreach ($assetsToCheck as $asset) {
    $url = $baseUrl . '/build/assets/' . $asset;
    echo "<div><a href='$url' target='_blank'>$url</a></div>";
}

echo "<hr><p class='warning'>⚠️ IMPORTANTE: Elimina este archivo después de verificar por seguridad</p>";
echo "</body></html>";
?>

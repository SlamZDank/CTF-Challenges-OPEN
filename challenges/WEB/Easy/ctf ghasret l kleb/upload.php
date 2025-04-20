<?php
// CONFIGURE THESE
$FLAG_PATH = '/flag.txt';
$MAX_FILE_SIZE = 1024 * 1024;
$ALLOWED_PATHS = ['/'];

// Enable strict error reporting
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');

function clean_directory($dir) {
    if (!is_dir($dir)) return;
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = "$dir/$file";
        is_dir($path) ? clean_directory($path) : unlink($path);
    }
    rmdir($dir);
}

function get_output($content) {
    return <<<HTML
    <div class="container">
        <h1>📊 Analysis Results</h1>
        <div class="result">
            <h3>Report Contents:</h3>
            <pre>$content</pre>
        </div>
    </div>
HTML;
}

try {
    if (!isset($_FILES['report'])) throw new Exception('No file uploaded');
    
    $file = $_FILES['report'];
    if ($file['size'] > $MAX_FILE_SIZE) throw new Exception('File too large');
    if ($file['error'] !== UPLOAD_ERR_OK) throw new Exception('Upload error');

    // Create temp directory
    $temp_dir = sys_get_temp_dir() . '/conane_' . bin2hex(random_bytes(16));
    mkdir($temp_dir, 0700, true);

    // Extract with symlink support using system unzip
    $zip_path = escapeshellarg($file['tmp_name']);
    $output = shell_exec("unzip -n -d $temp_dir $zip_path 2>&1");
    
    if (strpos($output, 'error') !== false) {
        throw new Exception('Invalid ZIP file');
    }

    // Validate required file
    $report_path = "$temp_dir/report.txt";
    if (!file_exists($report_path)) throw new Exception('Missing report.txt');

    // Resolve symlinks
    if (is_link($report_path)) {
        $real_path = realpath($report_path);
        if (!str_starts_with($real_path, '/')) {
            throw new Exception('Invalid path resolution');
        }
        $report_path = $real_path;
    }

    // Read contents
    $content = htmlspecialchars(file_get_contents($report_path), ENT_QUOTES, 'UTF-8');
    echo get_output($content);

} catch (Exception $e) {
    echo get_output("ERROR: " . $e->getMessage());
} finally {
    if (isset($temp_dir)) clean_directory($temp_dir);
}
?>
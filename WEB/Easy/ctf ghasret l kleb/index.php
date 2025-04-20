<?php
// Prevent accidental access to flag.txt
if (basename($_SERVER['PHP_SELF']) === 'flag.txt') {
    header('HTTP/1.0 403 Forbidden');
    die('Forbidden');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>🔒 CONANE Secure Report Processor</title>
    <style>
        :root {
            --neon-green: #0f0;
            --dark-bg: #000;
            --terminal-font: 'Courier New', monospace;
        }
        
        body {
            background-color: var(--dark-bg);
            color: var(--neon-green);
            font-family: var(--terminal-font);
            margin: 0;
            padding: 2rem;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 3px solid var(--neon-green);
            padding: 2rem;
            box-shadow: 0 0 15px var(--neon-green);
        }
        
        h1 {
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5rem;
            margin-bottom: 2rem;
            text-shadow: 0 0 10px var(--neon-green);
        }
        
        .upload-box {
            border: 2px dashed var(--neon-green);
            padding: 2rem;
            text-align: center;
        }
        
        input[type="file"] {
            margin: 1rem 0;
            padding: 0.5rem;
            background: #001100;
            color: var(--neon-green);
            border: 1px solid var(--neon-green);
        }
        
        input[type="submit"] {
            background: #002200;
            color: var(--neon-green);
            border: 2px solid var(--neon-green);
            padding: 0.8rem 2rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        input[type="submit"]:hover {
            background: var(--neon-green);
            color: var(--dark-bg);
            box-shadow: 0 0 15px var(--neon-green);
        }
        
        .result {
            margin-top: 2rem;
            padding: 1rem;
            border: 1px solid var(--neon-green);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛡️ CONANE Secure Report Processor <span class="blink">_</span></h1>
        
        <!-- Hint Box -->
        <div class="hint-box">
            <div class="hint-title">🕵️‍♂️ CONANE Security Bulletin:</div>
            <div>
                <p>⚠️ Did you know? Server-side file processing might follow symbolic connections. Always verify your file references!</p>
                <p>🔍 Accepted file type: ZIP archives only<br>
                📦 Maximum size: 1MB</p>
            </div>
        </div>

        <div class="upload-box">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <p>Upload your report ZIP file for analysis:</p>
                <input type="file" name="report" accept=".zip">
                <br>
                <input type="submit" value="🚀 Analyze Report">
            </form>
        </div>
    </div>
    
    <!-- DEBUG: File handler uses MIME type text/plain validation (v3.1.4) -->
</body>
</html>
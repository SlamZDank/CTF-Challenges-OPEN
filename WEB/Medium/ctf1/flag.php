
<?php

// Secret key derivation (same as login.php)
$logoFilename = "conane_logo.png";
$secret = md5(strtolower($logoFilename) . "guardian");

function isValidCookie($cookie, $secret) {
    $parts = explode('.', $cookie);
    if (count($parts) !== 2) return false;
    list($encoded, $providedSig) = $parts;
    $expectedSig = md5($encoded . $secret);
    return hash_equals($expectedSig, $providedSig);
}

if (!isset($_COOKIE['auth'])) die("No auth cookie. Are you worthy?");
$cookie = $_COOKIE['auth'];

if (!isValidCookie($cookie, $secret)) die("Invalid signature. The guardian rejects you.");

list($encoded, $sig) = explode('.', $cookie);
$data = json_decode(base64_decode($encoded), true);
if ($data === null) die("Corrupted cookie. The guardian is displeased.");

// Only set the header and exit (no HTML output)
if ($data['flag'] === true) {
    header("X-Flag: CyberTrace{Guardian_Of_Hidden_Essence}");
    exit(); // Terminate immediately after setting the header
} else {
    echo "<div class='container'><h1>Insuficient Power</h1><p>Only those who bond with the guardian’s essence may pass.</p></div>";
}
?>
<!-- The HTML below will NOT execute if the flag is valid (due to exit()) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conane CTF: Flag Page</title>
    <style>
        body { font-family: Arial, sans-serif; background: #121212; color: #e0e0e0; text-align: center; }
        .container { margin-top: 50px; }
        h1 { color: #ff4081; }
        .hint { background: #1e1e1e; padding: 15px; border-radius: 8px; margin: 20px auto; width: 80%; max-width: 600px; }
        .anime-logo { width: 150px; }
    </style>
</head>
<body>
    

 
    <div class="container">
        <img src="conane_logo.png" alt="Guardian's True Essence" class="anime-logo">
    </div>
</body>
</html>


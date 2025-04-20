<?php
// Secret key is the MD5 hash of the lowercase anime logo filename + "guardian"
$logoFilename = "conane_logo.png"; // Players must find this filename
$secret = md5(strtolower($logoFilename) . "guardian");
$data = ["role" => "user", "flag" => false, "anime" => "Conane"];
$cookie_value = createAuthCookie($data, $secret); 
function createAuthCookie($data, $secret) {
    $json = json_encode($data);
    $encoded = base64_encode($json);
    $signature = md5($encoded . $secret);
    return $encoded . '.' . $signature;
}

if (!isset($_COOKIE['auth'])) {
  
    setcookie("auth", $cookie_value, time() + 3600, "/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conane CTF: Cookie Flipper</title>
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
        <h1>Welcome to Conane’s Sanctuary</h1>
        <p>You are logged in as a humble fan (<strong>role: user</strong>).</p>
        <div class="hint">
            <h2>Hint</h2>
            <p>The secret lies in the <strong>true name of the guardian</strong> and its eternal bond. Look closely at the essence of this page.</p>
            <p>Remember: The cookie’s signature is protected by the guardian’s true name combined with the guardian sacred word.</p>
        </div>
        <p>Prove your worth at the <a href="flag.php" style="color:#ff4081;">Flag Page</a>.</p>
    </div>
</body>
</html>
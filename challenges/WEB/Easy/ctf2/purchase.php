<?php
header("Content-Type: text/plain");


$hiddenNumber = 3117; 

$flag = "CyberTrace{Cursed_Tr34sur3_0f_Th3_Sh4d0w_L3dg3r}";

$data = json_decode(file_get_contents('php://input'), true);
$quantity = $data['quantity'] ?? 0;

// Verify the cursed transaction
if ($quantity != -$hiddenNumber and $quantity <0 ) {
    die("Kaito growls: 'Negative totals? Nice try, mortal. Perhaps a specific number hidden among the details holds the key to the secret.'");
} else if ($quantity === -$hiddenNumber ){
    die("Kaito roars: 'You've broken the curse! The truth is: $flag'");
}
 else {
    die("Kaito chuckles: 'Your offering of " . (999 * $quantity) . " gold amuses me.'");
}
?>

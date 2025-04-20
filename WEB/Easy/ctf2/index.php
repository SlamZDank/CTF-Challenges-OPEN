
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conane CTF: Cursed Ledger</title>
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
        <h1>📜 Kaito's Cursed Ledger</h1>
        <div class="item">
            <img src="scroll_of_truth.jpeg" alt="Cursed Scroll" class="cursed-scroll">
            <div>
                <h3>Scroll of Eternal Truth</h3>
                <p>Price: <span id="price">999</span> gold</p>
                <p>Quantity: <input type="number" id="quantity" min="1" value="1" oninput="updateTotal()"></p>
                <p>Total: <span id="total">999</span> gold</p>
                <button onclick="purchase()">Sign the Ledger</button>
                <div class="hint">
                    "The scroll's essence holds the key to reversal. Seek the <em>mark of the ancients</em>." – Kaito
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTotal() {
            const quantity = document.getElementById('quantity').value;
            document.getElementById('total').textContent = 999 * quantity;
        }

        function purchase() {
            const quantity = parseInt(document.getElementById('quantity').value);
            
            if (total < 0) {
                alert("Kaito growls: 'Negative totals? Nice try, mortal.'");
                return;
            }


            if (quantity > 0) {
                alert("Kaito smirks: 'The ledger rejects half-hearted pledges.'");

            }

            
            fetch('/purchase.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ quantity: quantity }),
            })
            .then(response => response.text())
            .then(data => alert(data))
            .catch(console.error);
        }
    </script>
</body>
</html>
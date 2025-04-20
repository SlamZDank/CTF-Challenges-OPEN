from flask import Flask, request, render_template
import sqlite3
import hashlib

app = Flask(__name__)

# Calcul du hash MD5 du mot "flag"
md5_table = hashlib.md5("flag".encode()).hexdigest()  

# Initialisation de la base de données
def init_db():
    conn = sqlite3.connect('database.db')
    cursor = conn.cursor()
    # Création de la table dont le nom est le hash MD5 de "flag"
    cursor.execute(f'CREATE TABLE IF NOT EXISTS "{md5_table}" (id INTEGER, move TEXT)')
    # Insertion de la ligne contenant le flag
    cursor.execute(f'INSERT INTO "{md5_table}" VALUES (1, "CyberTrace{{Ch3ssm4st3r_0f_Th3_Bl1nd_SQL}}")')
    conn.commit()
    conn.close()

init_db()

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/search', methods=['GET'])
def search():
    move = request.args.get('move', '')
    response = "No results found. Are you worthy of Conane’s legacy?"
    
    try:
        conn = sqlite3.connect('database.db')
        cursor = conn.cursor()
        # Requête vulnérable à l'injection SQL (boolean-based blind SQLi)
        query = f'SELECT * FROM "{md5_table}" WHERE move LIKE "{move}%"'
        cursor.execute(query)
        result = cursor.fetchone()
        if result:
            response = "1 result found. The shadows whisper: 'You’re close...'"
    except Exception as e:
        print(e)
    finally:
        conn.close()
    
    return response

if __name__ == '__main__':
    app.run(debug=True)

import requests
import json
import random
import string
import time

# Función para obtener la definición de una palabra en la API del diccionario
def existe_en_diccionario(palabra):
    url = f"https://dle.rae.es/srv/search?w={palabra}"
    respuesta = requests.get(url)
    
    if respuesta.status_code == 200 and "No encontrado" not in respuesta.text:
        return True
    return False

# Función para generar una palabra aleatoria de 7 caracteres
def generar_palabra():
    letras = string.ascii_lowercase + 'ñ'  # Incluimos la ñ
    return ''.join(random.choice(letras) for i in range(7))

# Diccionario para almacenar las palabras que existen en el diccionario
palabras_validas = {}

# Generar y verificar palabras
for i in range(100):  # Puedes ajustar la cantidad de palabras a generar
    palabra = generar_palabra()
    print(f"Probando palabra: {palabra}")
    
    if existe_en_diccionario(palabra):
        palabras_validas[palabra] = "Existe en el diccionario"
        print(f"¡Palabra válida encontrada!: {palabra}")
    
    # Pausa para evitar sobrecargar el servidor
    time.sleep(1)

# Guardar las palabras válidas en un archivo JSON
with open('palabras_validas.json', 'w', encoding='utf8') as archivo_json:
    json.dump(palabras_validas, archivo_json, ensure_ascii=False, indent=4)

print("Las palabras encontradas han sido guardadas en 'palabras_validas.json'")

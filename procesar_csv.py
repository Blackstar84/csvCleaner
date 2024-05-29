import pandas as pd
import csv
import os
from bs4 import BeautifulSoup
import re

def remove_html_tags(text):
    return BeautifulSoup(text, 'html.parser').get_text()

def process_csv(input_file, output_file):
    rows = []
    with open(input_file, newline='', encoding='utf-8') as csvfile:
        csvreader = csv.reader(csvfile)
        for row in csvreader:
            cleaned_row = [remove_html_tags(cell).replace('\r', ' ').replace('\n', ' ') for cell in row]
            rows.append(cleaned_row)

    with open(output_file, 'w', newline='', encoding='utf-8-sig') as csvfile:
        csvwriter = csv.writer(csvfile)
        csvwriter.writerows(rows)

    print(f"Archivo limpio creado correctamente en: {output_file}")

# Asegúrate de que la carpeta de salida existe
output_dir = 'output'
if not os.path.exists(output_dir):
    os.makedirs(output_dir)

# Nombre del archivo de salida
input_file = 'input/archivo_modificar.csv'  # Actualiza esto con la ruta del archivo CSV de entrada
cleaned_file_name = 'cleaned_archivo_modificado.csv'
output_file = os.path.join(output_dir, cleaned_file_name)

# Procesar el archivo CSV
process_csv(input_file, output_file)


# CSV Cleaner

Este proyecto contiene scripts para limpiar archivos CSV eliminando etiquetas HTML y manejando correctamente los saltos de línea y caracteres especiales. Hay dos implementaciones disponibles: una en Python y otra en PHP con una interfaz web.

## Requisitos

### Python

Asegúrate de tener Python instalado en tu sistema. Este proyecto requiere las siguientes bibliotecas de Python:

- `pandas`
- `beautifulsoup4`

Puedes instalar estas dependencias ejecutando:


pip install pandas beautifulsoup4




### Uso
* Coloca el archivo CSV que deseas limpiar en la carpeta input. Asegúrate de que el nombre del archivo CSV sea archivo_modificar.csv o actualiza el nombre del archivo en el script procesar_csv.py.

* Ejecuta el script procesar_csv.py para limpiar el archivo CSV. El archivo limpio se guardará en la carpeta output con el nombre cleaned_archivo_modificado.csv.

# Ejemplo de comandos:

## Clona este repositorio
git clone https://github.com/tu_usuario/csv-cleaner.git

## Navega al directorio del proyecto
cd csv-cleaner

## Instala las dependencias
pip install pandas beautifulsoup4

## Ejecuta el script de procesamiento
python procesar_csv.py


# PHP

Además, este proyecto incluye un sistema web que hace lo mismo pero en formato web, permitiéndole al usuario elegir el archivo a corregir. Este sistema utiliza el template AdminLTE.

## Requisitos
* Un servidor web (por ejemplo, Apache)

* PHP 7.4 o superior

* Extensiones de PHP: mbstring

## Configuración
* Clona este repositorio en tu servidor web.
* Asegúrate de que las carpetas output e input tengan permisos de escritura.


## Uso
* Navega a index.php en tu navegador web.

* Sube el archivo CSV que deseas limpiar.

* Descarga el archivo limpio desde el enlace proporcionado.
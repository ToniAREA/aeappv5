import pandas as pd
import mysql.connector

# Conecta a la base de datos MySQL
conn = mysql.connector.connect(
    host='tu_host',  # Reemplaza con el host de tu base de datos
    user='tu_usuario',  # Reemplaza con tu usuario de la base de datos
    password='tu_contraseña',  # Reemplaza con tu contraseña de la base de datos
    database='tu_base_de_datos'  # Reemplaza con el nombre de tu base de datos
)
cursor = conn.cursor()

# Carga el archivo Excel
filename = 'RUTA_DEL_ARCHIVO/INFORME_SY.xlsx'  # Reemplaza con la ruta correcta del archivo en tu máquina
df = pd.read_excel(filename, sheet_name='Worksheet')

# Extrae y ordena las familias únicas de la columna 'FAMILIA'
familias = sorted(df['FAMILIA'].dropna().unique())

# Verifica y añade las familias en la base de datos
familias_anadidas = []
for familia in familias:
    cursor.execute('SELECT * FROM categorias WHERE nombre = %s', (familia,))
    if cursor.fetchone() is None:  # Si la familia no existe en la base de datos
        cursor.execute('INSERT INTO categorias (nombre) VALUES (%s)', (familia,))
        conn.commit()
        familias_anadidas.append(familia)

# Cierra la conexión
cursor.close()
conn.close()

# Muestra las familias añadidas
print("Familias añadidas:")
print(familias_anadidas)

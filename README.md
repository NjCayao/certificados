# PERSONAL_Certificados PHP - 8.1
nombre de la base de datos: certificados

acceso al sistema:
correo: admin@admin.com 
contraseña: 1234567

# Proyecto de Certificados

# NO ACTUALIZAR 
1. carpeta public
2. view-  Certificado
3. view - Consulta

20-12-23
- se corrigio la duplicidad del usuario 
- se agrego nueva colunma inst_firma en la BD tabla tm_instructor
- se agrego y corrigio - agregar imagen de firma del instructor por individual 
- se mejoro los estilos del diseño del modulo instructor

21-12-23
- creacion de la columna usu_foto en la BD tabla tm_usuario
- se agrego - agregar foto tamaño carnet por usuario 
- se mejoro los estilos del diseño del modulo usuario

15-05-24

- correcion de modal DetalleCertificado -> modalmantenimiento 
- correcion de controller -> usuario

20-05-2024
- view - certificado mejoramiento de calidad

21-06-2024
- separacion de alumnos y administrador
- creacion de la columna en la base de datos en instructor y director  (visual)

16/06/2025
# solucion de error de guardar usuario agreagr a la base de datos
ALTER TABLE tm_usuario 
MODIFY COLUMN usu_foto VARCHAR(255) DEFAULT NULL;
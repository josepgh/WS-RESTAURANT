rem @ECHO OFF
rem -------------------------------------
rem per executar des d'eclipse:
D:
cd D:\PRJCTS\WS-RESTAURANT\SQL
rem -------------------------------------


for /F "usebackq tokens=1,2 delims==" %%i in (`wmic os get LocalDateTime /VALUE 2^>NUL`) do if '.%%i.'=='.LocalDateTime.' set ldt=%%j
SET ldt=%ldt:~0,4%_%ldt:~4,2%_%ldt:~6,2%-%ldt:~8,2%_%ldt:~10,2%_%ldt:~12,2%

rem =====>>>> IMPORTANT !!!!!! VARIABLE --table per sortida tabulada!!!!!!!!!!!!!!!!!

mariadb --host=localhost --user=root --password=mdb --database=mysql --verbose --table < 10_CREA_restaurantDB.sql > log_10_CREA_restaurantDB_%ldt%.log

pause

rem exit


rem ---------------------------------------------------------------------------------------
rem -------- segons chatgpt en linux és així:
rem #!/bin/bash
rem ------- la comanda mariadb es manté igual
rem mariadb --host=localhost --user=root --password=mdb --database=mysql --verbose --table < 10_CREA_restaurantDB.sql > log_10_CREA_restaurantDB_%ldt%.log
rem read -p "Presiona Enter para continuar..."

rem --- Explicación de cambios:
rem (#!/bin/bash): Indica que el script debe ejecutarse con Bash.
rem read -p: En Linux, no hay pause, así que usamos read -p para esperar la entrada del usuario.
rem Comando de MariaDB: Se mantiene igual porque MariaDB también está disponible en Linux con los mismos parámetros.
rem Para ejecutar el script en Linux:
rem Dale permisos de ejecución:
rem chmod +x script.sh
rem Ejecútalo:
rem ./script.sh
rem ---------------------------------------------------------------------------------------

rem @ECHO OFF
rem -------------------------------------
rem per executar des d'eclipse:
D:
cd D:\PRJCTS\WS-RESTAURANT\SQL
rem -------------------------------------

for /F "usebackq tokens=1,2 delims==" %%i in (`wmic os get LocalDateTime /VALUE 2^>NUL`) do if '.%%i.'=='.LocalDateTime.' set ldt=%%j
SET ldt=%ldt:~0,4%_%ldt:~4,2%_%ldt:~6,2%-%ldt:~8,2%_%ldt:~10,2%_%ldt:~12,2%

mariadb --host=localhost --user=guillem --password=guillem --database=restaurantDB --verbose --table < 30_INSERCIONS_USUARI_guillem.sql > log_30_INSERCIONS_USUARI_guillem_%ldt%.log

pause

REM exit





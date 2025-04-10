rem @ECHO OFF
rem -------------------------------------
rem per executar des d'eclipse:
D:
cd D:\PRJCTS\WS-RESTAURANT\SQL
rem -------------------------------------

for /F "usebackq tokens=1,2 delims==" %%i in (`wmic os get LocalDateTime /VALUE 2^>NUL`) do if '.%%i.'=='.LocalDateTime.' set ldt=%%j
SET ldt=%ldt:~0,4%_%ldt:~4,2%_%ldt:~6,2%-%ldt:~8,2%_%ldt:~10,2%_%ldt:~12,2%

mariadb --host=localhost --user=cuiner1 --password=cuiner1 --database=restaurantdb --verbose --table  < 80_SELECTS_restaurantDB_cuiner.sql > log_80_SELECTS_restaurantDB_cuiner_%ldt%.log

pause

REM exit



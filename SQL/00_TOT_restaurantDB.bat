rem @ECHO OFF
rem -------------------------------------
rem per executar des d'eclipse:
D:
cd D:\PRJCTS\WS-RESTAURANT\SQL
rem -------------------------------------


call 10_CREA_restaurantDB.bat

call 20_INSEREIX_restaurantDB.bat

rem call 30_INSERCIONS_USUARI_guillem.bat

rem call 31_INSERCIONS_USUARI_cambrer1.bat

call 40_SELECTS_restaurantDB.bat

pause

rem exit


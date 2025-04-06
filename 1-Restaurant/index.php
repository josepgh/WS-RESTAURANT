<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<!--     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/estils.css">
    <title>INDEX</title>
</head>

<body>

<?php
//require './personal/personal_gestio.php';
// require '../functions/helpers.php';

// echo "<h1>Bienvenido a Mi Proyecto PHP</h1>";

// require '../includes/footer.php';
?>

<table>
	<thead>
		<tr>
			<th>Accio</th>
			<th>Executar</th>
		</tr>
	</thead>
	<tbody>

         <tr>
            <td> TMP </td>
            <td> 
        		<form action="A_PROVES/passaParam1.php">
<!--         			<input name="mail" value = "" type="hidden" > -->
             		<input type="submit" value="PROVES">
				</form>
            </td>
          </tr>

         <tr>
            <td> GESTIO DE PERSONAL </td>
            <td> 
        		<form action="personal/personal_gestio.php">
        			<input name="mail" value = "" type="hidden" >
             		<input type="submit" value="Gestio de personal">
				</form>
            </td>
          </tr>


         <tr>

         <tr>
            <td>AFEGIR PERSONA</td>
            <td> 
        		<form action="personal/personal_to_insert.php">
            		<input type="submit" value="AFEGIR persona">
				</form>
            </td>
          </tr>
          
         <tr> 
            <td> Plats VIEW (La carta) </td>
            <td> 
        		<form action="plats/plats_view.php">
            		<input type="submit" value="Plats VIEW (La carta)">
				</form>
            </td>
          </tr>
          
         <tr>
            <td> Llistat de plats per categoria SELECT</td>
            <td> 
        		<form action="plats/plats_per_categoria_select.php">
            		<input type="submit" value="Llistar plats per categoria SELECT">
				</form>
            </td>
          </tr>
          

         <tr> 
            <td> Gestionar comandes </td>
            <td> 
        		<form action="comandes/comandes_view.php">
            		<input type="submit" value="Gestionar comandes">
				</form>
            </td>
		</tr>

         <tr> 
            <td> Gestionar reserves </td>
            <td> 
        		<form action="reserves/reserves.php">
            		<input type="submit" value="Gestionar reserves">
				</form>
            </td>
		</tr>
		

         <tr>
            <td> Llistar taules </td>
            <td> 
        		<form action="taules/taules_list.php">
            		<input type="submit" value="Llistar taules">
				</form>
            </td>
          </tr>

         <tr>
            <td> SORTIR </td>
            <td> 
        		<form action="sortir.php" method="post">
            		<input  type="submit" value="Tancar sessio">
				</form>
            </td>
          </tr>

    </tbody>
 </table>   
</body>

</html>








<!--          <tr> -->
<!--             <td> Llistat de plats per categoria INPUT TEXT</td> -->
<!--             <td>  -->
<!--         		<form method="post" action="plats_per_categoria_INPUT_TEXT_1.php"> -->
<!--             		<input type="submit" value="Llistar plats per categoria INPUT TEX(NO PDO)"> -->
<!-- 				</form> -->
<!--             </td> -->

<!--           </tr> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARI SELECT</title>
</head>
    <body>
    	<h1>Consulta PLATS PER CATEGORIA AMB SELECT</h1>
    	
    	<!-- ================= FORMULARI AMB SELECT DROPDOWN ===================== -->
        <!-- https://www.youtube.com/watch?v=LQ8ZDc2JuLw&ab_channel=CodeWithYousaf -->
        
        
    <form action="plats_per_categoria_list.php" method="post">
    
<!--         <label for="name">Name:</label> -->
<!--         <input type="text" name="name" id="name" required> -->
<!--         <br> -->

<!--         <label for="email">Email:</label> -->
<!--         <input type="email" name="email" id="email" required> -->
<!--         <br> 'Entrants', 'Principal', 'Postres', 'Begudes' -->

        <label for="cat">Sel.lecciona la categoria:</label>
        <select id="cat" name="categoria" required>
            <option value="">-- Sel·lecciona --</option>
            <option value="entrants">Entrants</option>
            <option value="principal">Principal</option>
            <option value="postres">Postres</option>
            <option value="begudes">Begudes</option>
        </select>

        <button type="submit">Submit</button>
    </form>
	<br><br>
	
	<form method="post" action="../index.php">
		<input type="submit" value="Tornar enrere">
	</form>


		
    </body>
</html>


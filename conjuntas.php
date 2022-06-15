<?PHP
	$hostname_localhost ="68.70.164.26";
	$database_localhost ="polizona_55";
	$username_localhost ="polizona_55";
	$password_localhost ="Cinco+Cinco=0";
	$json=array();


//realiza conexion
    $conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
        
        if ($conexion) {
            $tabla= $_POST ['tabla'];
            $campo1= $_POST ['campo1'];
	    	$campo2= $_POST ['campo2'];
            
            //Bloquear registros vacios
            if ($_POST["tabla"]!==""){
                //registro a DB
				$consulta="create or replace view conjuntas as (select ".$campo1.", ".$campo2.", count(*)/(select count(*) from ".$tabla.") as conjunta from ".$tabla." where ".$campo1." in(select distinct ".$campo1." from ".$tabla.") and ".$campo2." in(select distinct ".$campo2." from ".$tabla.") group by ".$campo2.", ".$campo1." order by ".$campo1.", ".$campo2.")";
                echo "<b><font size='5' face='tahoma' color='red'>Vista creada con 茅xito!!</font></b>";

            } else {
               echo "<b>Llene los campos requeridos</b><br>";
            }
            $registro=mysqli_query($conexion,$consulta);
                //Confirmacion
               if ($registro) {
		mysqli_close($conexion);
                 echo"";
               }
            else {
               echo "<b><font size='5' face='tahoma' color='red'>error en la creaci贸n de la vista</b></font><br>";
			   echo "$consulta";
            }
        }
        ?>

        <h1>EXPLOTACI脫N DE BASE DE DATOS CON PROBABILIDADES</h1>

        <?PHP
$conexionA = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

	$consultaA="select distinct ".$campo1." from conjuntas;";
		$resultadoA=mysqli_query($conexionA,$consultaA);
		if($conexionA){
            echo '<br> <br>';
            echo '<form action="probabilidades.php" method="post">';
            echo '<fieldset><legend> INGRESA LOS VALORES QUE DESEES PARA CALCULAR TUS PROBABILIDADES </legend><br>';
            echo "<br>";
            echo '<label for="tabla">Tabla: </label>';
            echo '<input type="text" id="tabla" name="tabla" value="'.$tabla.'" readonly><br>';
            echo "<br>";
            echo '<label for="campo1">Campo 1: </label>';
            echo '<input type="text" id="campo1" name="campo1" value="'.$campo1.'" readonly><br>';
            echo "<br>";
            echo '<label for="campo2">Campo 2: </label>';
            echo '<input type="text" id="campo2" name="campo2" value="'.$campo2.'" readonly><br><br>';
            echo "<br>";
			echo '<br><label for="ValueCampo1">Selecciona el valor de '.$campo1.': </label>';
            echo '<select name="ValueCampo1" id="ValueCampo1">';
			
            $aux = 1;
			while($registroA=mysqli_fetch_array($resultadoA)){
				$result[$campo1]=$registroA[$campo1];
				
				$json['Clasificador'][]=$result;
				
				echo '<option value="'.$aux.'">'.$registroA[$campo1]."</option>";
                $aux++;
			}
			
			echo "</select>";
			
			json_encode($json);
			mysqli_close($conexionA);
		}
		else{
			echo "error";
		}

$conexionA = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

    $consultaA="select distinct ".$campo2." from conjuntas;";
		$resultadoA=mysqli_query($conexionA,$consultaA);
		if($conexionA){
			echo '<label for="ValueCampo2">Selecciona el valor de '.$campo2.': </label>';
            echo '<select name="ValueCampo2" id="ValueCampo2">';

            $aux = 1;
			while($registroA=mysqli_fetch_array($resultadoA)){
				$result[$campo2]=$registroA[$campo2];
				
				$json['Clasificador'][]=$result;
				
				echo '<option value="'.$aux.'">'.$registroA[$campo2].'</option>';
                $aux++;
			}
			
			echo "</select>";
			
			json_encode($json);
			mysqli_close($conexionA);
		}
		else{
			echo "error";
		}

		echo "<br><br>";

		echo '<input type="radio" value="conjunta" id="conjunta" name="proba"/>';
        echo '<label for="conjunta">Conjunta</label>';

        echo '<input type="radio" value="bayesiana" id="bayesiana" name="proba" checked/>';
        echo '<label for="bayesiana">Bayesiana</label>';

        echo '<input type="radio" value="condicional" id="condicional" name="proba"/>';
        echo '<label for="condicional">Condicional</label>';

        echo '<br> <br> <input type="submit" value="Enviar"/>';
        
        echo '</form>';

        echo '<br>';
		
	?>

<?PHP
	$hostname_localhost ="68.70.164.26";
	$database_localhost ="polizona_55";
	$username_localhost ="polizona_55";
	$password_localhost ="Cinco+Cinco0";
	$json=array();
        include("conjuntas.php"); 


//realiza conexion
    $conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
        
        if ($conexion) {
            $probabilidad= $_POST ['proba'];
            $campo1= $_POST ['campo1'];
	    	$campo2= $_POST ['campo2'];
            $ValueCampo1= $_POST ['ValueCampo1'];
            $ValueCampo2= $_POST ['ValueCampo2'];
	    	
            
            //Bloquear registros vacios
            if ($_POST["ValueCampo1"]!=="" && $_POST["ValueCampo2"]!=="" && $_POST["proba"]!==""){
                //registro a DB
                if($probabilidad == "bayesiana"){
                    $consulta = "select conjunta/(select sum (conjunta) from conjuntas where ".$campo1."=".$ValueCampo1.")*(select sum(conjunta) from conjuntas where ".$campo1."=".$ValueCampo1.")/(select sum(conjunta) from conjuntas where ".$campo2."=".$ValueCampo2.") as bayesiana from conjuntas where ".$campo1."=".$ValueCampo1." and ".$campo2."=".$ValueCampo2.";";
                    
                    $resultado=mysqli_query($conexion,$consulta);
			        
                    while($registro=mysqli_fetch_array($resultado)){
				    $result["bayesiana"]=$registro['bayesiana'];
				    $json['Clasificador'][]=$result;
				
				    echo "<font color = 'blue' size='4' face='tahoma'><b><br>La probabilidad bayesiana de ".$campo1."=".$ValueCampo1." y ".$campo2."=".$ValueCampo2."=  ".$registro['bayesiana']."</font></b>";
				    echo'<br><form action="explotacion.html">';
                        echo'<br><input type="submit" value="Cambiar de tabla y campos" />';
                    echo'</form>'; 
					}
			        echo"</fieldset>";
                    echo '</body>';
                    echo '</html>';
                }
				else if($probabilidad == "conjunta"){
                    $consulta = "select conjunta from conjuntas where ".$campo1."=".$ValueCampo1." and ".$campo2."=".$ValueCampo2.";";

                    $resultado=mysqli_query($conexion,$consulta);
			        
                    while($registro=mysqli_fetch_array($resultado)){
				    $result["conjunta"]=$registro['conjunta'];
				    $json['Clasificador'][]=$result;
				
				    echo "<font color = 'blue' size='4' face='tahoma'><b><br>La probabilidad conjunta de ".$campo1."=".$ValueCampo1." y ".$campo2."=".$ValueCampo2."= ".$registro['conjunta']."</font> </b>";
                    echo'<br><form action="explotacion.html">';
                        echo'<br><input type="submit" value="Cambiar de tabla y campos" />';
                    echo'</form>';    
					}
                    echo"</fieldset>";
                    echo '</body>';
                    echo '</html>';
                }
                else if($probabilidad == "condicional"){
                    $consulta = "select conjunta/(select sum(conjunta) from conjuntas where ".$campo1."=".$ValueCampo1.") as condicional from conjuntas where ".$campo1."=".$ValueCampo1." and ".$campo2."=".$ValueCampo2.";";

                    $resultado=mysqli_query($conexion,$consulta);
			        
                    while($registro=mysqli_fetch_array($resultado)){
				    $result["condicional"]=$registro['condicional'];
				    $json['Clasificador'][]=$result;
				
				    echo "<font color = 'blue' size='4' face='tahoma'><b><br>La probabilidad condicional de ".$campo1."=".$ValueCampo1." y ".$campo2."=".$ValueCampo2."=  ".$registro['condicional']."</font></b>";
				    echo'<br><form action="explotacion.html">';
                        echo'<br><input type="submit" value="Cambiar de tabla y campos" />';
                    echo'</form>'; 
					}


                    echo"</fieldset>";
                    echo '</body>';
                    echo '</html>';

                }
                else{
                    echo "Algo sali贸 mal";
                }

            } else {
               echo "Llene los campos requeridos <br>";
            }
           
        }

<?php
include('../conecta/prolog.php');
?>
<!DOCTYPE html>
<html lang="en">
<head> <title>Conecta Prolog</title> </head>
<body>
    <h1>conecta con la base de conocimiento por medio de API</h1>
   
    <main class="contenedor separador">
    <div class="pagar">
     <form method="POST" action="inteligencia.php">
        <fieldset class="pago">
        <legend class="titulo titulo-lima">Argumentos</legend>
         <label for="programa" class="programa" id="programa">Escribe la base de conocimiento:</label>
         <textarea name="programa"cols="30" rows="10" class="programa" id="programa" hidden>objeto :- write('{'),aux1, write('}').
aux1 :- read(X),(X='atributo'->atributo;
                 X='fin'->write('')).
atributo :-read(X),write('"'),write(X),write('"'), write(':'),valorobjeto(X),aux2.
valorobjeto(M):-read(Y),(Y='cadena'->cadena;
                 Y='numero'->numero;
                 Y='objeto'->objeto;
                 Y='arreglo'->arreglo;
                 Y='metodo'->metodo(M);
                 Y='true'->verdadero;
                 Y='false'->falso).
aux2 :- read(X),(X='atributo'->write(','),atributo;
                 X='fin'->write('')). 
cadena :- read(X),write('"'),write(X),write('"').
numero :- read(N),write(N).
arreglo :- write('['),aux3,write(']').
aux3 :- read(X),(X='valor'->valorarreglo,aux4;
                 X='fin'->write('')).
aux4 :- read(X),(X='valor'->write(','),valorarreglo,aux4;
                 X='fin'->write('')). 
valorarreglo :-read(Y),(Y='cadena'->cadena;
                 Y='numero'->numero;
                 Y='objeto'->objeto;
                 Y='arreglo'->arreglo;
                 Y='true'->verdadero;
                 Y='false'->falso).
verdadero :- write('true').
falso :- write('false').
metodo(M) :- write('"function() {'),instruccion, write('return '),write(M),write('}"').
instruccion :- read(I),(I='asignacion'->asignacion,instruccion;
                 I='decision' ->decision,instruccion;
                 I='fin'->write('')).
asignacion :- read(X),write(X),write('='),read(Y),write(Y),write(';').
decision :- write('if ('),read(C),write(C),write(') {'),instruccion,write('}'),aux5.
aux5 :- read(X),(X='sino'->write('else {'),instruccion,write('}');
                 X='fin'->write('')).
:- objeto.</textarea>
        <label for="inputArea">Escibir argumentos:</label>
        <textarea name="inputArea" id="inputArea" cols="30" rows="10" class="inputArea" hidden><?php 
	include('integraDatos.php');
	?></textarea>
        <label for="resultSet">Resultado:</label>
        <textarea  cols="1000" id="resultSet" name="resultSet" hidden readonly> <?php 
        if(isset($inputs)){
            echo $response->Result;
}
        ?></textarea>
        <input class='bt bt-azul' type="submit" value="Enviar">
     
        </fieldset>
    </form>
 	<script> const text=document.getElementById("resultSet").value;
	document.write(text);
	</script>
   </div>
</main>
</body>
</html>

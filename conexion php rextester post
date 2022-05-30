<?php
include('../conecta/prolog.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Conecta Prolog</title>
</head>
<body>
    <header class="bg-azul-deg">
    <h1>Martinez Lopez Said - Conecta Prolog</h1>
    </header>
   

    <main class="contenedor separador">
    <div class="pagar">
    <form method="POST" action="newProlog.php">
        <fieldset class="pago">
        <legend class="titulo titulo-lima">Argumentos</legend>
        <label for="programa" class="programa" id="programa">Escribe la base de conocimiento:</label>
        <textarea name="programa"cols="30" rows="10" class="programa" id="programa">atributo:- read(X), write('\"'), write(X), write('\":'),tipoatributo(X). tipoatributo(M):- read(X), (X='metodo'->metodo(M); b1(X)). b1(X):- X='numero'->numero; b2(X). b2(X):- X='cadena'->cadena;write('error'). cadena:- read(X), write('\"'), write(X), write('\",'). numero:-read(X), write(X). metodo(M):- write('\"function() {'),a2,write(' return '), write(M), write(';}\"'). a2:- read(X), (X='decision'->decision;a3(X)). a3(X):- X='asignacion' -> asignacion;(nl,nl,nl,write('ERROR AL INGRESAR: '),write(X),nl,nl,nl). asignacion:- read(X), write(X), write('='), read(Y), write(Y), write(';'). decision:- write('if('),condicion,write(')'), verdadero. condicion:-read(X), write(X). verdadero:- write('{'),a2,write('}'). falso:- write('{'),a2,write('}'). :- atributo.</textarea>
        <label for="inputArea">Escibir argumentos:</label>
        <textarea name="inputArea" id="inputArea" cols="30" rows="10" class="inputArea">a1. metodo. decision. a=b. decision. a=c. asignacion. a. menor.</textarea>
        <label for="resultSet">Resultado:</label>
        <textarea  cols="1000" id="resultSet" name="resultSet"  readonly> <?php 
        if(isset($inputs)){
            echo $response->Result;
        }
        ?></textarea>
        <input class='bt bt-azul' type="submit" value="Enviar">
     
        </fieldset>
    </form>
    </div>
</main>

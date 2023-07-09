<?php

require 'flight/Flight.php';

Flight::register('db','PDO',array('mysql:host=localhost;dbname=api','root',''));


Flight::route('GET /alumnos', function () {
    $sentencia=Flight::db()->prepare("SELECT * FROM `alumnos`");
    $sentencia=execute();
    $sentencia=$sentencia->fetchAll();
    Flight::json($datos);

});

Flight::route('POST /alumnos', function () {
    $nombres=(Flight::request()->data->nombres);
    $apellidos=(Flight::request()->data->apellidos);

    $sql="INSERT INTO alumnos (nombres, apellidos) VALUES(?,?";
    $sentencia=Flight::db()->prepare($sql);
    $sentencia->bindParam(1,$nombres);
    $sentencia->bindParam(2,$apellidos); 
    $sentencia->execute();
    Flight::jsonp(["Alumno agregado"]);
});

Flight::route('DELETE /alumnos', function () {
    $id=(Flight::request()->date->id);
    
    $sql="DELETE FROM alumnos WHERE id=?";
    $sentencia=Flight::db()->prepare($sql);
    $sentencia->bindParam(1,$id);
    $sentencia->execute();

    Flight::jsonp(["Alumno borrado"]);

});
//Actualizar registro
Flight::route('PUT /alumnos', function () {
    $id=(Flight::request()->date->id);
    $nombres=(Flight::request()->data->nombres);
    $apellidos=(Flight::request()->data->apellidos);

    $sql="UPDATE alumnos SET nombres=?, apellidos=? WHERE id=?";
    $sentencia=Flight::db()->prepare($sql);
    
    $sentencia->bindParam(1,$nombres);
    $sentencia->bindParam(2,$apellidos); 
    $sentencia->bindParam(3,$id);

    $sentencia->execute();
    Flight::jsonp(["Alumno modificado"]);


});
//lectura de un registro determinado
Flight::route('GET /alumnos/@id', function () {
    
    $sentencia=Flight::db()->prepare("SELECT * FROM `alumnos` WHERE id=?");
    $sentencia->bindParam(1,$id);

    $sentencia=execute();
    $sentencia=$sentencia->fetchAll();
    Flight::json($datos);
});
Flight::start();



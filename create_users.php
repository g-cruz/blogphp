<?php

require('dbconnection.php');

$mongo = DBConnection::instantiate();
$collection = $mongo->getCollection('users');

$users = array(
                array(  
                        'nombre' => 'Marcela Roldan', 
                        'nombreusuario' => 'marcela', 
                        'password' => md5('marcela123'),
                        'nacimiento'  => new MongoDate(strtotime('30-09-1983 00:00:00')),
                        'tipo' => 'admin',
                        'direccion' => array('ciudad' => 'Alborada', 'provincia' => 'Tarragona')
                    ),
    
                array(  
                        'nombre' => 'Gustavo Cruz', 
                        'nombreusuario' => 'gcruz', 
                        'password' => md5('1117'),
                        'nacimiento'  => new MongoDate(strtotime('30-09-1983 00:00:00')),
                        'tipo' => 'admin',
                        'direccion' => array('ciudad' => 'Alborada', 'provincia' => 'Tarragona')
                    ),
                
                array(  
                        'nombre' => 'Andres Belalcazar', 
                        'nombreusuario' => 'andres', 
                        'password' => md5('andres123'),
                        'nacimiento'  => new MongoDate(strtotime('21-10-1957 00:00:00')),
                        'tipo' => 'user',
                        'direccion' => array('ciudad' => 'Aldera', 'provincia' => 'Murcia')
                    ),
                
                array(  
                        'nombre' => 'Diego Tovar', 
                        'nombreusuario' => 'diego', 
                        'password' => md5('diego123'), 
                        'nacimiento'  => new MongoDate(strtotime('19-05-1957 00:00:00')),
                        'tipo' => 'user',
                        'direccion' => array('ciudad' => 'Monfero', 'provincia' => 'Badajoz')
                    )
        );
        
foreach($users as $user)
{
    try{
        $collection->insert($user);
    } catch (MongoCursorException $e)
    {
        die($e->getMessage());
    }
}

//echo 'Usuarios creados correctamente';
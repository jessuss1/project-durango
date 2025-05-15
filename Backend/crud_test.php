<?php

require_once 'supabase.php';

// echo "Testing CRUD queries </br></br>";

// echo "Create nuevo cliente test</br>";
// $clientes_data = [
//     "nombre" => "efren",
//     "apellido" => "Sanchez",
//     "telefono" => "6691615192",
//     "direccion" => "1 Infinite Loop, Cupertino, CA"
// ];

// $nuevo_cliente = supabaseApiRequest('POST', 'clientes', $clientes_data, true);
// $cliente_id = $nuevo_cliente['id'];
// print_r($nuevo_cliente);
// echo "</br>ID del cliente nuevo: ". $cliente_id ."</br>";

echo "Updating clientes (PATCH)";

$datos_actualizados = [
    "nombre" => "Homer",
    "direccion" => "742 Evergreen Terrace",
    "updated_at" => gmdate('c')

];

$cliente_actualizado = supabaseApiRequest('PATCH', 'clientes?id=eq.6', $datos_actualizados, true);
print_r($cliente_actualizado);
echo "</br>";
<?php
require_once 'supabase.php';

try {
    // Ping the 'dishes' table
    echo "Pinging 'clientes' table...</br>";
    $platillos = supabaseApiRequest('GET', 'clientes?select=*');
    echo "Response from 'clientes': ";
    print_r($platillos);
    echo "</br></br>";

    // // Optional: Ping another table (e.g., 'customers')
    // echo "\nPinging 'customers' table...\n";
    // $customers = supabaseApiRequest('GET', 'customers?select=*');
    // echo "Response from 'customers': ";
    // print_r($customers);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
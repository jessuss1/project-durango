<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables
Dotenv::createImmutable(__DIR__ . '/..')->load();

//Asign .ENV variables for better syntax
$supabaseUrl = $_ENV['SUPABASE_URL']; 
$anonKey = $_ENV['ANON_KEY'];
$serviceKey = $_ENV['SERVICE_ROLE_KEY'];

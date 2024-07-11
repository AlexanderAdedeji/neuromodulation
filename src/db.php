<?php
// Function to load environment variables from .env file
function loadEnv($path) {
    if (!file_exists($path)) {
        throw new Exception('.env file not found');
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $_ENV[$name] = trim($value);
    }
}


loadEnv(__DIR__ . '/../.env');

function getDBConnection() {
    $serverName = $_ENV['DB_SERVER'];
    $connectionOptions = array(
        "Database" => $_ENV['DB_NAME'],
        "Uid" => $_ENV['DB_USER'],
        "PWD" => $_ENV['DB_PASSWORD']
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    return $conn;
}
?>

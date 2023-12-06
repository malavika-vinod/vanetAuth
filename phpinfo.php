<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$result = shell_exec('python3 -c "print(\'Hello from Python\')"');
echo "result: $result";

?>

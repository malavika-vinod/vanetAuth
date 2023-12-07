
<?php
echo '<pre>';
print_r($_ENV);
echo '</pre>';
?>
<?php
$currentPath = getenv('PATH');
$newPath = '/usr/local/bin:' . $currentPath;
putenv("PATH=$newPath");
?>


<?php
include 'db_config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

    $user = 'abc';
    $password = '123';
    $lno='AN23344';
    $vno='TN324';

    // Insert data into the 'users' table
   
        // Registration successful
        $user_id = 2; // Get the last inserted user ID
        #$pythonInterpreter = '/usr/local/bin/python3'
        $pythonScriptPath ="/Applications/XAMPP/xamppfiles/htdocs/UI/generate.py";  // Replace with the actual path
        echo "Python Script Path: $pythonScriptPath<br>";
        $command = "export PYTHONPATH=/Library/Frameworks/Python.framework/Versions/3.10/lib/python3.10 && /Applications/XAMPP/xamppfiles/htdocs/UI/generate.py $pythonScriptPath '$user_id' '$user' '$password' '$lno' '$vno' 2>&1";

        #$command = "python3 $pythonScriptPath '$user_id' '$user' '$password' '$lno' '$vno' 2>&1";
        $result = shell_exec($command);
        echo "Result: $result";


?>

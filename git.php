<?php

echo "salam";
// echo exec("git pull git@github.com:peymanvalikhanli/task_api.git master");

function execPrint($command) {
    $result = array();
    exec($command, $result);
    foreach ($result as $line) {
        print($line . "\n");
    }
}
// Print the exec output inside of a pre element
print("<pre>" . execPrint("git pull") . "</pre>");

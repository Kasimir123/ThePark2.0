<?php

$password = 'alex';

$hash = hash('sha256', $password);

echo $hash;

$pass2 = 'alex';

if (password_verify($pass2, $hash)) {
    echo 'correct';
} else {
    echo 'incorrect';
}


?>

<?php

function debug($x)
{
    echo '<pre>';
    print_r($x);
    echo '</pre>';
}

function validInput($errors, $data, $key, $min, $max)
{
    if(!empty($data)) {
        if (mb_strlen($data) < $min) {
            $errors[$key] = 'Veuillez renseigner minimum ' . $min . ' caractères';
        } elseif (mb_strlen($data) > $max) {
            $errors[$key] = 'Veuillez renseigner maximum ' . $max . ' caractères';
        } 
    } else {
        $errors[$key] = 'Veuillez renseigner ce champ';
    }
    return $errors;
}
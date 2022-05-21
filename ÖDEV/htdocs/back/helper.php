<?php

function createPassword($text){
    return password_hash($text, PASSWORD_BCRYPT);
}

function checkPassword($text, $pw){
    return password_verify($text, $pw);
}
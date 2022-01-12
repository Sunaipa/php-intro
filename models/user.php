<?php

define("USER_PATH", 'data/users.json');

/**
 * Récupération d'une liste d'utilisateur sur un fichier Json
 *
 * @return array
 */
function getUserList(): array {
    $data = file_get_contents(USER_PATH, true);
    return json_decode($data, true);
};

/**
 * Comparer saisie utilisateur avec une userList récupérer par : userList()
 *
 * @param string $login
 * @param string $password
 * @return boolean
 */
function authenticateUser (string $login, string $password): bool {
    $userList = getUserList();
    $user = array_filter($userList, function($item) use ($login, $password) {
        return $item["login"] == $login && $item["password"] == $password;
    });
        return count($user) > 0;
};
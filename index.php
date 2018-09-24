<?php
/**
 * @file    index.php
 * @author  
 * @version 1.0
 * @date    
 * @brief   Page défaut du site 
 * @details Inclus tous les fichiers du MVC via config.php, part une session, définit le fuseau horaire & date/heure et appelle le routeur pour rediriger au bon controlleur
 */

    // Afficher les messages d'erreurs
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Inclusion des fichiers selon le répertoire et déclaration des paramètres de connexion
    require_once("config.php");

    // Départ de la session
    session_start();

    // Déclaration du fuseau horaire et de la date d'aujourd'hui
    date_default_timezone_set("America/New_York"); 
    $now = date("Y-m-d H:i");

    // Redirection au bon controleur
    Routeur::route();
    
   

?>
<?php
/**
 * @file    index.php
 * @author  
 * @version 1.0
 * @date    
 * @brief   Page défaut du site 
 * @details Inclus tous les fichiers du MVC via config.php, part une session, définit le fuseau horaire & date/heure et appelle le routeur pour rediriger au bon controlleur
 */
    
    // Inclusion des fichiers selon le répertoire et déclaration des paramètres de connexion
    require_once("config.php");
    require_once("controleurs/Routeur.php");
    require_once("controleurs/BaseControleur.php");
    require_once("modeles/BaseDao.php");
    require_once("modeles/ManufactureBD.php");
    require_once("controleurs/ControleurJeux.php");
    require_once("modeles/ModeleJeux.php");
    require_once("modeles/Jeux.php");
    
//    require_once("vues/accueil.php");
//    require_once("vues/header.php");
//    require_once("vues/footer.php");
//    require_once("vues/jeux.php");
 
    // Départ de la session
    session_start();

    // Déclaration du fuseau horaire et de la date d'aujourd'hui
    date_default_timezone_set("America/New_York"); 
    $now = date("Y-m-d H:i");

    // Redirection au bon controleur
    Routeur::route();
    
   

?>
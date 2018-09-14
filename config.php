<?php
/**
 * @file    config.php
 * @author  
 * @version 1.0
 * @date    
 * @brief   Définit les constantes et chemins 
 * @details Auto-chargement des classes et des paramètres de connexion à la base de données
 */

    // Déprécié : function __autoload($nomClasse) {
	function autoChargement($nomClasse) {
		
        $repertoires = array(
            RACINE . "controleurs/", 
            RACINE . "modeles/",
            RACINE . "vues/"
        );

		foreach ($repertoires as $rep) {
			$nomFichier = $rep . $nomClasse . ".php";
			if (file_exists($nomFichier)) {
				require_once($nomFichier);
				return;
			}
		}
	}

    spl_autoload_register('autoChargement');


    // Déclaration de la racine du projet

	define("HEBERGEUR", "localhost");
	define("TYPEBD", "mysql");

    define("RACINE", $_SERVER["DOCUMENT_ROOT"] . "/projetweb2/");
    define("NOMBD", "projetweb2");
    define("NOMUSAGER", "root");
    define("MOTDEPASSE", "1234");


?>

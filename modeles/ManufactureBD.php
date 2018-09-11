<?php
/**
 * @file    ManufactureBD.php
 * @author  Oudayan Dutta, Zoraida Ortiz, Denise Ratté, Jorge Subirats 
 * @version 1.0
 * @date    9 février 2018
 * @brief   Manufacture de base de données
 *
 * @details Définit les parmètres requis pour des connexions à différents types de serveurs
 */

	class ManufactureBD {

		public static function chercherBD($typeBD, $nomBD, $hebergeur, $usager, $motDePasse) {
			if ($typeBD == "mysql") {
				$BD = new PDO("mysql:host=$hebergeur;dbname=$nomBD", $usager, $motDePasse);
			}
			else if ($typeBD == "oracle") {
				$BD = new PDO("oci:host=$hebergeur;dbname=$nomBD", $usager, $motDePasse);		
			}
			//else if...
			else
				trigger_error("Le type de base de données spécifié n'est pas supporté.");
			
			$BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$BD->exec("SET NAMES 'utf8'");
			return $BD;	
		}

    }

?>


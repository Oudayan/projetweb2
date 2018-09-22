<?php
/**
 * @file    Routeur.php
 * @author  
 * @version 1.0
 * @date    
 * @brief   Route vers le bon controlleur 
 * @details Route toute les requêtes URL (query string) au bon controleur 
 */

	class Routeur {
        
        /**
         * @brief   Méthode qui sera appelée pour donner la route vers les controleurs ou utilisera le contrôleur par default
         * @details Méthode static pour déclarer le controleur et si aucun n'a été spécifié il en donne un par defaut.
         * @details Signale si le controleur est invalide ou s'il n'existe pas. 
		 * @param   [string]  $chaineRequete    	
		 * @param   [string]  $esperluette 
		 * @param   [string]  $controleur
		 * @param   [string]  $objectControleur		 
         * @return  le no du contrôleur
         */
		public static function route() {
			//obtenir le controleur qui devra traiter la requête.
			$chaineRequete = $_SERVER["QUERY_STRING"];
			$esperluette = strpos($chaineRequete, "&");

			if ($esperluette === FALSE) {
				$controleur = $chaineRequete;
            }
			else {
				$controleur = substr($chaineRequete, 0, $esperluette);
            }

			// Si aucun controleur n'a été spécifié, mettre un controleur par défaut
			if ($controleur == "") {
				$controleur = "Recherches";
            }
			// Chercher la classe avec le nom du controleur
			$class = "Controleur" . $controleur ;
			if (class_exists($class)) {
				// Déclaration du controleur
				$objectControleur = new $class;
				if ($objectControleur instanceof BaseControleur) {
					$objectControleur->index($_REQUEST);
                }
				else {
					trigger_error("Controleur invalide.");
                }
			}
			else {
				trigger_error("Erreur 404! Le controleur $class n'existe pas.");
			}
		}

	}

?>

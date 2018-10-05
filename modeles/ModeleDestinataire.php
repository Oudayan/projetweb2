<?php
<<<<<<< HEAD

=======
>>>>>>> 09be3cd7f5917a735cf596d10531471c2204dfa6
/**
 * @file     ModeleDestinataire.php
 * @author   Jansy Lopez
 * @version  1.0
 * @date     
 * @brief    Modèle Destinataire
 *
 * @details  Fonctions "CRUD" pour la table  
 */
<<<<<<< HEAD
class ModeleDestinataire extends BaseDAO {

    // Déclaration du nom de la table (fonction abstraite)
    public function lireNomTable() {
        return "destinataire";
    }

    public function lireDestinataireParId($id) {
        $resultat = $this->lire($id);
        $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Destinataire');
        return $resultat->fetch();
    }

    public function lireToutesDestinataire() {
        $resultat = $this->lireTous();
        return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Destinataire');
    }

    public function sauvegarde(Destinataire $unDestinataire) {
//        var_dump($unMessage);
        $sql = "INSERT INTO " . $this->lireNomTable() . "( membre_id ,msg_id) VALUES ( ?, ?)";
        $donnees = array(
            $unDestinataire->getMembre_Id(),
            $unDestinataire->getMsg_Id());
        return $this->requete($sql, $donnees);
    }

}
=======

	class ModeleDestinataire extends BaseDAO {

        // Déclaration du nom de la table (fonction abstraite)
		public function lireNomTable() {
			return "destinataire";
        }
               
        public function lireDestinataireParId($id) {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Destinataire');
            return $resultat->fetch();
        }

        public function lireToutesDestinataire() {
            $resultat = $this->lireTous();
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Destinataire');
        }


        
    }
>>>>>>> 09be3cd7f5917a735cf596d10531471c2204dfa6

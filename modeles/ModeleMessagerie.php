<?php
/**
 * @file      ModeleMessagerie.php
 * @author    Jansy Lopez, Oudayan Dutta
 * @date      Septembre 2018
 * @brief     Définit la classe ModeleMessagerie
 * @details   Cette classe définit les attributs qu'on a besion pour tout ce qui corcerne aux messages envoyes dans le site
 */

    class ModeleMessagerie extends BaseDAO {

        /**
         * @brief   Méthode pour aller chercher une message dans une table
         * @details Cette méthode va chercher une message dans une table dans la BD
         * @return  [string]
         */
        public function lireNomTable() {
            return "`messagerie`";
        }

        /**
         * @brief   Méthode pour aller chercher un message
         * @details Méthode qui permet d'aller chercher un message en utilisant son message_id
         * @param   [numeric] $message_id
         * @return  [object]
         */
        public function obtenirParId($message_id) {
            $resultat = $this->lire($message_id);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Messagerie');
            $message = $resultat->fetch();
            return $message;
        }

        /**
         * @brief   Méthode pour aller chercher un mesaage pour le sujet
         * @details Méthode que permets aller chercher un message en utilisant son sujet
         * @param   [string] $sujet
         * @return  [object]
         */
        public function obtenirParSujet($sujet) {
            $resultat = $this->lire($sujet,'sujet');
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Messagerie');
            $message = $resultat->fetch();
            return $message;
        }


        /**
         * @brief   Méthode pour aller chercher un mesaage
         * @details Méthode que permets aller chercher un message en utilisant son msg_id
         * @param   [string] $msg_id
         * @return  [object]
         */
        public function obtenirParMsgId($msg_id) {
            $resultat = $this->lire($msg_id,'msg_id');
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Messagerie');
            $message = $resultat->fetch();
            return $message;
        }

        /**
         * @brief   Méthode pour obtenir tous les messages dans la BD
         * @details Méthode qui obtiens tous les informations enregistrées dans la BD de tous les messages
         * @return  [array of objects]
         */
        public function obtenirTousEnvoyeParMembreId($membre_id) {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE membre_id = " . $membre_id . " ORDER BY msg_date DESC";
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Messagerie");
        }

        /**
         * @brief   Méthode pour obtenir tous les messages dans la BD
         * @details Méthode qui obtiens tous les informations enregistrées dans la BD de tous les messages
         * @return  [array of objects]
         */
        public function obtenirTousRecuParMembreId($membre_id) {
            $sql = "SELECT m.msg_id, m.membre_id, m.sujet, m.message, m.attachement, m.msg_date, m.msg_envoye, m.msg_lu, m.msg_actif FROM " . $this->lireNomTable() . 
                    " m INNER JOIN destinataire d ON d.msg_id = m.msg_id ".
                    " WHERE d.membre_id = " . $membre_id . " ORDER BY msg_date DESC";
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Messagerie");
        }

        /**
         * @brief   Méthode pour enregistrer ou modifier un message dans la BD
         * @details Insérer ou modifier les informations d'un message dans la BD
         * @param   [numeric] $msg_id
         * @param   [numeric] $membre_id
         * @param   [string] $sujet
         * @param   [string] $message
         * @param   [string] $msg_date
         * @param   [boolean] $msg_envoye
         * @param   [boolean] $msg_lu
         * @param   [boolean] $msg_actif
         * @return  [numeric] Dernier msg_id inséré
         */
        public function sauvegarde(Messagerie $message) {
            $donnees = array(
                $message->getMembreId(),
                $message->getSujet(),
                $message->getMessage(),
                $message->getAttachement(),
                $message->getMsgDate(),
                $message->getMsgEnvoye(),
                $message->getMsgLu(),
                $message->getMsgActif(),
                $message->getMsgId(),
            );
            if ($message->getMsgId() && $this->lire($message->getMsgId())->fetch()) {
                $sql = "UPDATE " . $this->lireNomTable() . " SET membre_id=?, sujet=?, message=?, attachement=?, msg_date=?, msg_envoye=?, msg_lu=?, msg_actif=? WHERE msg_id=?"; 
            } else {
                $id = array_pop($donnees);
                $sql = "INSERT INTO " . $this->lireNomTable() . " (membre_id, sujet, message, attachement, msg_date, msg_envoye, msg_lu, msg_actif) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            }
            $this->requete($sql, $donnees);
            return $message->getMsgId() > 0 ? $message->getMsgId() : $this->bd->lastInsertId();

            return $this->requete($sql, $donnees);
        }

    }

?>

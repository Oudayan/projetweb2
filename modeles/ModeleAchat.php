<?php
/**
 * @file    ModeleAchat.php
 * @author  Jansy Lopez, Oudayan Dutta
 * @date    Septembre 2018
 * @brief   Définit la classe ModeleAchat
 * @details Méthodes "CRUD" pour la table achat 
 */

    class ModeleAchat extends BaseDAO {

        /**
         * @brief   Méthode qui déclare le nom de la table dans la BD
         * @return  [string]
         */
        public function lireNomTable() {
            return "`achat`";
        }

        /**
         * @brief   Méthode pour aller chercher tous les achats
         * @param   [numeric] $ordre, l'ordre des données : ASC ou DESC
         * @param   [string] $champ, le champ à trier dans la BD table achat
         * @param   [string] $limit, l'index et le nombre d'entrées à extraire
         * @return  [array of Achat objects]
         */
        public function lireTousLesAchats($ordre = 1, $champ = NULL, $limit = "0, 9999999999999999") {
            if (isset($champ)) {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $champ, $limit);
            }
            else {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $this->lireClePrimaire(), $limit);
            }
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Achat");
        }

        /**
         * @brief   Méthode pour aller chercher le nombre d'achats
         * @param   [string] $filtre, le filtre à passer dans le WHERE de la requête
         * @return  [array]
         */
        public function obtenirNbAchats($filtre = "achat_id > 0") {
            $sql = "SELECT COUNT(achat_id) AS nb_achats FROM " . $this->lireNomTable() . " WHERE " . $filtre;
            $resultat = $this->requete($sql);
            return $resultat->fetch();
        }		

        /**
         * @brief   Méthode pour aller chercher un achat par son id
         * @param   [numeric] $achat_id, l'id de l'achat
         * @return  [object]
         */
        public function lireAchatParId($achat_id) {
            $resultat = $this->lire($achat_id);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Achat');
            return $resultat->fetch();
        }

        /**
         * @brief   Méthode pour aller chercher tous les achats d'un jeu
         * @param   [numeric] $jeux_id, l'id du jeu
         * @return  [array of Achat objects]
         */
        public function lireAchatsParJeuxId($jeux_id) {
            $resultat = $this->lire($jeux_id,'jeux_id');
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Achat");
        }

        /**
         * @brief   Méthode pour obtenir tous les achats d'un membre dans la BD
         * @param   [numeric] $membre_id, l'id du membre 
         * @return  [array of Achat objects]
         */
        public function lireAchatsParMembreId($membre_id) {
            $resultat = $this->lire($membre_id,'membre_id');
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Achat");
        }

        /**
         * @brief   Méthode pour enregistrer un nouveau membre dans la bd
         * @details Recueillir les informations insérées et les enregistrer dans la BD
         * @param   [numeric] $achat_id
         * @param   [numeric] $type_paiement_id
         * @param   [numeric] $membre_id
         * @param   [numeric] $jeux_id
         * @param   [string] $date_achat
         * @param   [numeric] $prix_achat
         * @param   [string] $transaction_id
         * @param   [numeric] $achat_actif
         * @return  [array]
         */
        public function sauvegarde(Achat $achat) {
            $donnees = array(
                $achat->getTypePaiementId(),
                $achat->getMembreId(),
                $achat->getJeuxId(),
                $achat->getDateAchat(),
                $achat->getPrixAchat(),
                $achat->getTransactionId(),
                $achat->getAchatActif(),
                $achat->getAchatId()
            );
            if ($achat->getAchatId() && $this->lire($achat->getAchatId())->fetch()) {
                $sql = "UPDATE " . $this->lireNomTable() . " SET type_paiement_id=?, membre_id=?, jeux_id=?, date_achat=?, prix_achat=?, transaction_id=?, achat_actif=? WHERE achat_id=?"; 
            } else {
                $id = array_pop($donnees);
                $sql = "INSERT INTO " . $this->lireNomTable() . " (type_paiement_id, membre_id, jeux_id, date_achat, prix_achat, transaction_id, achat_actif) VALUES (?, ?, ?, ?, ?, ?, ?)";
            }
            $this->requete($sql, $donnees);
            return $achat->getAchatId() > 0 ? $achat->getAchatId() : $this->bd->lastInsertId();
        }

        /**
         * @brief   Méthode pour effacer un achat par son id
         * @param   [numeric] $achat_id, l'id de l'achat
         */
        public function effacerAchat($achat_id) {
            return $this->effacer($achat_id);
        }

        /**
         * @brief   Méthode pour désactiver un achat par son id
         * @param   [numeric] $achat_id, l'id de l'achat
         */
        public function desactiverAchat($achat_id) {
            return $this->modifierChamp($achat_id, "achat_actif", 0);
        }

        /**
         * @brief   Méthode pour activer un achat par son id
         * @param   [numeric] $achat_id, l'id de l'achat
         */
        public function activerAchat($achat_id) {
            return $this->modifierChamp($achat_id, "achat_actif", 1);
        }

    }

?>

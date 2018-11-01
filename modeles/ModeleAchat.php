<?php
/**
 * @file      ModeleAchat.php
 * @author    Jansy Lopez
 * @date      Septembre 2018
 * @brief     Définit la classe ModeleAchat
 *
 * @details   Cette classe définit les attributs qu'on a besion pour tout ce qui corcerne pour une achat effectué
 */


class ModeleAchat extends BaseDAO {

    /**
     * @brief   Méthode pour aller chercher une message dans une table
     * @details Cette méthode va chercher une message dans une table dans la BD
     * @return  [string]
     */
    public function lireNomTable() {
        return "`achat`";
    }


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
     * @brief   Méthode pour aller chercher un mesaage pour le achat
     * @details Méthode que permets aller chercher un message en utilisant son achat_id
     * @param   [string] $achat_id
     * @return  [array]
     */
    public function lireAchatParId($achat_id) {
        $resultat = $this->lire($achat_id);
        $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Achat');
        $unAchat = $resultat->fetch();
        return $unAchat;
    }

    public function obtenirNbAchats($filtre = "achat_id > 0") {
        $sql = "SELECT COUNT(achat_id) AS nb_achats FROM " . $this->lireNomTable() . " WHERE " . $filtre;
        $resultat = $this->requete($sql);
        return $resultat->fetch();
    }		

     /**
     * @brief   Méthode pour aller chercher un achat
     * @details Méthode que permets aller chercher un message en utilisant son jeux_id
     * @param   [string] $jeux_id
     * @return  [array]
     */
    public function obtenirParJeuxId($jeux_id) {
        $resultat = $this->lire($jeux_id,'jeux_id');
        $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Achat');
        $unAchat = $resultat->fetch();
        return $unAchat;
    }

    /**
     * @brief   Méthode pour obtenir tous les messages dans la BD
     * @details Méthode qui obtiens tous les informations enregistrées dans la BD de tous les messages
     */
    public function obtenirTousParMembre_Id($membre_id) {
        $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE membre_id = " . $membre_id . " ORDER BY msg_date DESC";
        $resultat = $this->requete($sql);
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
            $achat->getTransactionId(),
            $achat->getAchatActif(),
            $achat->getAchatId()
        );
        if ($achat->getAchatId() && $this->lire($achat->getAchatId())->fetch()) {
            $sql = "UPDATE " . $this->lireNomTable() . " SET type_paiement_id=?, membre_id=?, jeux_id=?, date_achat=?, transaction_id=?, achat_actif=? WHERE achat_id=?"; 
        } else {
            $id = array_pop($donnees);
            $sql = "INSERT INTO " . $this->lireNomTable() . " (type_paiement_id, membre_id, jeux_id, date_achat, transaction_id, achat_actif) VALUES (?, ?, ?, ?, ?, ?)";
        }
        $this->requete($sql, $donnees);
        return $achat->getAchatId() > 0 ? $achat->getAchatId() : $this->bd->lastInsertId();
    }

    public function effacerAchat($id) {
        return $this->effacer($id);
    }

    public function desactiverAchat($id) {
        return $this->modifierChamp($id, "achat_actif", 0);
    }

    public function activerAchat($id) {
        return $this->modifierChamp($id, "achat_actif", 1);
    }

}
?>

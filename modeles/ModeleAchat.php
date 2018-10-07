<?php
/**
 * @file      ModeleAchat.php
 * @author    Jansy Lopez
 * @date      Septembre 2018
 * @brief     Définit la classe ModeleAchat
 *
 * @details   Cette classe définit les attributs qu'on a besion pour tout ce qui corcerne pour une achat effectué
 */


class ModeleAchat extends BaseDAO
{
    /**
     * @brief   Méthode pour aller chercher une message dans une table
     * @details Cette méthode va chercher une message dans une table dans la BD
     * @return  [string]
     */

    public function lireNomTable()
    {
        return "achat";
    }

    /**
     * @brief   Méthode pour aller chercher un membre
     * @details Méthode que permets aller chercher un message en utilisant son membre_id
     * @param   [numeric] $membre_id
     * @return  [array]
     */

    public function obtenirParId($membre_id)
    {
        $resultat = $this->lire($membre_id);
        $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Achat');
        $unAchat = $resultat->fetch();
        return $unAchat;
    }


    /**
     * @brief   Méthode pour aller chercher un mesaage pour le achat
     * @details Méthode que permets aller chercher un message en utilisant son achat_id
     * @param   [string] $achat_id
     * @return  [array]
     */

    public function obtenirParAchatId($achat_id)
    {
        $resultat = $this->lire($achat_id,'achat_id');
        $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Achat');
        $unAchat = $resultat->fetch();
        return $unAchat;
    }


     /**
     * @brief   Méthode pour aller chercher un achat
     * @details Méthode que permets aller chercher un message en utilisant son jeux_id
     * @param   [string] $jeux_id
     * @return  [array]
     */

    public function obtenirParJeuxId($jeux_id)
    {
        $resultat = $this->lire($jeux_id,'jeux_id');
        $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Achat');
        $unAchat = $resultat->fetch();
        return $unAchat;
    }

    /**
     * @brief   Méthode pour obtenir tous les messages dans la BD
     * @details Méthode qui obtiens tous les informations enregistrées dans la BD de tous les messages
     */

    public function obtenirTousParMembre_Id($membre_id)
    {
        $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE membre_id = " . $membre_id . " ORDER BY msg_date DESC";
        $resultat = $this->requete($sql);
        return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Achat");
    }



    /**
     * @brief   Méthode pour enregistrer un nouveau membre dans la bd
     * @details Recueillir les informations insérées et les enregistrer dans la BD
     * @param   [numeric] $achat_id
     * @param   [numeric] $type_paiement_id
     * @param   [string] $membre_id
     * @param   [string] $jeux_id
     * @param   [string] $date_achat
     * @param   [string] $transaction_id
     * @return  [array]
     */

    public function sauvegarde(Achat $unAchat)
    {

        $sql = "INSERT INTO " . $this->lireNomTable() . "( achat_id, type_paiement_id, membre_id, jeux_id, date_achat, transaction_id) VALUES (?, ?, ?, ?, ?, ?)";
        $donnees = array(
            $unAchat->getAchatId(),
            $unAchat->getTypePaiementId(),
            $unAchat->getMembreId(),
            $unAchat->getJeuxId(),
            $unAchat->getDateAchat(),
            $unAchat->getTransactionId());
        return $this->requete($sql, $donnees);
    }

}
?>

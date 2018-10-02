<?php
/**
 * @file      ModeleMessagerie.php
 * @author    Jansy Lopez
 * @date      Septembre 2018
 * @brief     Définit la classe ModeleMessagerie
 *
 * @details   Cette classe définit les attributs qu'on a besion pour tout ce qui corcerne aux messages envoyes dans le site
 */


class ModeleMessagerie extends BaseDAO
{
    /**
     * @brief   Méthode pour aller chercher une message dans une table
     * @details Cette méthode va chercher une message dans une table dans la BD
     * @return  [string]
     */

    public function lireNomTable()
    {
        return "messagerie";
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
        $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Messagerie');
        $unMembre = $resultat->fetch();
        return $unMembre;
    }


    /**
     * @brief   Méthode pour aller chercher un mesaage pour le sujet
     * @details Méthode que permets aller chercher un message en utilisant son sujet
     * @param   [string] $sujet
     * @return  [array]
     */

    public function obtenirParSujet($sujet)
    {
        $resultat = $this->lire($sujet,'sujet');
        $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Messagerie');
        $unMessage = $resultat->fetch();
        return $unMessage;
    }

   
     /**
     * @brief   Méthode pour aller chercher un mesaage
     * @details Méthode que permets aller chercher un message en utilisant son msg_id
     * @param   [string] $msg_id
     * @return  [array]
     */

    public function obtenirParMsg_Id($msg_id)
    {
        $resultat = $this->lire($msg_id,'msg_id');
        $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Messagerie');
        $unMessage = $resultat->fetch();
        return $unMessage;
    }

    /**
     * @brief   Méthode pour obtenir tous les messages dans la BD
     * @details Méthode qui obtiens tous les informations enregistrées dans la BD de tous les messages
     */

    public function obtenirTousParMembre_Id($membre_id)
    {
        $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE membre_id = " . $membre_id . " ORDER BY msg_date DESC";
        $resultat = $this->requete($sql);
        //$resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Messagerie');
        //return $resultat->fetchAll();
        //var_dump($resultat);
        return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Messagerie");
    }



    /**
     * @brief   Méthode pour enregistrer un nouveau membre dans la bd
     * @details Recueillir les informations insérées et les enregistrer dans la BD
     * @param   [numeric] $msg_id
     * @param   [numeric] $membre_id
     * @param   [string] $sujet
     * @param   [string] $message
     * @param   [string] $msg_date
     * @param   [string] $msg_actif
     * @return  [array]
     */

    public function sauvegarde(Message $unMessage)
    {
//        var_dump($unMessage);
        $sql = "INSERT INTO " . $this->lireNomTable() . "( msg_id, membre_id, sujet, message, msg_date, msg_actif, telephone, courriel) VALUES (?,?,?, ?, ?, ?, ?, ?)";
        $donnees = array(
            $unMessage->getMsg_Id(),
            $unMessage->getMembre_Id(),
            $unMessage->getSujet(),
            $unMessage->getMessage(),
            $unMessage->getMsg_Date(),
            $unMessage->getMsg_Actif());
        return $this->requete($sql, $donnees);
    }
 
}
?>
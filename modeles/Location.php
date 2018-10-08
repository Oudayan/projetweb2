<?php

/**
 * @file    Location.php
 * @author  Chunliang
 * @version 1.0
 * @date
 * @brief   Définit la classe Location.
 *
 * @details Cette classe définit les attributs privés d'une location avec toutes les méthodes publiques "getters" et "setters" pour écrire et get les attributs
 */
class Location
{

    // Attributs
    private $location_id;
    private $type_paiement_id;
    private $membre_id;
    private $jeux_id;
    private $date_debut;
    private $date_retour;


    // Constructeur
    public function __construct($location_id = null, $type_paiement_id = "", $membre_id = "", $jeux_id = "", $date_debut = "", $date_retour = "")
    {

        $this->setLocationId($location_id);
        $this->setJeuxId($jeux_id);
        $this->setTypePaiementId($type_paiement_id);
        $this->setMembreId($membre_id);
        $this->setDateDebut($date_debut);
        $this->setDateRetour($date_retour);
    }

    // "SETTERS"

    /**
     * @brief      Permet de définir en ecriture l'attribut de la classe Location
     * @param      [numeric]  $location_id  numéro d'identifiant de la location
     * @return     [object]
     */
    public function setLocationId($location_id)
    {
        if (is_numeric($location_id) && trim($location_id) != "") {
            $this->location_id = $location_id;
        }
    }

    /**
     * @brief      Permet de définir en ecriture l'attribut de la classe Location
     * @param      [numeric]  $jeux_id  numéro d'identifiant du jeux
     * @return     [object]
     */
    public function setJeuxId($jeux_id)
    {
        if (is_numeric($jeux_id) && trim($jeux_id) != "") {
            $this->jeux_id = $jeux_id;
        }
    }

    /**
     * @brief       Permet de définir en écriture l'attribut de la classe Location
     *
     * @param       [numeric] $type_paiement_id , l'id du type du paiement
     * @return      [object]
     */
    public function setTypePaiementId($type_paiement_id)
    {
        if (is_string($type_paiement_id) && trim($type_paiement_id) != "") {
            $this->type_paiement_id = $type_paiement_id;
        }
    }

    /**
     * @brief      Permet de définir en ecriture l'attribut de la classe Destinataire
     * @param      [string]  $membre_id     identifiant du locataire
     * @return     [object]
     */
    public function setMembreId($membre_id)
    {
        if (is_string($membre_id) && trim($membre_id) != "") {
            $this->membre_id = $membre_id;
        }
    }

    /**
     * @brief      Permet de définir en ecriture l'attribut de la classe Destinataire
     * @param      [string]  $date_debut     identifiant de la date de début de la location
     * @return     [object]
     */
    public function setDateDebut($date_debut)
    {
        if (is_string($date_debut) && trim($date_debut) != "") {
            $this->date_debut = $date_debut;
        }
    }

    /**
     * @brief      Permet de définir en ecriture l'attribut de la classe Destinataire
     * @param      [string]  $date_retour     identifiant de la date de fin de la location
     * @return     [object]
     */
    public function setDateRetour($date_retour)
    {
        if (is_string($date_retour) && trim($date_retour) != "") {
            $this->date_retour = $date_retour;
        }
    }


// "GETTERS"-----------------------------------------------------------------------

    /**
     * @brief      Permet de définir en lecture l'attribut de la classe Location
     * @param      [numeric]  $location_id  numéro d'identifiant de la location
     * @return     [object]
     */
    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * @brief      Permet de définir en lecture l'attribut de la classe Location
     * @param      [numeric]  $jeux_id  numéro d'identifiant du jeux
     * @return     [object]
     */
    public function getJeuxId()
    {
        return $this->jeux_id;
    }


    /**
     * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
     * @param      [string]  $membre_id     identifiant du locataire
     * @return     [object]
     */
    public function getMembreId()
    {
        return $this->membre_id;
    }

    /**
     * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
     * @param      [string]  $membre_id     identifiant du locataire
     * @return     [object]
     */
    public function getTypePaiementId()
    {
        return $this->type_paiement_id;
    }

    /**
     * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
     * @param      [string]  $date_debut     identifiant de la date de début de la location
     * @return     [object]
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
     * @param      [string]  $date_retour     identifiant de la date de fin de la location
     * @return     [object]
     */
    public function getDateRetour()
    {
        return $this->date_retour;
    }
}

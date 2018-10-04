<?php
/**
 * @file    Messagerie.php
 * @author  Jansy Lopez
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Messagerie
 * @details Cette classe définit les attributs d'un message
 */

class Messagerie
{

    //Atributs
    private $msg_id;
    private $membre_id;
    private $sujet;
    private $message;
    private $msg_date;
    private $msg_actif;

   //  msg_id	membre_id	sujet	message	msg_date	msg_actif

    // Constructeur

    public function __construct($msg_id = "", $membre_id = "", $sujet = "", $message = "", $msg_date = "", $msg_actif = true)
    {
        $this->setMsg_Id($msg_id);
        $this->setMembre_Id($membre_id);
        $this->setSujet($sujet);
        $this->setMessage($message);
        $this->setMsg_Date($msg_date);
        $this->setMsg_Actif($msg_actif);

    }

    //SETTERS

    /**
     * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
     *
     * @param       [numeric] $msg_id ,  l'id d'un message
     * @return      [object]
     */
    public function setMsg_Id($msg_id)
    {
        if (is_numeric($msg_id) && trim($msg_id) != "") {
            $this->msg_id = $msg_id;
        }
    }

    /**
     * @brief       Permet de définir en écriture l'attribut de la classe  Messagerie
     *
     * @param       [numeric] $membre_id , l'id du type d'utilisateur qui envoy un message
     * @return      [object]
     */
    public function setMembre_Id($membre_id)
    {
        if (is_numeric($membre_id) && trim($membre_id) != "") {
            $this->membre_id = $membre_id;
        }
    }

    /**
     * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
     *
     * @param       [string] $sujet , le sujet d'un message
     * @return      [object]
     */
    public function setSujet($sujet)
    {
        if (is_string($sujet) && trim($sujet) != "") {
            $this->sujet = $sujet;
        }
    }

    /**
     * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
     *
     * @param       [string] $message , le corp deçu message
     * @return      [object]
     */
    public function setMessage($message)
    {
        if (is_string($message) && trim($message) != "") {
            $this->message = $message;
        }
    }


/*****INSERT dans la b-*      ase de donnes les messages*/


    /**
     * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
     *
     * @param       [string] $msg_date , la date de un message
     * @return      [object]
     */
    public function setMsg_Date($msg_date)
    {
        if (is_string($msg_date) && trim($msg_date) != "") {
            $this->msg_date = $msg_date;
        }
    }

    /**
     * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
     *
     * @param       [string] $msg_actif, si le message etre ou pas actif
     * @return      [object]
     */
    public function setMsg_Actif($msg_actif)
    {
        if (is_bool($msg_actif) && trim($msg_actif) != "") {
            $this->msg_actif = $msg_actif;
        }
    }

    // GETTERS

    /**
     * @brief       Permet de définir en lecture l'attribut de la classe Messagerie
     *
     * @param       [numeric] $msg_id ,  l'id d'un message
     * @return      [object]
     */

    public function getMsg_Id()
    {
        return $this->msg_id;
    }

    /**
     * @brief       Permet de définir en lecture l'attribut de la classe Membres
     *
     * @param       [numeric] $membre_id ,  l'id de le type de utilisateur
     * @return      [object]
     */

    public function getMembre_Id()
    {
        return $this->membre_id;
    }

    /**
     * @brief       Permet de définir en lecture l'attribut de la classe Membres
     *
     * @param       [string] $sujet, le sujet d'un membre
     * @return      [object]
     */

    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @brief       Permet de définir en lecture l'attribut de la classe Membres
     *
     * @param       [string] $message, le corp du message
     * @return      [object]
     */

    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @brief       Permet de définir en lecture l'attribut de la classe Membres
     *
     * @param       [string] $msg_date, la date du message
     * @return      [object]
     */

    public function getMsg_Date()
    {
        return $this->msg_date;
    }

    /**
     * @brief       Permet de définir en lecture l'attribut de la classe Membres
     *
     * @param       [string] $msg_actif, montre si le message etre actif ou pas
     * @return      [object]
     */

    public function getMsg_Actif()
    {
        return $this->msg_actif;
    }

}

<?php
/**
 * @file      ModeleMembres.php
 * @author    Marcelo Guzmán, Chunliang
 * @date      Septembre 2018
 * @brief     Définit la classe ModeleMembres
 *
 * @details   Cette classe définit les attributs qu'on a besion pour tout ce qui corcerne aux membres inscrits sur le site
 */


class ModeleMembres extends BaseDAO
{
    /**
     * @brief   Méthode pour aller chercher le nom d'une table
     * @details Cette méthode va chercher le nom de d'une table dans la BD
     * @return  [string]
     */

    public function lireNomTable()
    {
        return "membre";
    }

    /**
     * @brief   Méthode pour aller chercher un membre
     * @details Méthode que permets aller chercher l'information de un membre en utilisant son id
     * @param   [numeric] $membre_id
     * @return  [array]
     */

    public function obtenirParId($membre_id)
    {
        $resultat = $this->lire($membre_id);
        $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Membres');
        return $resultat->fetch();
    }


    /**
     * @brief   Méthode pour aller chercher un membre
     * @details Méthode que permets aller chercher l'information de un membre en utilisant son courriel
     * @param   [string] $courriel
     * @return  [array]
     */

    public function obtenirParCourriel($courriel)
    {
        $resultat = $this->lire($courriel,'courriel');
        $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Membres');
        return $resultat->fetch();
    }

    /**
     * @brief   Méthode pour obtenir tous les memebres dans la BD
     * @details Méthode qui obtiens tous les informations enregistrées dans la BD de tous les membres
     * @return  [array]
     */

    public function obtenirTous()
    {
        $resultat = $this->lireTous("DESC");
        return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Membres");
    }

    /**
     * @brief   Méthode pour enregistrer un nouveau membre dans la bd
     * @details Recueillir les informations insérées et les enregistrer dans la BD
     * @param   [numeric] $membre_id
     * @param   [numeric] $type_utilisateur_id
     * @param   [string] $nom
     * @param   [string] $prenom
     * @param   [string] $mot_de_passe
     * @param   [string] $adresse
     * @param   [string] $telephone
     * @param   [string] $courriel
     * @return  [array]
     */

    public function sauvegarde(Membres $unMembre)
    {
        $donnees = array(
            $unMembre->getTypeUtilisateur(),
            $unMembre->getNom(),
            $unMembre->getPrenom(),
            $unMembre->getMotDePasse(),
            $unMembre->getAdresse(),
            $unMembre->getTelephone(), 
            $unMembre->getCourriel(),
            $unMembre->getMembreValide(),
            $unMembre->getMembreActif(),
            $unMembre->getMembreId()
        );
        if($unMembre->getMembreId() && $this->lire($unMembre->getMembreId())->fetch())
        {
            $sql = "UPDATE " . $this->lireNomTable() . " SET type_utilisateur_id=?, nom=?, prenom=?, mot_de_passe=?, adresse=?, telephone=?, courriel=?, membre_valide=?, membre_actif=? WHERE membre_id=?"; 
        }
        else
        {
            $id = array_pop($donnees);
            $sql = "INSERT INTO " . $this->lireNomTable() . " (type_utilisateur_id, nom, prenom, mot_de_passe, adresse, telephone, courriel, membre_valide, membre_actif) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        }
        $this->requete($sql, $donnees);
        return $unMembre->getMembreId() > 0 ? $unMembre->getMembreId() : $this->bd->lastInsertId();
    }

    /**
     * @brief   Méthode pour valider un membre inscrit dans la bd
     * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
     * @param   [string] $courriel
     * @return  [array]
     */

    public function validerMembre($id)
    {
        return $this->modifierChamp($id, 'membre_valide', 1);
    }

    /**
 * @brief   Méthode pour valider un membre inscrit dans la bd
 * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
 * @param   [string] $courriel
 * @return  [array]
 */

    public function bannirMembre($id)
    {
        return $this->modifierChamp($id, 'membre_actif', 0);
    }

    /**
     * @brief   Méthode pour valider un membre inscrit dans la bd
     * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
     * @param   [string] $courriel
     * @return  [array]
     */

    public function reactiverMembre($id)
    {
        return $this->modifierChamp($id, 'membre_actif', 1);
    }


    /**
     * @brief   Méthode pour valider un membre inscrit dans la bd
     * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
     * @param   [string] $courriel
     * @return  [array]
     */

    public function promouvoirMembre($id)
    {
        return $this->modifierChamp($id, 'type_utilisateur_id', 2);
    }

    /**
     * @brief   Méthode pour valider un membre inscrit dans la bd
     * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
     * @param   [string] $courriel
     * @return  [array]
     */

    public function demouvoirMembre($id)
    {
        return $this->modifierChamp($id, 'type_utilisateur_id', 1);
    }

    /**
     * @brief   Méthode pour obtenir le rôle de utilisateur
     * @details Méthode qui obtiens un nom pour tous les type de l'utilisateur
     * @return  [string]
     */

    public function obtenirRole($role)
    {
        switch ($role) {
            case '1':
                return 'Membre';
            case '2':
                return 'Administrateur';
            case '3':
                return 'Super administrateur';
            default:
                return false;
        }
    }

}
<?php
/**
 * @file     Modele_Usagers.php
 * @author    
 * @version  1.0
 * @date       
 * @brief    Définit la classe Modele_Usager
 * @details  Cette classe définit les attributs nécessaire pour tout ce qui touche les usagers du site.
 */
	
	class ModeleUsagers extends BaseDAO {
        
        /**
		 * @brief Pour aller chercher le nom d'une table
		 * @details Permet d'aller chercher le nom d'une table.
		 * @param point1 
		 * @param point2 
		 * @return string usagers.
		 */
		public function lireNomTable() {
			return "al_usager";
		}

		/**
		 * @brief Pour aller chercher un usager 
		 * @details Permet d'aller chercher les renseignements sur un usager utilisant le courriel.
		 * @param point1 courriel
		 * @param point2 resultat
		 * @return array unUsager.
		 */
		public function obtenir_par_courriel($courriel) {
			$resultat = $this->lire($courriel);//reference BaseDAO
			$resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Usagers'); 
			$unUsager = $resultat->fetch();
			return $unUsager;
		}

		/**
		* @brief Obtenir tous les usagers 
		* @details Permet d'obtenir les informations pour tous les ussagers.
		* @param point1 resultat
		* @return array desUsagers.
		*/																	
		public function obtenir_tous() {
			$resultat = $this->lireTous();  //reference BaseDAO
			$desUsagers = $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Usagers");
			return $desUsagers;
		}

		/**
		* @brief Pour aller chercher un usager 
		* @details Permet d'aller chercher les renseignements sur un usager utilisant le nom.
		* @param point1 nom
		* @return array unUsager.
		*/
		public function obtenir_par_nom($nom) {
			$resultat = $this->lire($nom);
			$resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Usagers'); 
			$unUsager = $resultat->fetch();
			return $unUsager;
		}
		
		public function obtenir_listeaValider() {
			$query = "SELECT * FROM " . $this->lireNomTable() . " as u JOIN al_type_paiement as p ON u.id_paiement = p.id_paiement JOIN al_type_contact as c ON u.id_contact = c.id_contact JOIN al_type_usager as tu ON u.id_type_usager = tu.id_type_usager WHERE isnull(u_valide) and isnull(u_banni)" ;
			$resultat=$this->requete($query);
			$desUsagers = $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Usagers'); 
			return $desUsagers;
		}			
							

		/**
		* @brief Sauvegarde un usager
		* @details Prend les informations entrées et les sauvegarde dans la base de données.
		* @param point1 unUsager
		* @param point2 userName
		* @param point3 nom
		* @param point4 prenom
		* @param point5 isAdmin
		* @param point6 isBanned
		* @param point7 courriel
		* @return aucun.
		*/
		public function sauvegarde(Usagers $unUsager) {

		/*	if($unUsager->courriel && $this->lire($unUsager->courriel)->fetch())
			{
				$query = "UPDATE " . $this->getTableName() . " SET nom=?, prenom=?, isAdmin=?, isBanned=? WHERE courriel = ?";
				$donnees = array($unUsager->nom,$unUsager->prenom,$unUsager->isAdmin,$unUsager->isBanned,$unUsager->courriel) ;
				$resultat = $this->requete($query, $donnees);
			
			}
			
			else
			{ */
				//insert
				$query = "INSERT INTO " . $this->lireNomTable() . "(
				courriel, nom, prenom, cellulaire, mot_de_passe, id_contact, id_type_usager, 
				id_paiement) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
				$donnees = array($unUsager->lireCourriel(), $unUsager->lireNom(), $unUsager->lirepreNom(),
				$unUsager->lireMotDePasse(), $unUsager->lireCellulaire(), $unUsager->lireContact(), $unUsager->lireTypeUsager(),	
				$unUsager->lireTypePaiement());
				return $this->requete($query, $donnees);
			/*}*/
		}
		
		/**
		* @brief Valider un usager
		* @details change la valeur du champ pour valider un usager.
		* @param point1 courriel
		* @return aucun.
		*/	
		
		public function Valider(Usagers $usager) {
			$query = "UPDATE " . $this->lireNomTable() . " SET u_valide = 1 WHERE Courriel = ?";
			$data = array($usager->lireCourriel());
			return $this->requete($query, $data);
		}
		
		/**
		* @brief Bannir un usager
		* @details change la valeur du champ pour bannir un usager.
		* @param point1 description
		* @param point2 courriel
		* @return aucun.
		*/	
		
		public function Bannir(Usagers $usager) {
			var_dump($usager);
			$query = "UPDATE " . $this->lireNomTable() . " SET u_banni = 1, u_commentaire_banni =?, u_date_banni = now() WHERE Courriel = ?";
			var_dump($query);
			$data = array($usager->lireCommentaireBanni(), $usager->lireCourriel());
			return $this->requete($query, $data);
		}
		
	}

?>
<?php
/**
 * @file ControleurUsagers.php
 * @author   
 * @version 1.0
 * @date 
 * @brief Définit la classe pour le controleur usagers
 * @details Cette classe définit les différentes activités concernant les usagers du site.
 */

	class ControleurUsagers extends BaseControleur
	{
		/**
         * @brief   Méthode qui sera appelée par les controleurs
         * @details Méthode abstraite pour traiter les "cases" des contrôleurs
         * @param   [array] $params La chaîne de requête URL ("query string") captée par le Routeur.php
         * @return  L'acces aux vues,aux données et aux différents messages pour ce contrôleur.
         */
		public function index(array $params)
		{

			if(isset($params["action"]))
			{
				//var_dump("Si",$params);
				// var_dump($_POST);
				switch($params["action"])
				
				{
					//====================================================Login et verification des permissions==================================================================
					
					case "verificationLogin" :   
																									
						if(isset($params["courriel"]) && isset($params["MotDePasse"]) )
						{
								
																									
		
								$modeleUsagers = $this->lireDAO("Usagers");
								//$nouveauUsager = new Usagers();
								//$nouveauUsager->ecrireCourriel($params["courriel"]);
								//$my=$nouveauUsager->lireCourriel();
								// var_dump("my",$modeleUsagers);
								$data = $modeleUsagers->obtenir_par_courriel($params["courriel"]);  
								//var_dump($data);
								if($data && $data->lireCourriel() == $params["courriel"] && $data->lireMotDePasse() == $params["MotDePasse"])	//verifie si $data est "vraie" et si les donnees de la bd sont pareil comme les entrées.
								{																								//$data sera faux si le courriel ne se trouve pas dans la bd
																		
									if($data->lireestBanni() == 1)										//si l'usager est bannis
									{
										$this->afficherVues("MessageBanned");							//message pour les usagers bannis du site et destruction de la session
										if (isset($_SESSION["courriel"]))
											session_destroy();																	
									}	
									else															
									{	
			
										 
										// $controleur = "Sujets"; 									// chercher la classe avec le nom du controleur Sujets pour pouvoir afficher la liste des sujets
										// $classe = "Controleur_" . $controleur;
										//if(class_exists($classe))
										/*{

											$objetControleur = new $classe;							
											if($objetControleur instanceof BaseControleur)
											{
												$_REQUEST["action"] = "afficheListeSujets";
												$objetControleur->traite($_REQUEST);
										 	}
											else
											trigger_error("Controleur invalide.");
										} */
									}
									$_SESSION["courriel"] = $params["courriel"];	
									$_SESSION["typeUser"] = $data->lireTypeUsager();
									$_SESSION["prenom"] = $data->lirepreNom();
								    $_SESSION["succes"]= "Bienvenue ! " . $_SESSION["prenom"] . " " ;
                                    
                                    // Redirection des administrateurs à la page d'administration du site
                                    if ($_SESSION["typeUser"] == 1) {
                                        header("Location: index.php?Proprietaire&action=afficherLogements");
                                        //header("Location: index.php?Administration&action=afficherAdministration");
                                    }
									// Redirection des propriétaires à la page de gestion de logements
                                    else if ($_SESSION["typeUser"] == 2) {
                                        header("Location: index.php?Proprietaire&action=afficherLogements");
                                    }
                                    // Redirection des locataires à la page de recherche
                                    else {
                                        header("Location: index.php?Recherche&action=recherche");
                                    }
							
								}
								else
								{
									var_dump("Le courriel ou le MotDePasse est inexact");   
									$_SESSION["erreur"]= "Le courriel ou le MotDePasse est inexact ";
									header("Location: index.php");
								
								}

						}
						else {
							$_SESSION["warning"]="Erreur en parametres";
						    header("Location: index.php");
						}
						
					break;
					
					case "chercher_courriel":
							$json = array();
							if (isset($params["x"]))
								$courriel  = $params["x"];
							$modeleUsagers = $this->lireDAO("Usagers");
							$data = $modeleUsagers->obtenir_par_courriel($courriel); 
							$json["data"] = $data;
							if ($data)
								echo json_encode("Oui");
							else
								echo json_encode("Non");
							return;					//affiche la liste des sujets et des réponses
					break;
					
					case "ajouterUsager" : 
						$modeleTypeContact = $this->lireDAO("TypeContact");
						$modeleTypePaiement = $this->lireDAO("TypePaiement");
					  	$donnees["listeContacts"] = $modeleTypeContact->lireTousTypeContact();
					  	$donnees["listePaiements"] = $modeleTypePaiement->lireTousTypePaiement();
					  	$this->afficherVues("ajoutUsager", $donnees);
					break;

					//====================================================partie administrative===========================
					
					case "admin":
						$this->afficherVues("admin");
					break;
					
					case "afficheListeUsagers":														//affiche la liste des usagers
						$this->afficheListeUsagers();
					break;					
					case "afficheListeUsagersJson":														//affiche la liste des usagers
						$modeleUsagers = $this->lireDAO("Usagers"); 
                    	$modeleTypePaiement = $this->lireDAO("TypePaiement"); 
                    	$modeleTypeContact = $this->lireDAO("TypeContact"); 
                    	$donnees = $modeleUsagers->obtenir_tous();
                    	$data = array();
                    	for ($i=0 ;$i<count($donnees);$i++){
                    		$data[$i]=array(
                    		'courriel'=>$donnees[$i]->lireCourriel(),
                    		'nom'=>$donnees[$i]->lireNom(),
                    		'prenom'=>$donnees[$i]->lirepreNom(),
                    		'cellulaire'=>$donnees[$i]->lireCellulaire(),
							'mot_de_passe'=>$donnees[$i]->lireCourriel(),
							'u_banni'=>$donnees[$i]->lireestBanni(),
							'u_commentaire_banni'=>$donnees[$i]->lireCommentaireBanni(),
							'u_date_banni'=>$donnees[$i]->lireDateBanni(),
							'u_valide'=>$donnees[$i]->lireUValide()
                    		);
                    	}
                    	  echo json_encode($data);
					break;	
					case "modifieUsager":															//va chercher un usager pour permettre la modification
						
						if(isset($params["courriel"]))
						{
							$modeleUsagers = $this->lireDAO("Usagers");
							$data = $modeleUsagers->obtenir_par_courriel($params["courriel"]);		//obtenir les informations d'un usager en se servant du courriel de AfficheListeUsagers
							$this->afficherVues("admin", $data);								//affiche une vue de l'usager que l'on veut modifier
						}
						
						else
						{
							trigger_error("Pas de courriel spécifié...");
						}
						break;
					
					
					case "enregistrerUsager" :														//va chercher un usager pour permettre la modification
						//var_dump($params);
						//die();
						if(!isset($params["courriel"]) || !isset($params["nom"]) || !isset($params["prenom"]))
						{	
					       echo "Erreur .... !";
							$this->afficherVues("AfficheUsager");
						}
						else
						{
								$modeleUsagers = $this->lireDAO("Usagers");                                  
								$modification["Usager"] = new Usagers($params["courriel"],$params["nom"],$params["prenom"], $params["mot_de_passe"], $params["cellulaire"],"","","",$params["id_contact"],3,$params["id_paiement"],false,true);
								$succes= $modeleUsagers->sauvegarde($modification["Usager"]);		//sauvegarder les informations d'un usager en se servant d'un tableau
								$_SESSION["succes"]= "Votre compte a été crée, merci de attendre un confirmation dans votre courriel avant de s'authentifier ! ";
								header("Location: index.php");
						}
						break;
					case "Logout":																	//va chercher un usager pour permettre la modification
					   $this->deconnection();
					   header("Location: index.php");

					break;

                    case "listeavalider":
                    	$modeleUsagers = $this->lireDAO("Usagers"); 
                    	$modeleTypePaiement = $this->lireDAO("TypePaiement"); 
                    	$modeleTypeContact = $this->lireDAO("TypeContact"); 
                    	$donnees = $modeleUsagers->obtenir_listeaValider();
                    	$data = array();
                    	for ($i=0 ;$i<count($donnees);$i++){
                    		$data[$i]=array(
                    		'courriel'=>$donnees[$i]->lireCourriel(),
                    		'nom'=>$donnees[$i]->lireNom(),
                    		'prenom'=>$donnees[$i]->lirepreNom(),
                    		'cellulaire'=>$donnees[$i]->lireCellulaire()
                    		);
                    	}
                    	  echo json_encode($data);
                    break;
					case "validerUsager":
						if(isset($params["courriel"]) && $_SESSION["typeUser"] == 1)  {
							$courriel = $params["courriel"];
							$modeleUsagers = $this->lireDAO("Usagers"); 
							$data = $modeleUsagers->obtenir_par_courriel($courriel);
							$modeleUsagers->Valider($data);
						}
					break;

					case "bannirUsager":
						if(isset($params["courriel"]) && $_SESSION["typeUser"] == 1)  {
							$courriel = $params["courriel"];
							$descript = $params["description"];
							$modeleUsagers = $this->lireDAO("Usagers"); 
							$data = new Usagers($courriel, '', '', '','' , '',$descript );
							var_dump($data);
							$modeleUsagers->Bannir($data);
						}					
					break;

                    case "nouvelMessage":
                      $this->afficherVues("messagerie");
					/*default:		
																								
						trigger_error("Action invalide");
					*/
					break;
					default:
                        trigger_error($params["action"] . " Action invalide.");		
				}	
			}
			else
			{
				var_dump("No");
				$this->afficherVuess("FormLogin"); 													//action par defaut- affiche le login
			}	
		}
		
		/**
		* @brief Affiche la liste des usagers
		* @details Prend les renseignements sur les usagers et les affiche. Puis ouvre la vue AfficheListeUsagers
		* @details Utilise le Modele_Usagers
		* @param [string] $data
		* @return à la vue AfficheListeUsagers .
		*/

		private function afficheListeUsagers()
		{
			$modeleUsagers = $this->lireDAO("Usagers");
			$data["usagers"] = $modeleUsagers->obtenir_tous();
			$this->afficherVues("AfficheListeUsagers", $data);
		}

		
		/**
		* @brief Permet la déconnection de la session
		* @details Se retouve sur les pages ecepté sur la page de loggin
		* @param [string] courriel
		* @return aucun.
		*/
		private function deconnection()
		{
		
			if (isset($_SESSION["courriel"])) 
			{
				unset($_SESSION["courriel"]);
				setcookie("courriel", null, -1, '/');
			}
			if (isset($_SESSION["typeUser"]))
			{
				unset($_SESSION["typeUser"]);
				setcookie("typeUser", null, -1, '/');
			}	
			if (isset($_SESSION["prenom"]))
			{
				unset($_SESSION["prenom"]);
				setcookie("prenom", null, -1, '/');
			}
		}
		
	}
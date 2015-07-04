<?php
	require_once("connexion.php");

	$req = "SELECT matricule, nom, prenom, sexe, date_naissance, libelle_fil, libelle_niv
	        FROM etudiant, niveau, filiere
	        WHERE etudiant.code_niv = niveau.code_niv and filiere.code_fil = niveau.code_fil";
	$res=mysql_query($req) or die(mysql_error());
?>

<html>
<head>
	<title>Gestion des étudiant</title>
	<meta charset="utf-8"> 

	<script type="text/javascript" src="js/jquery-1.9.0.js"></script>
	<script type="text/javascript" src="js/matiere_niveau.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style_tabs.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
				$(function(){
					$("#tabs").tabs();
				})

				$("#supp").click(function(){
						 $.ajax({
						 		type: 'post',
						 		url:'supprimerEtudiant.php',
						 		data: {'code':$(':checkbox:checked').val()},
						 		success: function(reponse){
						 				if(reponse == "success"){
						 						$(":checkbox:checked").parent().parent().remove();
						 				}else{
						 						alert(reponse);
						 				}
						 		}
						 })
				});

		});
	</script>
</head>
<body>

	<!-- DEBUT -->

		<div id="tabs">
		<ul>
			<li><a class="affiche" href="#tabs-1">Liste des étudiants</a></li></a>
			<li><a href="#tabs-2">Nouveau étudiant</a></li>
		</ul>
		<!-- Onglet liste des filière-->
		<div id="tabs-1">
			<div class="contenu">

							<!-- debut-->	
								<table class="afficher">		
										<tr>
											<th>Matricule</th>
											<th>Nom</th>
											<th>Prénom</th>
											<th>Sexe</th>
											<th>Date de naissance</th>
											<th>Filière</th>
											<th>Niveau</th>
											<th width="30" class="operation"><input type="button" id="supp" value="Supprimer"/></th>
										</tr>
										<?php
											while($data=mysql_fetch_assoc($res)){?>
											 <tr>
												<td><?php echo $data['matricule']; ?></td>
												<td><?php echo $data['nom']; ?></td>
												<td><?php echo $data['prenom']; ?></td>
												<td><?php echo $data['sexe']; ?></td>
												<td><?php echo $data['date_naissance']; ?></td>
												<td><?php echo $data['libelle_fil']; ?></td>
												<td><?php echo $data['libelle_niv']; ?></td>
												<td align="center" width="40"> 
														<input type="checkbox" name="<?php echo $data['matricule'] ?>" value="<?php echo $data['matricule'] ?>"> 
												</td>
											</tr>	
										<?php
											}
										?>
								</table>
							<!-- fin -->

			</div>
		</div>

		<div id="tabs-2">
			<div id="content">
				<form method="post" action="ajouterEtudiant.php">
					<p>
					<fieldset>
						<legend>Saisie des étudiants par filière et par niveau</legend>
							<table>
								<tr>
									<td><br/><label>Matricule</label></td>
									<td><br/><input type="text" name="matricule" id="matricule" size="28"></td>
								</tr>
								<tr>
									<td><br/><label>Nom</label></td>
									<td><br/><input type="text" name="nom" id="nom" size="28"></td>
								</tr>
								<tr>
									<td><br/><label>Prénom</label></td>
									<td><br/><input type="text" name="prenom" id="prenom" size="28"></td>
								</tr>
								<tr>
									<td><br/><label>Sexe</label></td>
									<td><br/>
										<select name="sexe" id="sexe" >
											<option value="0">Sélectionnez le sexe</option>
											<option>Masculin</option>
											<option>Feminin</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><br/><label>Date de naissance</label></td>
									<td><br/>
										<input type="text" name="datenaiss" id="datenaiss" placeholder="AAAA-MM-JJ" size="28">
									</td>
								</tr>
								<tr>
									<td><br/><label>Filière</label></td>
									<td><br/>
										<div class="divFiliere"></div>
									</td>
								</tr>
								<tr>
									<td><br/><label>Niveau</label></td>
									<td><br/>
										<div class="divNiveau">
											<select id="niveau" name="niveau" >
												<option>Sélectionnez le niveau</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td></td>
									<td> <br/><input type="submit" value="Enregistrer"> </td>
								</tr>	
							</table>
					</fieldset>
					</p>
				</form>
			</div>
		</div>
	</div>	
	<table>
		<tr>
			<td><img src="images/previous.png"></td>
			<td><a href="index.html">Retour au menu principal</a></td>
		</tr>	
	</table>	

	<!-- FIN -->
</body>
</html>
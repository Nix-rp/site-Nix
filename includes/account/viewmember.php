<?php function viewmember ()
{
	global $db, $_POST, $_GET, $_SESSION;

	include('includes/interface/JSONapi.php');



		$ip = 'soul.omgcraft.fr';

		$port = 20059;

		$user = "nix";

		$pwd = "dragonball";

		$salt = 'salt';

		$api = new JSONAPI($ip, $port, $user, $pwd, $salt);

	$answer = $db->query("SELECT * FROM members");
	$line = $answer->fetch();
	$answer->closeCursor();
	
	if (isset($_GET['perso']))
	{
		$perso = intval($_GET['perso']);
		$answer = $db->prepare('SELECT *
					FROM members AS m
					WHERE m.id = ?');
		$answer->execute(array($perso));
		
		

		if ($line = $answer->fetch())
		{
			$dispPerso = true;
			if($_GET['mod'] == 'chr')
			{
				if($_SESSION['rank'] >= 6)
				{
					$db->exec('update members set race = \'' .$_GET['r']. '\' where id = \'' .$perso. '\'');
					$api->call('server.run_command', array('/setrace (mc) (race)'));

				}
			}
			$nom = ($line['name']);
			$ranker = ($_SESSION["id"]);
			$ranker_rank = ($_SESSION["rank"]);
			$ranker_name = ($_SESSION["name"]);
	?>
	<? if ($_SESSION["rank"] <=4) {
			if  ($line['rank'] >=7) { echo '<p class="error">Le grade de ce personnage est trop élevé pour vous ! <br />
			<img src="pics/locked.gif" alt="BG vérouillé" /><br />Vous ne pouvez visiter la page des PNJs trop haut gradés</p>';}
			else {
		?>
		<h3><?= $line['title']?> <?= $line['name']?></h3>
		<? if ($line['ban'] == 1) {?><h5 class="error">Attention, ce personnage est banni !</h5> <? } ?>
		<? if ($line['removed'] == 1) {?><h5 class="error">Attention, ce personnage a été supprimé !</h5> <? } ?>
		
			<center id="background">
				<table with="584" cellspacing="0" cellpadding="0" style="margin-bottom:20px">
					<tbody>
						<tr>
							<td>
								<img src="pics/persotop.png"/>
							</td>
						</tr>
						<tr>
							<td background="pics/persocenter.png">
								<p>	</p>
									<table class="perso">
										<tbody>
											<tr>
												<th rowspan="12">
												 <!-- Image du skin -->
												</th>
												<th>Nom : </th>
													<td>
														<?= $line['name']?>
													</td>
													<td>
														<?php if ($_SESSION["rank"] >= 4) { ?>
															<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
															
															<?php if ($line['rank'] < 8) { if ($line['rank']+1 < $_SESSION['rank']) { ?>
															<input type="submit" name="up" value='[+]' style="color:green" id="upgrade_button" />			<? } } ?>
															<?php if ($line['rank'] > 0) { if ($line['rank']+1 < $_SESSION['rank']) { ?>
															<input type="submit" name="down" value="[-]" style="color:red" id="upgrade_button" />			<? } } ?>
															<?php if ($line['rank'] < $_SESSION['rank']) { if ($line['mute'] == 0) {?>
															<input type="submit" name="mute" value="[M]" style="color:orange" id="upgrade_button" /> <?} } ?>
																<?php if ($line['rank'] < $_SESSION['rank']) { if ($line['mute'] == 1) {?>
															<input type="submit" name="demute" value="[M]" style="color:green" id="upgrade_button" /> <?} } ?>
															<!-- <input type="submit" name="avert" value="[A]" style="color:red" id="upgrade_button" /> -->
															
															<?if(isset($_POST['up'])) { echo '<span class="error">Personnage promu !</span>';
															$db->exec("UPDATE members SET rank = rank + 1 WHERE id = $perso"); $db->exec("INSERT INTO chatbox (post_date, user_id, message) VALUES (NOW(), 92, 'Félicitations à $nom pour sa montée en grade !')");	}?>
															<?if(isset($_POST['down'])) { echo '<span class="error">Personnage dégradé !</span>';	$db->exec("UPDATE members SET rank = rank - 1 WHERE id = $perso");	}?>
															<?if(isset($_POST['mute'])) { echo '<span class="error">Joueur réduit au silence !</span>';	$db->exec("UPDATE members SET mute = 1 WHERE id = $perso");	}?>
															<?if(isset($_POST['demute'])) { echo '<span class="error">Joueur démute !</span>';	$db->exec("UPDATE members SET mute = 0 WHERE id = $perso");	}?>
															<?if(isset($_POST['avert'])) { echo '<span class="error">Fonction en cours de développement ...</span>';	}?>
															</form>
														<? } ?>
													</td>
											</tr>
											<tr>
												<th>Titre : </th>
													<td>
														<img src="pics/grade<?= $line['rank']?>.png" class="magie_type" alt="Grade HRP du Joueur" /> <?= $line['title']?>
													</td>
											</tr>
											<tr>
												<th>Energie Magique :</th>
													<?	if ($line['magie_rank'] == 0) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 4) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >=5 AND $line['E_magique'] <= 10) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >=10 AND $line['E_magique'] <= 14) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >=15 AND $line['E_magique'] <= 19) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >=20 AND $line['E_magique'] <= 24) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >=25 AND $line['E_magique'] <= 29) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >=30 AND $line['E_magique'] <= 34) 	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >=35 AND $line['E_magique'] <= 39) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >=40 AND $line['E_magique'] <= 44) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >=45 AND $line['E_magique'] <= 49) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 50) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 1) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 9) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >=10 AND $line['E_magique'] <= 19) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >=20 AND $line['E_magique'] <= 29) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >=30 AND $line['E_magique'] <= 39) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >=40 AND $line['E_magique'] <= 49) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >=50 AND $line['E_magique'] <= 59) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >=60 AND $line['E_magique'] <= 69)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >=70 AND $line['E_magique'] <= 79) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >=80 AND $line['E_magique'] <= 89) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >=90 AND $line['E_magique'] <= 99) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 100) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 2) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 14) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >=15 AND $line['E_magique'] <= 29) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >=30 AND $line['E_magique'] <= 44) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >=45 AND $line['E_magique'] <= 59) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >=60 AND $line['E_magique'] <= 74) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >=75 AND $line['E_magique'] <= 89) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >=90 AND $line['E_magique'] <= 104)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >=105 AND $line['E_magique'] <= 119)	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >=120 AND $line['E_magique'] <= 134) {	$tmagie = 80 ;	}
															if ($line['E_magique'] >=135 AND $line['E_magique'] <= 149) {	$tmagie = 90 ;	}
															if ($line['E_magique'] == 150) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 3) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 19) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >= 20 AND $line['E_magique'] <= 39) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >= 40 AND $line['E_magique'] <= 59) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >= 60 AND $line['E_magique'] <= 79) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >= 80 AND $line['E_magique'] <= 99) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >= 100 AND $line['E_magique'] <= 119) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >= 120 AND $line['E_magique'] <= 139)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >= 140 AND $line['E_magique'] <= 159) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >= 160 AND $line['E_magique'] <= 179) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >= 180 AND $line['E_magique'] <= 199) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 200) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 4) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 29) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >= 30 AND $line['E_magique'] <= 59) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >= 60 AND $line['E_magique'] <= 89) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >= 90 AND $line['E_magique'] <= 119) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >= 120 AND $line['E_magique'] <= 149) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >= 150 AND $line['E_magique'] <= 179) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >= 180 AND $line['E_magique'] <= 209)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >= 210 AND $line['E_magique'] <= 239) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >= 240 AND $line['E_magique'] <= 269) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >= 270 AND $line['E_magique'] <= 299) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 300) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 5) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 39) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >= 40 AND $line['E_magique'] <= 79) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >= 80 AND $line['E_magique'] <= 119) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >= 120 AND $line['E_magique'] <= 159) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >= 160 AND $line['E_magique'] <= 199) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >= 200 AND $line['E_magique'] <= 239) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >= 240 AND $line['E_magique'] <= 279)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >= 280 AND $line['E_magique'] <= 319) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >= 320 AND $line['E_magique'] <= 359) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >= 360 AND $line['E_magique'] <= 399) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 400) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 6) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 49) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >= 50 AND $line['E_magique'] <= 99) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >= 100 AND $line['E_magique'] <= 149) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >= 150 AND $line['E_magique'] <= 199) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >= 200 AND $line['E_magique'] <= 249) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >= 250 AND $line['E_magique'] <= 299) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >= 300 AND $line['E_magique'] <= 349)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >= 350 AND $line['E_magique'] <= 399) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >= 400 AND $line['E_magique'] <= 449) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >= 450 AND $line['E_magique'] <= 499) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 500) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] >= 7) { $tmagie = 'inf';}
													?>	
												<td>
													<img src="includes/img/magie/EM_<? echo $tmagie ?>.png" title="<?= $line['E_magique']?> PM restants !" alt="Energie Magique" />
												</td>
												<? if ($_SESSION['rank'] >= 4) { ?>
												<td>	<? if ($line['E_magique'] >= 1 ) { ?>
														<input type="submit" name="moins1" style="color: red" value="[-1]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_magique'] >= 5 ) { ?>
														<input type="submit" name="moins5" style="color: red" value="[-5]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_magique'] >= 10 ) { ?>
														<input type="submit" name="moins10" style="color: red" value="[-10]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_magique'] >= 50 ) { ?>
														<input type="submit" name="moins50" style="color: red" value="[-50]" id="upgrade_button" /> <? } ?>
														<?	if(isset($_POST['plus1'])) { echo '<br /><span class="error">PM montés de 1 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique +1 WHERE id = $perso");		}
															if(isset($_POST['plus5'])) { echo '<br /><span class="error">PM montés de 5 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique +5 WHERE id = $perso");		}
															if(isset($_POST['plus10'])) { echo '<br /><span class="error">PM montés de 10 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique +10 WHERE id = $perso");		}
															if(isset($_POST['plus50'])) { echo '<br /><span class="error">PM montés de 50 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique +50 WHERE id = $perso");		}
															if(isset($_POST['moins1'])) { echo '<br /><span class="error">PM descendus de 1 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique -1 WHERE id = $perso");		}
															if(isset($_POST['moins5'])) { echo '<br /><span class="error">PM descendus de 5 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique -5 WHERE id = $perso");		}
															if(isset($_POST['moins10'])) { echo '<br /><span class="error">PM descendus de 10 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique -10 WHERE id = $perso");		}
															if(isset($_POST['moins50'])) { echo '<br /><span class="error">PM descendus de 50 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique -50 WHERE id = $perso");		}?>
													</form>
												</td> <? } ?>
											</tr>
											<tr>
												<th>Energie Vitale :</th>
													<?
															if ($line['E_vitale'] == 0  AND $line['E_vitale'] <= 19) 	{	$tvie = 0 ;	}
															if ($line['E_vitale'] >= 20 AND $line['E_vitale'] <= 39) 	{	$tvie = 10 ;	}
															if ($line['E_vitale'] >= 40 AND $line['E_vitale'] <= 59) 	{	$tvie = 20 ;	}
															if ($line['E_vitale'] >= 60 AND $line['E_vitale'] <= 79) 	{	$tvie = 30 ;	}
															if ($line['E_vitale'] >= 80 AND $line['E_vitale'] <= 99) 	{	$tvie = 40 ;	}
															if ($line['E_vitale'] >= 100 AND $line['E_vitale'] <= 119) 	{	$tvie = 50 ;	}
															if ($line['E_vitale'] >= 120 AND $line['E_vitale'] <= 139)	{	$tvie = 60 ;	}
															if ($line['E_vitale'] >= 140 AND $line['E_vitale'] <= 159) 	{	$tvie = 70 ;	}
															if ($line['E_vitale'] >= 160 AND $line['E_vitale'] <= 179) 	{	$tvie = 80 ;	}
															if ($line['E_vitale'] >= 180 AND $line['E_vitale'] <= 199) 	{	$tvie = 90 ;	}
															if ($line['E_vitale'] == 200) 	{	$tvie = 100 ;	}
													?>
												<td>
												<img src="includes/img/magie/EV_<? echo $tvie ?>.png" title="<?= $line['E_vitale']?> PV restants !" alt="Energie Magique" />
												</td>
											</tr>
											<tr>
												<th>Race : </th>
													<td>
														<?= $line['race']?>
													</td>
											</tr>
											<?php if ($_SESSION["rank"] >= 4) { ?><tr>
												<th>Invisibilité : </th>
													<td>
														<img src="pics/vanish<?= $line['invisible']?>.gif" alt="Icone d'Invisibilité" />
													</td>
											</tr>	<? } ?>
											<tr>
												<th>Pratique de la Magie : </th>
													<td>
														<img src="pics/magieok_<?= ($line['magieok'])?>.gif" alt="Magie Maîtrisée ou non" />
													</td>
											</tr>
											<?php if ($_SESSION["rank"] >= 3) { ?>	<tr>
											<th>Spécialisation Magique : </th>
													<td>
														<img src="pics/spe_<?= ($line['specialisation'])?>" class="magie_type" alt="Spécialisation" />
													</td>
											<?php if ($_SESSION["rank"] >= 4) { ?>		<td>
														 <form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
															<input type="submit" name="speeau" value="Eau" id="upgrade_button" />
															<input type="submit" name="speelec" value="Elec" id="upgrade_button" />
															<input type="submit" name="spefeu" value="Feu" id="upgrade_button" /><br />
															<input type="submit" name="spelum" value="Lumière" id="upgrade_button" />
															<input type="submit" name="spespe" value="Spéciale" id="upgrade_button" /><br />
															<input type="submit" name="speten" value="Ténèbres" id="upgrade_button" />
															<input type="submit" name="speter" value="Terre" id="upgrade_button" /><br />
															<input type="submit" name="spevent" value="Vent" id="upgrade_button" />
																<?
																if(isset($_POST['speeau'])) { echo '<span class="error">Spécialisation changée !</span>'; 	$db->exec("UPDATE members SET specialisation = 'Eau' WHERE id = $perso");	}
																if(isset($_POST['speelec'])) { echo '<span class="error">Spécialisation changée !</span>';	$db->exec("UPDATE members SET specialisation = 'Elec' WHERE id = $perso");	}
																if(isset($_POST['spefeu'])) { echo '<span class="error">Spécialisation changée !</span>'; 	$db->exec("UPDATE members SET specialisation = 'Feu' WHERE id = $perso");	}
																if(isset($_POST['spelum'])) { echo '<span class="error">Spécialisation changée !</span>';	$db->exec("UPDATE members SET specialisation = 'Lumière' WHERE id = $perso");	}
																if(isset($_POST['spespe'])) { echo '<span class="error">Spécialisation changée !</span>'; 	$db->exec("UPDATE members SET specialisation = 'Spéciale' WHERE id = $perso");	}
																if(isset($_POST['speten'])) { echo '<span class="error">Spécialisation changée !</span>';	$db->exec("UPDATE members SET specialisation = 'Ténèbres' WHERE id = $perso");	}
																if(isset($_POST['speter'])) { echo '<span class="error">Spécialisation changée !</span>'; 	$db->exec("UPDATE members SET specialisation = 'Terre' WHERE id = $perso");	}
																if(isset($_POST['spevent'])) { echo '<span class="error">Spécialisation changée !</span>';	$db->exec("UPDATE members SET specialisation = 'Vent' WHERE id = $perso");	}
																?>
														</form>
													</td>	<? } ?>
											</tr>	<? } ?>
											<tr>
												<th>Niveau Magique : </th>
													<td>
													<img src="pics/magie_rank_<?= $line['magie_rank']?>.gif" alt="Mage de niveau <?= ($line["magie_rank"])?>"/>	
													</td>
											</tr>
											<tr>
												<th>Cycle de Vie : </th>
													<td>
														<img src="pics/hardcore<?= ($line['hardcore'])?>.png" alt="Icone de Remortalité" />
													</td>
											</tr>
										</tbody>
									</table>
								<p>	</p>
							</td>
						</tr>
						<tr>
							<td>
								<img src="pics/persobottom.png"/>
							</td>
						</tr>
					</tbody>
				</table>
			</center>
		
		<br />
		<br />
		
		BackGround <? if ($line['valid_bg'] == 1) { ?> <img src="pics/valid_bg_on.gif" alt="BG Validé" title="Background RolePlay vérifié par le Staff" /><? }?><br />
		<br /><section id="background">
		<?= $line['background']?>
		</section>
		
		<p>
		<?php if ($_SESSION["rank"] >= 4) { ?> <a href="index.php?p=perso&amp;perso=<?= $line['id']?>">Ancienne version de la page</a><? } ?>
		</p>
			
			
	<?php } } 
	if ($_SESSION["rank"] >=5) {
		?>
		<h3><?= $line['title']?> <?= $line['name']?></h3>
		<? if ($line['ban'] == 1) {?><h5 class="error">Attention, ce personnage est banni !</h5> <? } ?>
		<? if ($line['removed'] == 1) {?><h5 class="error">Attention, ce personnage a été supprimé !</h5> <? } ?>
		
			<center id="background">
				<table with="584" cellspacing="0" cellpadding="0" style="margin-bottom:20px">
					<tbody>
						<tr>
							<td>
								<img src="pics/persotop.png"  />
							</td>
						</tr>
						<tr>
							<td background="pics/persocenter.png">
								<p>	</p>
									<table class="perso">
										<tbody>
											<tr>
												<th rowspan="12">
												 <!-- Image du skin -->
												</th>
												<th>Nom : </th>
													<td>
														<?= $line['name']?>
													</td>
													<td>
														<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
																<?php if ($line['rank'] < 8) { if ($line['rank']+1 < $_SESSION['rank']) { ?>
															<input type="submit" name="up" value='[+]' style="color:green" id="upgrade_button" />			<? } } ?>
																<?php if ($line['rank'] > 0) { if ($line['rank']+1 < $_SESSION['rank']) { ?>
															<input type="submit" name="down" value="[-]" style="color:red" id="upgrade_button" />			<? } } ?>
																<?php if($_SESSION['rank'] <= 6){ ?><input type="submit" name="end" value="[F]" style="color:#DBA901" id="upgrade_button" /><? } ?>
																<?php if ($line['rank'] > 3) { if ($line['rank']+1 < $_SESSION['rank'])  {
																		if ($line['dignitaire'] == 0) {?>
															<input type="submit" name="dign" value="[D]" style="color: <? if ($line['rank'] == 6) { echo "#D70B0B"; }
																		elseif ($line['rank'] == 5) { echo "#D75B5B"; }
																		else { echo "#006100";} ?>" id="upgrade_button" />			<?}  } }
																if ($line['rank'] > 2) { if ($line['rank']+1 < $_SESSION['rank']) {		if ($line['dignitaire'] == 1) {?>
															<input type="submit" name="return" value="[R]" style="color: <? if ($line['rank'] == 6) { echo "#FF3333"; }
																		elseif ($line['rank'] == 5) { echo "#FF8383"; }
																		else { echo "#339900";} ?>" id="upgrade_button" />	
																		<?} } } ?>
																<?php if ($line['rank'] < $_SESSION['rank']) { if ($line['ban'] == 0) {?>
															<input type="submit" name="ban" value="[B]" style="color:orange" id="upgrade_button" /> <?} } ?>
																<?php if ($line['rank'] < $_SESSION['rank']) { if ($line['ban'] == 1) {?>
															<input type="submit" name="deban" value="[P]" style="color:green" id="upgrade_button" /> <?} } ?>
															
															<?php if ($line['rank'] < $_SESSION['rank']) { if ($line['mute'] == 0) {?>
															<input type="submit" name="mute" value="[M]" style="color:orange" id="upgrade_button" /> <?} } ?>
																<?php if ($line['rank'] < $_SESSION['rank']) { if ($line['mute'] == 1) {?>
															<input type="submit" name="demute" value="[M]" style="color:green" id="upgrade_button" /> <?} } ?>
															<input type="submit" name="avert" value="[A]" style="color:red" id="upgrade_button" />
													
															<?php if(isset($_POST['end'])){ echo '<span class="error">Fin du personnage !</span>'; $db->exec('UPDATE members SET rank = 7 WHERE id = \'' .$perso. '\' '); $db->exec('UPDATE members SET magie_rank = 6 WHERE id = \'' .$perso. '\' '); } ?>
															<?if(isset($_POST['up'])) { echo '<span class="error">Personnage promu !</span>';
																$db->exec("UPDATE members SET rank = rank + 1 WHERE id = $perso"); $db->exec("INSERT INTO chatbox (post_date, user_id, message) VALUES (NOW(), 92, 'Félicitations à $nom pour sa montée en grade !')");
																$db->exec('INSERT INTO hist_grada (upper_id, method, upped_id, up_date) VALUES (\'' .$_SESSION['id']. '\', 1, \'' .$perso. '\', NOW() )');}?>
															<?if(isset($_POST['down'])) { echo '<span class="error">Personnage dégradé !</span>';	$db->exec("UPDATE members SET rank = rank - 1 WHERE id = $perso");
															$db->exec('INSERT INTO hist_grada (upper_id, method, upped_id, up_date) VALUES (\'' .$_SESSION['id']. '\', 0, \'' .$perso. '\', NOW() )');	}?>
															<?if(isset($_POST['dign'])) { echo '<span class="error">Retraite donnée !</span>';	$db->exec("UPDATE members SET rank = rank - 1 WHERE id = $perso"); $db->exec("UPDATE members SET dignitaire = 1 WHERE id = $perso"); $db->exec("UPDATE members SET title = 'Dignitaire' WHERE id = $perso");
																$db->exec('INSERT INTO hist_grada (upper_id, method, upped_id, up_date) VALUES (\'' .$_SESSION['id']. '\', 0, \'' .$perso. '\', NOW() )');}?>
															<?if(isset($_POST['return'])) { echo '<span class="error">Activité redonnée !</span>';	$db->exec("UPDATE members SET rank = rank + 1 WHERE id = $perso"); $db->exec("UPDATE members SET dignitaire = 0 WHERE id = $perso"); $db->exec("INSERT INTO chatbox (post_date, user_id, message) VALUES (NOW(), 92, 'Félicitations à $nom pour sa montée en grade !')");
																$db->exec('INSERT INTO hist_grada (upper_id, method, upped_id, up_date) VALUES (\'' .$_SESSION['id']. '\', 1, \'' .$perso. '\', NOW() )');}?>
															<?if(isset($_POST['ban'])) { echo '<span class="error">Personnage banni !</span>';	$db->exec("UPDATE members SET ban = 1 WHERE id = $perso"); $db->exec("UPDATE members SET title = 'Banni' WHERE id = $perso");	}?>
															<?if(isset($_POST['deban'])) { echo '<span class="error">Personnage débanni !</span>';	$db->exec("UPDATE members SET ban = 0 WHERE id = $perso");	}?>
															<?if(isset($_POST['mute'])) { echo '<span class="error">Joueur réduit au silence !</span>';	$db->exec("UPDATE members SET mute = 1 WHERE id = $perso");	}?>
															<?if(isset($_POST['demute'])) { echo '<span class="error">Joueur démute !</span>';	$db->exec("UPDATE members SET mute = 0 WHERE id = $perso");	}?>
															<?if(isset($_POST['avert'])) { echo '<span class="error">Fonction en cours de développement ...</span>';	}?>
														</form>
													</td>
											</tr>
											<tr>
												<th>Titre : </th>
													<td>
														<img src="pics/grade<?= $line['rank']?>.png" class="magie_type" alt="Grade HRP du Joueur" /> <?= $line['title']?>
													</td>
													<td>
														<form method="POST" action="index.php?p=viewmember&perso=<?php echo $perso; ?>"><input type="text" name="title" placeholder="Nouveau Titre" /><input type="submit" value="Valider" />
			
															<?php

															if(!empty($_POST['title']))
															{
																$db->exec('UPDATE members SET title = \'' .$_POST['title']. '\' WHERE id = \'' .$perso. '\'');
																echo '<span class="error">Titre changé!</span>';
															}

															?>
														</form>
													</td>
											</tr>
											<tr>
												<th>Energie Magique :</th>
													<?	if ($line['magie_rank'] == 0) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 4) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >=5 AND $line['E_magique'] <= 10) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >=10 AND $line['E_magique'] <= 14) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >=15 AND $line['E_magique'] <= 19) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >=20 AND $line['E_magique'] <= 24) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >=25 AND $line['E_magique'] <= 29) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >=30 AND $line['E_magique'] <= 34) 	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >=35 AND $line['E_magique'] <= 39) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >=40 AND $line['E_magique'] <= 44) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >=45 AND $line['E_magique'] <= 49) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 50) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 1) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 9) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >=10 AND $line['E_magique'] <= 19) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >=20 AND $line['E_magique'] <= 29) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >=30 AND $line['E_magique'] <= 39) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >=40 AND $line['E_magique'] <= 49) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >=50 AND $line['E_magique'] <= 59) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >=60 AND $line['E_magique'] <= 69)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >=70 AND $line['E_magique'] <= 79) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >=80 AND $line['E_magique'] <= 89) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >=90 AND $line['E_magique'] <= 99) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 100) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 2) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 14) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >=15 AND $line['E_magique'] <= 29) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >=30 AND $line['E_magique'] <= 44) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >=45 AND $line['E_magique'] <= 59) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >=60 AND $line['E_magique'] <= 74) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >=75 AND $line['E_magique'] <= 89) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >=90 AND $line['E_magique'] <= 104)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >=105 AND $line['E_magique'] <= 119)	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >=120 AND $line['E_magique'] <= 134) {	$tmagie = 80 ;	}
															if ($line['E_magique'] >=135 AND $line['E_magique'] <= 149) {	$tmagie = 90 ;	}
															if ($line['E_magique'] == 150) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 3) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 19) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >= 20 AND $line['E_magique'] <= 39) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >= 40 AND $line['E_magique'] <= 59) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >= 60 AND $line['E_magique'] <= 79) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >= 80 AND $line['E_magique'] <= 99) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >= 100 AND $line['E_magique'] <= 119) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >= 120 AND $line['E_magique'] <= 139)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >= 140 AND $line['E_magique'] <= 159) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >= 160 AND $line['E_magique'] <= 179) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >= 180 AND $line['E_magique'] <= 199) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 200) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 4) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 29) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >= 30 AND $line['E_magique'] <= 59) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >= 60 AND $line['E_magique'] <= 89) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >= 90 AND $line['E_magique'] <= 119) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >= 120 AND $line['E_magique'] <= 149) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >= 150 AND $line['E_magique'] <= 179) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >= 180 AND $line['E_magique'] <= 209)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >= 210 AND $line['E_magique'] <= 239) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >= 240 AND $line['E_magique'] <= 269) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >= 270 AND $line['E_magique'] <= 299) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 300) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 5) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 39) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >= 40 AND $line['E_magique'] <= 79) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >= 80 AND $line['E_magique'] <= 119) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >= 120 AND $line['E_magique'] <= 159) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >= 160 AND $line['E_magique'] <= 199) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >= 200 AND $line['E_magique'] <= 239) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >= 240 AND $line['E_magique'] <= 279)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >= 280 AND $line['E_magique'] <= 319) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >= 320 AND $line['E_magique'] <= 359) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >= 360 AND $line['E_magique'] <= 399) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 400) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] == 6) {
															if ($line['E_magique'] == 0  AND $line['E_magique'] <= 49) 	{	$tmagie = 0 ;	}
															if ($line['E_magique'] >= 50 AND $line['E_magique'] <= 99) 	{	$tmagie = 10 ;	}
															if ($line['E_magique'] >= 100 AND $line['E_magique'] <= 149) 	{	$tmagie = 20 ;	}
															if ($line['E_magique'] >= 150 AND $line['E_magique'] <= 199) 	{	$tmagie = 30 ;	}
															if ($line['E_magique'] >= 200 AND $line['E_magique'] <= 249) 	{	$tmagie = 40 ;	}
															if ($line['E_magique'] >= 250 AND $line['E_magique'] <= 299) 	{	$tmagie = 50 ;	}
															if ($line['E_magique'] >= 300 AND $line['E_magique'] <= 349)	{	$tmagie = 60 ;	}
															if ($line['E_magique'] >= 350 AND $line['E_magique'] <= 399) 	{	$tmagie = 70 ;	}
															if ($line['E_magique'] >= 400 AND $line['E_magique'] <= 449) 	{	$tmagie = 80 ;	}
															if ($line['E_magique'] >= 450 AND $line['E_magique'] <= 499) 	{	$tmagie = 90 ;	}
															if ($line['E_magique'] == 500) 	{	$tmagie = 100 ;	}
														}
														if ($line['magie_rank'] >= 7) { $tmagie = 'inf';}
													?>	
												<td>
													<img src="includes/img/magie/EM_<? echo $tmagie ?>.png" title="<?= $line['E_magique']?> PM restants !" alt="Energie Magique" />
												</td>
												<td>
													
													<?
														if ($line['magie_rank'] == 0) { $lmagie = 50; }
														if ($line['magie_rank'] == 1) { $lmagie = 100; }
														if ($line['magie_rank'] == 2) { $lmagie = 150; }
														if ($line['magie_rank'] == 3) { $lmagie = 200; }
														if ($line['magie_rank'] == 4) { $lmagie = 300; }
														if ($line['magie_rank'] == 5) { $lmagie = 400; }
														if ($line['magie_rank'] == 6) { $lmagie = 500; }	
													?>
													
													<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
														<? if ($line['E_magique'] <= $lmagie -1 ) { ?>
														<input type="submit" name="plus1" style="color: green" value="[+1]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_magique'] < $lmagie -5) { ?>
														<input type="submit" name="plus5" style="color: green" value="[+5]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_magique'] < $lmagie -10) { ?>
														<input type="submit" name="plus10" style="color: green" value="[+10]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_magique'] < $lmagie -50) { ?>
														<input type="submit" name="plus50" style="color: green" value="[+50]" id="upgrade_button" /> <? } ?>
														<br /><? if ($line['E_magique'] >= 1 ) { ?>
														<input type="submit" name="moins1" style="color: red" value="[-1]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_magique'] >= 5 ) { ?>
														<input type="submit" name="moins5" style="color: red" value="[-5]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_magique'] >= 10 ) { ?>
														<input type="submit" name="moins10" style="color: red" value="[-10]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_magique'] >= 50 ) { ?>
														<input type="submit" name="moins50" style="color: red" value="[-50]" id="upgrade_button" /> <? } ?>
														<?	if(isset($_POST['plus1'])) { echo '<br /><span class="error">PM montés de 1 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique +1 WHERE id = $perso");		}
															if(isset($_POST['plus5'])) { echo '<br /><span class="error">PM montés de 5 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique +5 WHERE id = $perso");		}
															if(isset($_POST['plus10'])) { echo '<br /><span class="error">PM montés de 10 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique +10 WHERE id = $perso");		}
															if(isset($_POST['plus50'])) { echo '<br /><span class="error">PM montés de 50 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique +50 WHERE id = $perso");		}
															if(isset($_POST['moins1'])) { echo '<br /><span class="error">PM descendus de 1 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique -1 WHERE id = $perso");		}
															if(isset($_POST['moins5'])) { echo '<br /><span class="error">PM descendus de 5 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique -5 WHERE id = $perso");		}
															if(isset($_POST['moins10'])) { echo '<br /><span class="error">PM descendus de 10 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique -10 WHERE id = $perso");		}
															if(isset($_POST['moins50'])) { echo '<br /><span class="error">PM descendus de 50 !</span>';	$db->exec("UPDATE members SET E_magique = E_magique -50 WHERE id = $perso");		}?>
													</form>
												</td>
											</tr>
											<tr>
												<th>Energie Vitale :</th>
													<?
															if ($line['E_vitale'] == 0  AND $line['E_vitale'] <= 19) 	{	$tvie = 0 ;	}
															if ($line['E_vitale'] >= 20 AND $line['E_vitale'] <= 39) 	{	$tvie = 10 ;	}
															if ($line['E_vitale'] >= 40 AND $line['E_vitale'] <= 59) 	{	$tvie = 20 ;	}
															if ($line['E_vitale'] >= 60 AND $line['E_vitale'] <= 79) 	{	$tvie = 30 ;	}
															if ($line['E_vitale'] >= 80 AND $line['E_vitale'] <= 99) 	{	$tvie = 40 ;	}
															if ($line['E_vitale'] >= 100 AND $line['E_vitale'] <= 119) 	{	$tvie = 50 ;	}
															if ($line['E_vitale'] >= 120 AND $line['E_vitale'] <= 139)	{	$tvie = 60 ;	}
															if ($line['E_vitale'] >= 140 AND $line['E_vitale'] <= 159) 	{	$tvie = 70 ;	}
															if ($line['E_vitale'] >= 160 AND $line['E_vitale'] <= 179) 	{	$tvie = 80 ;	}
															if ($line['E_vitale'] >= 180 AND $line['E_vitale'] <= 199) 	{	$tvie = 90 ;	}
															if ($line['E_vitale'] == 200) 	{	$tvie = 100 ;	}
													?>
												<td>
												<img src="includes/img/magie/EV_<? echo $tvie ?>.png" title="<?= $line['E_vitale']?> PV restants !" alt="Energie Magique" />
												</td>
												<td>
													<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
														<? if ($line['E_vitale'] <= 199 ) { ?>
														<input type="submit" name="vplus1" style="color: green" value="[+1]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_vitale'] < 195) { ?>
														<input type="submit" name="vplus5" style="color: green" value="[+5]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_vitale'] < 190) { ?>
														<input type="submit" name="vplus10" style="color: green" value="[+10]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_vitale'] < 150) { ?>
														<input type="submit" name="plus50" style="color: green" value="[+50]" id="upgrade_button" /> <? } ?>
														<br /><? if ($line['E_vitale'] >= 1 ) { ?>
														<input type="submit" name="vmoins1" style="color: red" value="[-1]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_vitale'] >= 5 ) { ?>
														<input type="submit" name="vmoins5" style="color: red" value="[-5]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_vitale'] >= 10 ) { ?>
														<input type="submit" name="vmoins10" style="color: red" value="[-10]" id="upgrade_button" /> <? } ?>
														<? if ($line['E_vitale'] >= 50 ) { ?>
														<input type="submit" name="vmoins50" style="color: red" value="[-50]" id="upgrade_button" /> <? } ?>
														<?	if(isset($_POST['vplus1'])) { echo '<br /><span class="error">PV montés de 1 !</span>';	$db->exec("UPDATE members SET E_vitale = E_vitale +1 WHERE id = $perso");		}
															if(isset($_POST['vplus5'])) { echo '<br /><span class="error">PV montés de 5 !</span>';	$db->exec("UPDATE members SET E_vitale = E_vitale +5 WHERE id = $perso");		}
															if(isset($_POST['vplus10'])) { echo '<br /><span class="error">PV montés de 10 !</span>';	$db->exec("UPDATE members SET E_vitale = E_vitale +10 WHERE id = $perso");		}
															if(isset($_POST['vplus50'])) { echo '<br /><span class="error">PV montés de 50 !</span>';	$db->exec("UPDATE members SET E_vitale = E_vitale +50 WHERE id = $perso");		}
															if(isset($_POST['vmoins1'])) { echo '<br /><span class="error">PV descendus de 1 !</span>';	$db->exec("UPDATE members SET E_vitale = E_vitale -1 WHERE id = $perso");		}
															if(isset($_POST['vmoins5'])) { echo '<br /><span class="error">Pv descendus de 5 !</span>';	$db->exec("UPDATE members SET E_vitale = E_vitale -5 WHERE id = $perso");		}
															if(isset($_POST['vmoins10'])) { echo '<br /><span class="error">PV descendus de 10 !</span>';	$db->exec("UPDATE members SET E_vitale = E_vitale -10 WHERE id = $perso");		}
															if(isset($_POST['vmoins50'])) { echo '<br /><span class="error">PV descendus de 50 !</span>';	$db->exec("UPDATE members SET E_vitale = E_vitale -50 WHERE id = $perso");		}?>
													</form>
												</td>
											</tr>
											<tr>
												<th>Race : </th>
													<td>
														<?= $line['race']?>
													</td>
													<td>
														<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
															<input type="submit" name="racehum" value="[Humain]" id="upgrade_button" />
															<input type="submit" name="racechim" value="[Chimère]" id="upgrade_button" />
															<input type="submit" name="raceonyx" value="[Onyx]" id="upgrade_button" />
															<input type="submit" name="racestrom" value="[Stromnole]" id="upgrade_button" />
															<input type="submit" name="raceorq" value="[Orque]" id="upgrade_button" />
															<input type="submit" name="racenain" value="[Nain]" id="upgrade_button" />
															<input type="submit" name="raceern" value="[Ernelien]" id="upgrade_button" />
															<input type="submit" name="racespe" value="[Spécial]" id="upgrade_button" /> 
																<?if(isset($_POST['racehum'])) { echo '<br /><span class="error">Race changée !</span>';	$db->exec("UPDATE members SET race = 'Humain' WHERE id = $perso");		}
																if(isset($_POST['racechim'])) { echo '<br /><span class="error">Race changée !</span>';		$db->exec("UPDATE members SET race = 'Chimère' WHERE id = $perso");		}
																if(isset($_POST['raceonyx'])) { echo '<br /><span class="error">Race changée !</span>';		$db->exec("UPDATE members SET race = 'Onyx' WHERE id = $perso");		}
																if(isset($_POST['racestrom'])) { echo '<br /><span class="error">Race changée !</span>';	$db->exec("UPDATE members SET race = 'Stromnole' WHERE id = $perso");	}
																if(isset($_POST['raceorq'])) { echo '<br /><span class="error">Race changée !</span>';		$db->exec("UPDATE members SET race = 'Orque' WHERE id = $perso");		}
																if(isset($_POST['racenain'])) { echo '<br /><span class="error">Race changée !</span>';		$db->exec("UPDATE members SET race = 'Nain' WHERE id = $perso");		}
																if(isset($_POST['raceern'])) { echo '<br /><span class="error">Race changée !</span>';		$db->exec("UPDATE members SET race = 'Ernelien' WHERE id = $perso");	}
																if(isset($_POST['racespe'])) { echo '<br /><span class="error">Race changée !</span>';		$db->exec("UPDATE members SET race = 'Spécial' WHERE id = $perso");		}?>
														</form>
													</td>
											</tr>
											<tr>
												<th>Pseudo Minecraft : </th>
													<td>
														<?= $line['Minecraft_Account']?>
													</td>
													<td>
														<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>">
															<input type="text" name="pseudo" placeholder="Nouveau Compte" /><input type="submit" value="Valider" />
																<?php 

																if(!empty($_POST['pseudo']))
																{
																	$db->exec('UPDATE members SET Minecraft_Account = \'' .$_POST['pseudo']. '\' WHERE id = \'' .$perso. '\'');
																	echo '<span class="error">Le compte minecraft a été changé.</span>';
																}
																?>
														</form>
													</td>
											</tr>
											<tr>
												<th>Arrivé(e) le : </th>
													<td>
														<?= $line['registration_date']?>
													</td>
											</tr>
											<tr>
												<th>Invisibilité : </th>
													<td>
														<img src="pics/vanish<?= $line['invisible']?>.gif" alt="Icone d'Invisibilité" />
													</td>
													<td>
														<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
																<?php if ($line['invisible'] == 0) { ?>
															<input type="submit" name="vanishon" value="[ON]" style="color:green" id="upgrade_button" />	<? } ?>
																<?php if ($line['invisible'] == 1) { ?>
															<input type="submit" name="vanishoff" value="[OFF]" style="color:red" id="upgrade_button" />	<? } ?>
																<?if(isset($_POST['vanishon'])) { echo '<span class="error">Mode invisible activé !</span>'; 	$db->exec("UPDATE members SET invisible = 1 WHERE id = $perso");	}
																if(isset($_POST['vanishoff'])) { echo '<span class="error">Mode invisible desactivé !</span>';	$db->exec("UPDATE members SET invisible = 0 WHERE id = $perso");	}?>
														</form>
													</td>
											</tr>
											<tr>
												<th>Pratique de la Magie : </th>
													<td>
														<img src="pics/magieok_<?= ($line['magieok'])?>.gif" alt="Magie Maîtrisée ou non" />
													</td>
													<td>
														<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
																<?php if ($line['magieok'] == 0) { ?>
															<input type="submit" name="magieon" value="[ON]" style="color:green" id="upgrade_button" />	<? } ?>
																<?php if ($line['magieok'] == 1) { ?>
															<input type="submit" name="magieoff" value="[OFF]" style="color:red" id="upgrade_button" />	<? } ?>
																<?if(isset($_POST['magieon'])) { echo '<span class="error">Magie maîtrisée !</span>'; 	$db->exec("UPDATE members SET magieok = 1 WHERE id = $perso");	}
																if(isset($_POST['magieoff'])) { echo '<span class="error">Magie Perdue.</span>';	$db->exec("UPDATE members SET magieok = 0 WHERE id = $perso");	}?>
														</form>
													</td>
											</tr>
											<tr>
											<th>Spécialisation Magique : </th>
													<td>
														<img src="pics/spe_<?= ($line['specialisation'])?>" class="magie_type" alt="Spécialisation" />
													</td>
													<td>
														 <form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
															<input type="submit" name="speeau" value="Eau" id="upgrade_button" />
															<input type="submit" name="speelec" value="Elec" id="upgrade_button" />
															<input type="submit" name="spefeu" value="Feu" id="upgrade_button" />
															<input type="submit" name="spelum" value="Lumière" id="upgrade_button" />
															<input type="submit" name="spespe" value="Spéciale" id="upgrade_button" />
															<input type="submit" name="speten" value="Ténèbres" id="upgrade_button" />
															<input type="submit" name="speter" value="Terre" id="upgrade_button" />
															<input type="submit" name="spevent" value="Vent" id="upgrade_button" />
																<?
																if(isset($_POST['speeau'])) { echo '<span class="error">Spécialisation changée !</span>'; 	$db->exec("UPDATE members SET specialisation = 'Eau' WHERE id = $perso");	}
																if(isset($_POST['speelec'])) { echo '<span class="error">Spécialisation changée !</span>';	$db->exec("UPDATE members SET specialisation = 'Elec' WHERE id = $perso");	}
																if(isset($_POST['spefeu'])) { echo '<span class="error">Spécialisation changée !</span>'; 	$db->exec("UPDATE members SET specialisation = 'Feu' WHERE id = $perso");	}
																if(isset($_POST['spelum'])) { echo '<span class="error">Spécialisation changée !</span>';	$db->exec("UPDATE members SET specialisation = 'Lumière' WHERE id = $perso");	}
																if(isset($_POST['spespe'])) { echo '<span class="error">Spécialisation changée !</span>'; 	$db->exec("UPDATE members SET specialisation = 'Spéciale' WHERE id = $perso");	}
																if(isset($_POST['speten'])) { echo '<span class="error">Spécialisation changée !</span>';	$db->exec("UPDATE members SET specialisation = 'Ténèbres' WHERE id = $perso");	}
																if(isset($_POST['speter'])) { echo '<span class="error">Spécialisation changée !</span>'; 	$db->exec("UPDATE members SET specialisation = 'Terre' WHERE id = $perso");	}
																if(isset($_POST['spevent'])) { echo '<span class="error">Spécialisation changée !</span>';	$db->exec("UPDATE members SET specialisation = 'Vent' WHERE id = $perso");	}
																?>
														</form>
													</td>
											</tr>
											<tr>
												<th>Niveau Magique : </th>
													<td>
													<img src="pics/magie_rank_<?= $line['magie_rank']?>.gif" alt="Mage de niveau <?= ($line["magie_rank"])?>"/>	
													</td>
													<td>
														<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
																<?php if ($line['magie_rank'] < 9) { ?>
															<input type="submit" name="rankup" value="UP" style="color:green" id="upgrade_button" /> <? } ?>
																<?php if ($line['magie_rank'] > 0) { ?>
															<input type="submit" name="rankdown" value="DOWN" style="color:red" id="upgrade_button" /> <? } ?>
																<?if(isset($_POST['rankup'])) { echo '<span class="error">Niveau monté !</span>'; 	$db->exec("UPDATE members SET magie_rank = magie_rank + 1 WHERE id = $perso"); $db->exec("INSERT INTO chatbox (post_date, user_id, message) VALUES (NOW(), 92, 'Tuduung !~ $nom gagne un niveau !')");	}
																if(isset($_POST['rankdown'])) { echo '<span class="error">Niveau descendu !</span>';	$db->exec("UPDATE members SET magie_rank = magie_rank - 1  WHERE id = $perso");	}?>
														</form>
														
													</td>
											</tr>
											<tr>
												<th>Cycle de Vie : </th>
													<td>
														<img src="pics/hardcore<?= ($line['hardcore'])?>.png" alt="Icone de Remortalité" />
													</td>
													<td>
														<form method="POST" action="index.php?p=viewmember&perso=<? echo $perso?>" class="grade_form">
																<?php if ($line['hardcore'] == 1) { ?>
															<input type="submit" name="remortel" value="[Remortel]" style="color:green" id="upgrade_button" />	<? } ?>
																<?php if ($line['hardcore'] == 1) { ?>
															<input type="submit" name="mortdef" value="[Tuer]" style="color:orange" id="upgrade_button" />	<? } ?>
																<?php if ($line['hardcore'] == 0) { ?>
															<input type="submit" name="mortel" value="[Mortel]" style="color:red" id="upgrade_button" />	<? } ?>
																<?if(isset($_POST['mortel'])) { echo '<span class="error">Remortalité retirée !</span>'; 	$db->exec("UPDATE members SET hardcore = 1 WHERE id = $perso");	}
																if(isset($_POST['remortel'])) { echo '<span class="error">Remortalité donnée !</span>';	$db->exec("UPDATE members SET hardcore = 0 WHERE id = $perso");	}
																if(isset($_POST['mortdef'])) { echo '<span class="error">Personnage mort définitivement !</span>';	$db->exec("UPDATE members SET title = 'Mort' WHERE id = $perso");	}?>
														</form>
													</td>
											</tr>
										</tbody>
									</table>
								<p>	</p>
							</td>
						</tr>
						<tr>
							<td>
								<img src="pics/persobottom.png" />
							</td>
						</tr>
					</tbody>
				</table>
			</center>
		<br />
		
		BackGround <? if ($line['valid_bg'] == 1) { ?> <img src="pics/valid_bg_on.gif" alt="BG Validé" title="Background RolePlay vérifié par le Staff" /><? }?><br />
		<br /><section id="background">
		<?= $line['background']?>
		</section>
		
		<p>
		<?php if ($_SESSION["rank"] >= 4) { ?> <a href="index.php?p=perso&amp;perso=<?= $line['id']?>">Ancienne version de la page</a><? } ?>
		</p>
	
	
	<? } }
	}}
?>
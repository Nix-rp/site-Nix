<?php function bg_admin_child ($child_uuid) { ?>
	<?php
		global $db, $_SESSION, $_GET;
		
		$p_category = (isset($_GET['p2'])) ? $_GET['p2'] : false;
		$p_content = (isset($_GET['p3'])) ? $_GET['p3'] : false;
		$p_action = (isset($_GET['p4'])) ? $_GET['p4'] : false;
	?>
	<?php if ($_SESSION['connected']) { ?>
		<?php if ($_SESSION['rank'] >= 4) { ?>
				<?php
					$answer_child = $db->query('SELECT COUNT(*) AS categories FROM t_bg_category WHERE uuid = '.$child_uuid.' ORDER BY name') or die(mysql_error());
					$line_child = $answer_child->fetch() or die(mysql_error());
					$answer_child->closeCursor();
				?>
				<?php if ($line_child["categories"] > 0) { ?>
					<?php
						$answer2_child = $db->query('SELECT * FROM t_bg_category WHERE uuid = '.$child_uuid.' ORDER BY name') or die(mysql_error());
						//$line2_child = $answer2_child->fetch() or die(mysql_error());
					?>
					<h3><?php bg_admin_child_cur_category($p_category); ?></h3>
					<?php while ( $line2_child = $answer2_child->fetch()) { ?>
						<?php bg_admin_child_get_child($line2_child['uuid']); ?>
					<?php } ?>
				<?php } else { ?>
					<span>Shit Happened lvl admin child</span>
				<?php } ?>
		<?php } else { ?>
			<span>Shit Happened lvl rank</span>
		<?php } ?>
	<?php } else { ?>
		<span>Vous devez être connecté pour accéder à cette page</span>
	<?php } ?>
<?php } ?>

<?php function bg_admin_child_cur_category ($name) { ?>
	<?php
		global $db, $_SESSION, $_GET;
		
		$p_category = (isset($_GET['p2'])) ? $_GET['p2'] : false;
		$p_content = (isset($_GET['p3'])) ? $_GET['p3'] : false;
		$p_action = (isset($_GET['p4'])) ? $_GET['p4'] : false;
	?>
	<?php if ($_SESSION['connected']) { ?>
		<?php if ($_SESSION['rank'] >= 4) { ?>
			<span>+ => <?php echo $name ?></span>
		<?php } else { ?>
			<span>Shit Happened lvl rank</span>
		<?php } ?>
	<?php } else { ?>
		<span>Vous devez être connecté pour accéder à cette page</span>
	<?php } ?>
<?php } ?>

<?php function bg_admin_child_link_category ($name) { ?>
	<?php
		global $db, $_SESSION, $_GET;
		
		$p_category = (isset($_GET['p2'])) ? $_GET['p2'] : false;
		$p_content = (isset($_GET['p3'])) ? $_GET['p3'] : false;
		$p_action = (isset($_GET['p4'])) ? $_GET['p4'] : false;
	?>
	<?php if ($_SESSION['connected']) { ?>
		<?php if ($_SESSION['rank'] >= 4) { ?>
			<a href="index.php?p=bg_admin&p2=<?php echo $name ?>">+ <?php echo $name ?></a>
		<?php } else { ?>
			<span>Shit Happened lvl rank</span>
		<?php } ?>
	<?php } else { ?>
		<span>Vous devez être connecté pour accéder à cette page</span>
	<?php } ?>
<?php } ?>

<?php function bg_admin_child_get_child ($parent_uuid) { ?>
	<?php
		global $db, $_SESSION, $_GET;
		
		$p_category = (isset($_GET['p2'])) ? $_GET['p2'] : false;
		$p_content = (isset($_GET['p3'])) ? $_GET['p3'] : false;
		$p_action = (isset($_GET['p4'])) ? $_GET['p4'] : false;
	?>
	<?php if ($_SESSION['connected']) { ?>
		<?php if ($_SESSION['rank'] >= 4) { ?>
				<?php
					$answer_child = $db->query('SELECT COUNT(*) AS children FROM t_bg_category_parent WHERE fk_uuid_parent = '.$parent_uuid.'') or die(mysql_error());
					$line_child = $answer_child->fetch() or die(mysql_error());
					$answer_child->closeCursor();
				?>
				<?php if ($line_child["children"] > 0) { ?>
					<?php
						$answer2_child = $db->query('SELECT * FROM t_bg_category_parent WHERE fk_uuid_parent = '.$parent_uuid.'') or die(mysql_error());
						//$line2_child = $answer2_child->fetch() or die(mysql_error());
					?>
					<ul>
						<?php while ( $line2_child = $answer2_child->fetch()) { ?>
							<?php
								$answer3_child = $db->query('SELECT COUNT(*) AS categories FROM t_bg_category WHERE uuid = '.$line2_child['fk_uuid_category'].'') or die(mysql_error());
								$line3_child = $answer3_child->fetch() or die(mysql_error());
								$answer3_child->closeCursor();
							?>
							<?php if ($line3_child["categories"] > 0) { ?>
								<?php
									$answer4_child = $db->query('SELECT * FROM t_bg_category WHERE uuid = '.$line2_child['fk_uuid_category'].'') or die(mysql_error());
									//$line4_child = $answer4_child->fetch() or die(mysql_error());
								?>
								<?php while ( $line4_child = $answer4_child->fetch()){ ?>
									<li style="padding-left: 15px;">
										<?php if ($p_category == $line4_child['name']) { ?>
											<?php bg_admin_child_cur_category($line4_child['name']); ?>
										<?php } else { ?>
											<?php bg_admin_child_link_category($line4_child['name']); ?>
										<?php } ?>
									</li>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</ul>
				<?php } ?>
		<?php } else { ?>
			<span>Shit Happened lvl rank</span>
		<?php } ?>
	<?php } else { ?>
		<span>Vous devez être connecté pour accéder à cette page</span>
	<?php } ?>
<?php } ?>
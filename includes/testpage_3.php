<?php function testpage_3 ()
{
	global $db;
	
	include('includes/interface/JSONapi.php');
		$ip = 'soul.omgcraft.fr';
		$port = 20059;
		$user = "nix";
		$pwd = "dragonball";
		$salt = 'salt';
		$api = new JSONAPI($ip, $port, $user, $pwd, $salt);
		
		if (isset($_GET['action']))
		{
			if ($_GET['test'])
			{
				$api->call("nicknamer.users.set_nick", array("Laura_Dragon", "Dragoniya"));
			}
		}
		else
		{
			$PlayerNames = $api->call("getPlayerNames");
			if ($PlayerNames)
			{
				$mc = ($PlayerNames['success']);
				
			}
			else
			{
				echo '<p>Aucun joueur n\'est connecté.</p>';
			}
			echo '<a href="index?p=testpage_3&action=test">Test /nick</a>';	
		}
		

}
?>

<?php function testpage_3 ()
{
?>
<style>
 ul ul {display: none; position: absolute;top: -1 li; left: -10px; margin: 0px; padding: 0px;}
li {list-style-type: none; position: relative;}
li:hover ul.menu2, li li:hover ul.niveau3 {display: block}
.menu1
{
	background-color: #8080ee;
	line-height: 20px;
	margin-bottom: 16px;
	margin-top: 0;
	padding: 10px;
}
.menu2
{
	background-color: #a0a0ee;
	line-height: 20px;
	margin-bottom: 16px;
	margin-top: 0;
	padding: 0;
	width: 100%;
	padding: 10px;
}
</style>
<div>
  <table cellspacing="0" cellpadding="0" style="background-color:white;" width="100%">
    <tbody>
      <tr>
      	<td>
      		<table cellspacing="0" cellpadding="0">
      			<tbody>
      				<td width="20%">
					<a href="index.php"><img src="pics/logo1.gif" alt="" /></a>
				</td>
				<td style="text-align: right;" width="600%">
					<p>
						News
					</p>
				</td>
				<td width="10%">
					<img src="http://herobrine.fr/blapproved.php?bid=3" title="Approved by BL">
				</td>
				<td width="10%">
					<a href="https://minecraft.net/" target=_blank><img src="http://herobrine.fr/pics/mc1.png" alt="" /></a>
				</td>
      			</tbody>
      		</table>
      	</td>
      </tr>
      <tr>
      	<table cellspacing="0" cellpadding="0" style="background-color:white;" width="100%">
      		<tbody>
      			<tr>
      				<td>
			        	<ul class="menu1">
						<li>
							Acceuil
							<ul class="menu2">
								<a href="index.php" class="link">
									<li>
										Acceuil
									</li>
								</a>
								<a href="index?p=rules" class="link">
									<li>
										Règles
									</li>
								</a>
								<a href="index?p=server" class="link">
									<li>
										Le Serveur
									</li>
								</a>
								<a href="index?p=candid" class="link">
									<li>
										Candidature
									</li>
								</a>
							</ul>
						</li>
					</ul>
			        </td>
			        <td>
			        	<ul class="menu1">
						<li>
							Communauté
							<ul class="menu2">
								<a href="index?p=news" class="link">
									<li>
										Actualités
									</li>
								</a>
								<a href="index?p=members" class="link">
									<li>
										Membres
									</li>
								</a>
								<a href="index?p=forum" class="link">
									<li>
										Forums
									</li>
								</a>
								<a href="index?p=chatbox" class="link">
									<li>
										Dialogue en Direct
									</li>
								</a>
								<a href="index?p=update" class="link">
									<li>
										Info Maintenance
									</li>
								</a>
								<a href="index?p=sondage" class="link">
									<li>
										Sondages
									</li>
								</a>
							</ul>
						</li>
					</ul>
			        </td>
			        <td>
			        	menu C
			        </td>
			        <td>
			        	menu D
			        </td>
      			</tr>
      		</tbody>
      	</table>
      </tr>
      <tr>
        <td>
          Contenu
        </td>
      </tr>
      <tr>
        <td>
          Pied de page
        </td>
      </tr>
    </tbody>
  </table>
</div>
<?php 
}
?>

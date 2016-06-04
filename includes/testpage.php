<?php function testpage()
{
  global $_SESSION, $_POST, $db;
  
  if ($_SESSION['connected'])
  {
    $verif = $db->prepare('SELECT id, testm FROM members WHERE id = ? AND testm = 0');
    $verif->execute(array($_SESSION['id']));
    echo '<h3>Test de Personalité Magique</h3>';
    if ($verif->fetch())
    {
      if (isset($_POST['valid']))
      {
        $air = 0; $arcane = 0;  $chaleur = 0; $chaos = 0; $eau = 0; $espace = 0; $energie = 0;
        $feu = 0; $glace = 0; $lumiere = 0; $metal = 0;  $nature = 0;  $ombre = 0;  $ordre = 0;
        $psy = 0; $terre = 0;  $void = 0;
        if ($_POST['Q1'] == "R1") { $ombre++; } elseif ($_POST['Q1'] == "R2") {$glace++; $eau++; } 
        elseif ($_POST['Q1'] == "R3") {$feu++; $chaos++; } elseif ($_POST['Q1'] == "R4") { $void++; $psy++; $espace++; }
        elseif ($_POST['Q1'] == "R5") { $nature++; } elseif ($_POST['Q1'] == "R6") {$energie++; $arcane++; }
        elseif ($_POST['Q1'] == "R7") {$chaleur++; } elseif ($_POST['Q1'] == "R8") {$lumiere++; $ordre++;}
        elseif ($_POST['Q1'] == "R9") {$terre++;} elseif ($_POST['Q1'] == "R10") {$metal++; $air++;}
        
        if ($_POST['Q2'] == "R1") { $ombre++; } elseif ($_POST['Q2'] == "R2") { $energie++; }
        elseif ($_POST['Q2'] == "R3") { $lumiere++; }  elseif ($_POST['Q2'] == "R4") { $nature++; } 
        elseif ($_POST['Q2'] == "R5") { $terre++; $metal++; }  elseif ($_POST['Q2'] == "R6") { $chaleur++;  $feu++;} 
        elseif ($_POST['Q2'] == "R7") {$glace++;}  elseif ($_POST['Q2'] == "R8") {$ordre++; $arcane++; $psy++;} 
          elseif ($_POST['Q2'] == "R9") {$ordre++; $arcane++; $psy++;} 
        
      # Ombre = 2  Void = 1  Glace = 2  Eau = 2  Feu = 2  Chaos = 1  Psy = 2  Nature = 2  Air = 2 Arcane = 2  Lumière = 2
      # Chaleur = 2  Ordre = 2 Terre = 2  Energie = 2  Espace = 1  Metal = 2
      }
      else
      {
      ?>
        <p>Ce questionnaire vous permettra de définir que élément naturel est lié à votre personnage, répondez-y honnêtement ! Les tentative de triche se feront très vite remarquer en jeu.</p>
        <p>Pensez bien qu'à ce questionnaire, vous devriez répondre comme si c'était votre personnage qui répondait, et non vous, le joueur derrière.</p>
        
        <form method="POST" action="index?p=testpage">
          <p>Quelle couleur pour représente le plus ?</p>
          <input type="radio" name="Q1" value="R1" id="Q1R1" /> <label for="Q1R1" class="name1">Le Noir</label><br />
          <input type="radio" name="Q1" value="R2" id="Q1R2" /> <label for="Q1R2" class="name1" style="color:aqua;">Le Bleu</label><br />
          <input type="radio" name="Q1" value="R3" id="Q1R3" /> <label for="Q1R3" class="name1" style="color:red;">Le Rouge</label><br />
          <input type="radio" name="Q1" value="R4" id="Q1R4" /> <label for="Q1R4" class="name1" style="color:purple;">Le Violet</label><br />
          <input type="radio" name="Q1" value="R5" id="Q1R5" /> <label for="Q1R5" class="name1" style="color:lime;">Le Vert</label><br />
          <input type="radio" name="Q1" value="R6" id="Q1R6" /> <label for="Q1R6" class="name1" style="color:white;">Le Blanc</label><br />
          <input type="radio" name="Q1" value="R7" id="Q1R7" /> <label for="Q1R7" class="name1" style="color:orange;">Le Orange</label><br />
          <input type="radio" name="Q1" value="R8" id="Q1R8" /> <label for="Q1R8" class="name1" style="color:yellow;">Le Jaune</label><br />
          <input type="radio" name="Q1" value="R9" id="Q1R9" /> <label for="Q1R9" class="name1" style="color:brown;">Le Marron</label><br />
          <input type="radio" name="Q1" value="R10" id="Q1R10" /> <label for="Q1R10" class="name1" style="color:silver;">Le Gris</label><br />
          
          <p>Quel objet vous correspond le mieux ?</p>
          <input type="radio" name="Q2" value="R1" id="Q2R1" /> <label for="Q2R1"><img src="pics/items/Ender_Pearl.png" alt="" width="20px" /> La Perle Noire.</label><br />
          <input type="radio" name="Q2" value="R2" id="Q2R2" /> <label for="Q2R2"><img src="pics/items/Lapis-lazuli.png" alt="" width="20px" /> Le Lapis Lazuli.</label><br />
          <input type="radio" name="Q2" value="R3" id="Q2R3" /> <label for="Q2R3"><img src="pics/items/Quartz.png" alt="" width="20px" /> Le Quartz.</label><br />
          <input type="radio" name="Q2" value="R4" id="Q2R4" /> <label for="Q2R4"><img src="pics/items/Flower.png" alt="" width="20px" /> La Fleur.</label><br />
          <input type="radio" name="Q2" value="R5" id="Q2R5" /> <label for="Q2R5"><img src="pics/items/iron_pickaxe.png" alt="" width="20px" /> La Pioche.</label><br />
          <input type="radio" name="Q2" value="R6" id="Q2R6" /> <label for="Q2R6"><img src="pics/items/Briquet.png" alt="" width="20px" /> Le Briquet.</label><br />
          <input type="radio" name="Q2" value="R7" id="Q2R7" /> <label for="Q2R7"><img src="pics/items/Snowball.png" alt="" width="20px" /> La Boule de Neige.</label><br />
          <input type="radio" name="Q2" value="R8" id="Q2R8" /> <label for="Q2R8"><img src="pics/items/XP.gif" alt="" width="20px" /> L'orbe.</label><br />
          <input type="radio" name="Q2" value="R9" id="Q2R9" /> <label for="Q2R9"><img src="pics/items/Elytra.png" alt="" width="20px" /> Le Ailes.</label><br />
      <?php
      }
    }
    else
    {
      echo '<p>Navré, mais vous avez déjà passé ce test.</p>';
    }
  }
  else
  {
    echo '<p>Vous devez vous connecter pour accéder à cette page.</p>';
  }
}
?>

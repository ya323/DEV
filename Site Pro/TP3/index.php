<form id="style_form" action="index.php" method="GET">
<select name="css">
<option value="style1">style1</option>
<option value="style2">style2</option>
</select>
<input type="submit" value="Appliquer" />
</form>
<?php
// Durée de vie du cookie (30 jours)
$cookie_duration = time() + (30 * 24 * 60 * 60);

// Vérification si l'utilisateur a choisi un style
if (isset($_GET['css'])) {
    // Récupérer l'identifiant du style choisi
    $selectedStyle = $_GET['css'];
    
    // Stocker le style dans un cookie pour 30 jours
    setcookie("css_style", $selectedStyle, $cookie_duration);
    
    // Appliquer immédiatement le style sélectionné
    $currentStyle = $selectedStyle;
} elseif (isset($_COOKIE['css_style'])) {
    // Si aucun style n'a été sélectionné, mais qu'un cookie existe, appliquer ce style
    $currentStyle = $_COOKIE['css_style'];
} else {
    // Style par défaut si aucun choix n'a été fait
    $currentStyle = "style1";
}

// Utiliser le style sélectionné ou celui du cookie dans la page HTML
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix du style</title>
    <!-- Appliquer la feuille de style choisie -->
    <link rel="stylesheet" href="css/<?php echo $currentStyle; ?>.css">
</head>
<body>
    <!-- Afficher le formulaire pour choisir le style -->
    <?php include('style_form.php'); ?>
    
    <p>Style actuel : <?php echo $currentStyle; ?></p>
</body>
</html>
<?php
// Durée de vie du cookie (par exemple 30 jours)
$cookie_duration = time() + (30 * 24 * 60 * 60);

// Vérifier si un style a été sélectionné par l'utilisateur via le formulaire
if (isset($_GET['css'])) {
    // Récupérer le style choisi
    $selectedStyle = $_GET['css'];
    
    // Stocker ce style dans un cookie pour 30 jours
    setcookie("css_style", $selectedStyle, $cookie_duration);
    
    // Appliquer immédiatement le style sélectionné
    $currentStyle = $selectedStyle;
} elseif (isset($_COOKIE['css_style'])) {
    // Si aucun style n'a été sélectionné mais qu'un cookie existe, appliquer ce style
    $currentStyle = $_COOKIE['css_style'];
} else {
    // Si aucun cookie n'existe, appliquer un style par défaut
    $currentStyle = "style1";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix du style</title>
    <!-- Inclure la feuille de style en fonction de l'identifiant stocké -->
    <link rel="stylesheet" href="css/<?php echo $currentStyle; ?>.css">
</head>
<body>

    <!-- Formulaire pour choisir le style -->
    <form id="style_form" action="index.php" method="GET">
        <select name="css">
            <option value="style1" <?php if ($currentStyle == 'style1') echo 'selected'; ?>>style1</option>
            <option value="style2" <?php if ($currentStyle == 'style2') echo 'selected'; ?>>style2</option>
        </select>
        <input type="submit" value="Appliquer" />
    </form>

    <p>Le style actuel est : <?php echo $currentStyle; ?></p>

</body>
</html>

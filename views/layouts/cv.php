<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Développement Web, jeremie-genet.fr">
    <meta name="author" content="Jérémie Genet">
    <!-- Icon du site -->
    <link rel="shortcut icon" href="logo.png">

    <title>
        <?= $title ?? 'mon site' ?>
    </title>

    <!-- Font utilisées pour le CV -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.css">
    <!-- Fontawesome -->
    <link href="../../assets/plugins/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../../assets/plugins/fontawesome/css/brands.css" rel="stylesheet">
    <link href="../../assets/plugins/fontawesome/css/solid.css" rel="stylesheet">
    <!-- CSS du cv -->
    <link rel="stylesheet" href="../../assets/css/cv/cv.css">
    
</head>
<body>

<header id="header" class="header">

    <!-- Contenu du CV -->
    <?= $content ?>

</div>

    <!-- JAVASCRIPT -->  
    <!-- Jquery v3.3.1 (utile au fonctionnement de bootstrap, et de jquery.scrollTo) -->        
    <script type="text/javascript" src="../../assets/plugins/jquery-3.3.1.min.js"></script>
    <!-- Utile au fonctionnement du scroll de jquery.scrollTo.js -->
    <script type="text/javascript" src="../../assets/plugins/jquery-scrollTo/jquery.scrollTo.js"></script>
    <!-- Javascript utile au fonctionnement de Bootstrap -->
    <script type="text/javascript" src="../../assets/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Gestion du scroll de la page en jquery (class 'scrollto') -->
    <script type="text/javascript" src="../../assets/js/common/scroll-navigation.js"></script>

    
</body>
</html>
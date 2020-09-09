<?php
/*
    PAGE QUI GERE LES URLS qui n'existent pas (non définis dans la page index.php)
*/

// On signifie aux navigateurs que cette page est une redirection de type 404 (permet aux navigateur de ne pas indexer cette page)
http_response_code(404);
?>


<div class="container">

    <h1 class="text-center p-5"><strong>Page introuvable (e.404.php)</strong></h1>

</div>


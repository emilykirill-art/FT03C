<?php
    session_start();
    echo "Utilizador: ". $_SESSION['userNome'];
?>
<br>
<a href="sair.php">Sair</a>
<?php

require 'model/PostManager.php';

try {
    $billets = getBillets();
    require 'VoirPlusView.php';
}
catch (Exception $e) {
    $msgErreur = $e->getMessage();
    require 'errorView.php';
}

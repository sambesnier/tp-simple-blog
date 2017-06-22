<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 09:58
 */

// Call renderView function
renderView(
    'home',
    [
        'pageTitle' => 'Bienvenue sur mon blog',
        'now' => date('l jS \of F Y h:i:s A')
    ]
);
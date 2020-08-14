<?php

/**
 * Main command script, runs an action based on command parameter
 * usage: main.php [command]
 * commands:
 *      readList: show list of contacts
 *      createBatch: create 10 contacts
 */

include_once 'P1.php';
include_once 'P2.php';

// P1 object instance
$p1 = new P1();
// P2 object instance
$p2 = new P2("https://api.softwareavanzado.world/index.php?option=token&api=oauth2");

if(count($argv) > 1){ // it has a command parameter?
    switch($argv[1]){
        case "readList":
            $token = $p2->getClientCredentialsToken('sa', 'fb5089840031449f1a4bf2c91c2bd2261d5b2f122bd8754ffe23be17b107b8eb103b441de3771745');
            $p1->setBearerToken($token);
            $p1->readList();
        break;
        case "createBatch":
            $token = $p2->getClientCredentialsToken('sa', 'fb5089840031449f1a4bf2c91c2bd2261d5b2f122bd8754ffe23be17b107b8eb103b441de3771745');
            $p1->setBearerToken($token);
            $p1->createBatch();
        break;
    } // switch
} else { // if not shows usage
    echo "usage: main.php [command]\n";
    echo "commands:\n";
    echo "\treadList: show list of contacts\n";
    echo "\tcreateBatch: creates a batch of 10 contacts\n";
} // else
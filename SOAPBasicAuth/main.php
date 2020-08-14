<?php

/**
 * Main command script, runs an action based on command parameter
 * usage: main.php [command]
 * commands:
 *      readList: show list of contacts
 *      createBatch: create 10 contacts
 */

include_once 'P1.php';

// P1 object instance
$p1 = new P1("https://api.softwareavanzado.world/administrator/index.php?webserviceClient=administrator&webserviceVersion=1.0.0&option=contact&api=soap", "sa", "usac");

if(count($argv) > 1){ // it has a command parameter?
    switch($argv[1]){
        case "readList":
            $p1->readList("201404007");
        break;
        case "createBatch":
            $p1->createBatch();
        break;
    } // switch
} else { // if not shows usage
    echo "usage: main.php [command]\n";
    echo "commands:\n";
    echo "\treadList: show list of contacts\n";
    echo "\tcreateBatch: creates a batch of 10 contacts\n";
} // else
<?php

include 'P1.php';

$p1 = new P1("https://api.softwareavanzado.world/administrator/index.php?webserviceClient=administrator&webserviceVersion=1.0.0&option=contact&api=soap");

if(count($argv) > 1){
    switch($argv[1]){
        case "readList":
            $p1->readList("201404007");
        break;
        case "createBatch":
            $p1->createBatch();
        break;
    } // switch
} else {
    echo "usage: main.php [command]\n";
    echo "commands:\n";
    echo "\treadList: show list of contacts\n";
    echo "\tcreateBatch: creates a batch of 10 contacts\n";
} // else
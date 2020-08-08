# P1 Software Avanzado

PHP command script to send SOAP requests.

## Prerequisites
1. PHP 7.2
2. PHP XML
3. PHP XSL
4. PHP CURL

## Description

The script sends two possible SOAP request to a Contact Webservice:
1. Read list of contacts
2. Create a batch of ten contacts

## Usage

In the terminal run: **php main.php *[command]*** where command can be:
* readList: displays the list of contacts returned by the web service
* createBatch: creates a batch of ten contacts, sending one by one to the web service. 



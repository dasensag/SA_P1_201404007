# P2 Software Avanzado

PHP command script app to create and list contacts. There are two variants of the command script app:
1. ClientCredentials
2. SOAPBasicAuth

## ClientCredentials

This app sends requests to the web service wiht REST format, it also uses Client Credentials Protocol for authentication.
1. First, it sends a request asking for the token with a client ID and a client secret
2. Then, it sends the request to the web service adding the token to the headers

## SOAPBasicAuth

This app sends requests to the web service with SOAP format, it also uses Basic Authentication.
* It sends a header with the username and password encrypted in base64

## Prerequisites
1. PHP 7.2
2. PHP XML
3. PHP XSL
4. PHP CURL

## Description

Both script apps can send two possible request to a Contact Webservice:
1. Read list of contacts
2. Create a batch of ten contacts

## Usage

Both apps have the same commands it only changes the way the comunicate with the web service.

In the terminal run: **php main.php *[command]*** where command can be:
* **readList**: displays the list of contacts returned by the web service
* **createBatch**: creates a ba
tch of ten contacts, sending one by one to the web service. 



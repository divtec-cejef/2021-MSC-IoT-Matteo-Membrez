# Transmission des messages

Le but de cette section est de configurer le backend Sigfox pour qu'il reçoive la température et l'humidité via le capteur placé sur la plaque Arduino.

## Configuration du backend SigFox

1. Editer votre appareil SigFox

2. Dans "Event Configuration"  cliquer sur "New" en haut à droite

   ![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/message/CreerEvent.jpg)

   1. Choisir le type d'événement "Receive first test message"
   2. Choisir le canal "Email" et entrer son email
   3. Terminer la configuration de l'événement en cliquant sur "Ok"

Les messages reçus devraient maintenant apparaître dans l'onglet "Messages"

![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/message/message.jpg)

## Code

Pour envoyer le message, il faut exécuter un code sur l'Arduino qui procédera à l'envoie du message.


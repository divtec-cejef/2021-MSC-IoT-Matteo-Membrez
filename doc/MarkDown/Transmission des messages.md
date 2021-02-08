# Transmission des messages

Le but de cette section est de configurer le backend Sigfox pour qu'il reçoive la température et l'humidité via le capteur placé sur la plaque Arduino. Cette mesure devra ensuite être envoyée par email à l'adresse choisie.

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

Pour envoyer le message, il faut exécuter un code sur l'Arduino qui procédera à l'envoie du message. Ce code permet d'envoyer un message à une intervale régulière. Cette intervale peut être changée en fin de code.

```c
#include <SigFox.h>
#include "DHT.h"

#define DHTPIN 2

#define DHTTYPE DHT11

typedef struct __attribute__ ((packed)) sigfox_message { // see http://www.catb.org/esr/structure-packing/#_structure_alignment_and_padding
  int16_t moduleTemperature;
} SigfoxMessage;

// stub for message which will be sent
SigfoxMessage msg;

// =================== UTILITIES ===================
void reboot() {
  NVIC_SystemReset();
  while (1);
}
// =================================================

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);

  dht.begin();

  if (!SigFox.begin()) {
    Serial.println("SigFox error, rebooting");
    reboot();
  }

  delay(100); // Wait at least 30ms after first configuration

}

void loop() {
  // Enable debug prints and LED indication
  SigFox.debug();
  SigFox.begin();
  
  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  float f = dht.readTemperature(true);

  // Check if any reads failed and exit early (to try again).
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }

  // Compute heat index in Fahrenheit (the default)
  float hif = dht.computeHeatIndex(f, h);
  // Compute heat index in Celsius (isFahreheit = false)
  float hic = dht.computeHeatIndex(t, h, false);

  Serial.print(F("Humidity: "));
  Serial.print(h);
  Serial.print(F("%  Temperature: "));
  Serial.print(t);
  Serial.print(F("°C\n"));

  // Clears all pending interrupts
  SigFox.status(); 
  delay(1);

  // Send the data
  SigFox.beginPacket();
  SigFox.write(t);
  SigFox.write(h);

  Serial.print("Status: ");
  Serial.println(SigFox.endPacket());

  SigFox.end();
  
  // Intervale en millisecondes
  delay(3600000);
}
```

## Décryptage hexadécimal

Le message envoyé à SigFox est reçu en hexadécimal, il serait pratique de pouvoir voir la température et l'humidité directement, sans avoir à aller convertir le code hexadécimal dans un convertisseur sur internet. SigFox donne la possibilité de convertir directement à la réception du message. Pour réaliser cette conversion, il faut se rendre dans son **Device Type**. Dans la configuration se trouve une section **Payload display**, Cette section permet de réaliser cette conversion. Etant donné que dans mon code je renvoie à SigFox des valeurs de type **float**, je dois utiliser une syntaxe de conversion pour les types float. Voici un aperçu de cette syntaxe :

> temperature::float:32:little-endian humidity::float:32:little-endian

![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/message/decryptage.jpg)

## Configuration du CallBack

Le CallBack est une fonctionnalité de SigFox qui permet d'envoyer un email à une adresse indiquée à chaque fois qu'un nouveau message est reçu par SigFox. Ce message est personnalisable, on peut donc y transmettre toutes sortes d'informations. Dans mon cas, je souhaite transmettre la température et l'humidité.

Pour configurer le CallBack, il faut se rendre dans son **Device Type**, puis dans l'onglet **CallBacks**. Dans cet onglet il faut créer un nouveau CallBack en appuyant sur le bouton **New** en haut à droite de la page. Cette page se présente sous la forme d'un formulaire à remplir. Voici comment j'ai configuré le CallBack pour qu'il me transmette la température et l'humidité à chaque fois qu'un messsage est reçu :

![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/message/CallBack.jpg)

Dans la configuration il faut, comme expliqué précédemment, ajouter la syntaxe de conversion. Il faut également indiquer l'adresse email à laquelle les informations vont être envoyées. Lorsque la conversion sera correctement configurée, deux nouvelles variables devraient apparaître. Ces variables seront la température et l'humidité et elles pourront être utilisé dans le corps du mail pour renvoyer clairement la température et l'humidité.

## Reçu

![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/message/reçu.jpg)
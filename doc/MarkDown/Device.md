# Pré-requis

## Installation des bibliothèques

### SigFox

1. Dans le logiciel Arduino, suivre le chemin : Croquis >  Inclure une bibliothèque > Gérer les bibliothèques
2. Installer la bibliothèque suivante : ![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/device/dlSigFox.jpg)

### ArduinoLowPower

1. Dans le logiciel Arduino, suivre le chemin : Croquis >  Inclure une bibliothèque > Gérer les bibliothèques
2. Installer la bibliothèque suivante :  ![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/device/dlArduinoLowPower.jpg)

# Code

Dans le code, il faut inclure les deux bibliothèques installées. Voici comment effectuer cette manipulation :

```C
#include <SigFox.h>
#include "ArduinoLowPower.h"
```

## Récupération de l'ID et du PAC

Voici un exemple de code permettant de récupérer l'ID et le PAC de notre Arduino :

```C
#include <SigFox.h>
#include "ArduinoLowPower.h"

void setup() {
  Serial.begin(9600);
  while (!Serial) {};

  if (!SigFox.begin()) {
    Serial.println("Unable to init the Atmel ATA8520 Sigfox chipset");
    return;
  }
  SigFox.debug();

  String ID = SigFox.ID();
  String PAC = SigFox.PAC();

  // Display module informations
  Serial.println("MKRFOX1200 informations");
  Serial.print("ID\t");
  Serial.println(SigFox.ID());
  Serial.print("PAC\t");
  Serial.println(SigFox.PAC());

  Serial.println("Register your board on https://buy.sigfox.com/activate");
}

void loop()
{
}
```

## Résultat

Si le code s'est bien effectué, dans le moniteur de série il devrait être inscrit l'ID et le PAC de l'Arduino.

![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/device/ID_PAC.jpg)

# Création de l'appareil dans SigFox Backend

Afin d'ajouter un appareil dans la liste des appareils SigFox Backend, il faut en premier lieu, se connecter à son compte sur le site de [SigFox](https://backend.sigfox.com/).

Pour ajouter un appareil, il faut aller dans le menu **Device** puis cliquer sur **New**. Dans la page de création, il faut renseigner l'ID et le PAC récupéré précédemment, ainsi qu'un nom pour l'appareil. 

![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/device/create.jpg)




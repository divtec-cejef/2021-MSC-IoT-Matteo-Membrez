# Pré-requis
## Installation des librairies
### DHT

1.  Dans le logiciel Arduino, suivre le chemin : Croquis >  Inclure une bibliothèque > Gérer les bibliothèques
2. Installer la bibliothèque suivante : ![](https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/DHT%20librairie.jpg)

### Adafruit Unified Sensor

1. Dans le logiciel Arduino, suivre le chemin : Croquis >  Inclure une bibliothèque > Gérer les bibliothèques
2. Installer la bibliothèque suivante : ![https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/Adafruit%20librairie.jpg]()

## Code

### Mise en place de l'exemple

Dans le logiciel Arduino, suivre le chemin : Fichier > Exemples > DHT sensor library > DHTtester

![https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/CheminExemple.jpg]()

### Ajustement dans le code

```
#define DHTTYPE DHT11   // DHT 11
//#define DHTTYPE DHT22   // DHT 22  (AM2302)
//#define DHTTYPE DHT21   // DHT 21 (AM2301)
```

De base, le type utilisé est le **DHT22** mais le modèle de notre arduino est **DHT21**, il faut donc commenter la 2ème ligne et décommenter la première ligne.

# Lancement

Il ne reste plus qu'à lancer le programme en cliquant sur le bouton **Téléverser** 

![https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/BoutonTeleverser.jpg]()

Une fois le programme téléversé, appuyer simultanément sur **CTRL + MAJ + M** Pour ouvrir le moniteur de série

![https://github.com/divtec-cejef/2021-MSC-IoT-Matteo-Membrez/blob/main/doc/img/MoniteurSerie.jpg]()


# API

L'API doit permettre d'accéder aux données de la base de données. Le but est d'introduire les notions de GET, POST, PUT et DELETE.

## GET

Permet de récupérer des informations de la base de données à travers l'API

## POST

Permet d'ajouter des données à la base de données à travers l'API

## PUT

Permet de modifier les données de la base de données à travers l'API

## DELETE

Permet de supprimer des données de la base de données à travers l'API

------

L'API possède un certain nombre de fonction qui permette d'accéder aux valeurs :

## Fonctions GET

| Nom de la fonction |                Fonctionnement de la fonction                 |
| :----------------: | :----------------------------------------------------------: |
|    getAllValues    | Récupère l'ensemble des valeurs "essentielles" qui doivent être affichées sur le site |
|   getValuesById    |    Récupère les valeurs d'un message par son identifiant     |
|    getAllSalles    | Récupère toutes les salles contenues dans la base de données |
| getValuesBySalles  |      Récupère toutes les valeurs dans une salle précise      |
|   getAllCapteurs   | Récupère tous les capteurs contenus dans la base de données  |
|   getAllMessages   |                                                              |

## Fonctions POST

| Nom de la fonction |                Fonctionnement de la fonction                 |
| :----------------: | :----------------------------------------------------------: |
|    addNewValues    | Ajoute à la base de données un nouveau message en prenant en paramètre **la date, le numéro de séquence, la température, l'humidité et la clé étrangère qui représente le capteur** |

## Fonctions PUT

|  Nom de la fonction   |                Fonctionnement de la fonction                 |
| :-------------------: | :----------------------------------------------------------: |
| updateValueBySequence | Modifie un message existant dans la base de données en prenant en paramètre **le numéro de séquence, la température et l'humidité** |

## Fonctions DELETE

|  Nom de la fonction   |                Fonctionnement de la fonction                 |
| :-------------------: | :----------------------------------------------------------: |
| deleteValueBySequence | Supprime un message existant dans la base de données en prenant en paramètre **le numéro de séquence** |

## Autres fonctions

| Nom de la fonction |                Fonctionnement de la fonction                 |
| :----------------: | :----------------------------------------------------------: |
|    verifyDevice    | Vérifie qu'un appareil existe en lui passant en paramètre le **nom** de ce même appareil |
|    convertEpoch    | Converti une date "Epoch" en format de date gérable par la base de données |


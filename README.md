# RemplirDeclarationAchat
Ce projet permet la génération d'un PDF de déclaration d'achat d'un véhicule (Cerfa-13751) pré-rempli.

Le fichier **exemple.php** montre comment utiliser la class *RemplirDeclarationAchat*. Tous les noms sont explicites afin de permettre une utilisation aisée.

## Liste des fonctions utilisables :

### Concernant l'acheteur :

- **setTypeAcheteur(int)** : 
  - 1 : Professionnel du commerce de l'automobile
  - 2 : Professionnel de la destruction
  - 3 : Assureur
- **setNomAcheteur(string)** : Nom de l'acheteur
- **setSIRENAcheteur(int)** : Numéro de SIREN de l'acheteur (s'il s'agit d'un professionnel) *(Uniquement 9 caractères autorisés)*
- **setNumeroAdresseAcheteur(int)** : Numéro de l'adresse de l'acheteur
- **setExtensionAdresseAcheteur(string)** : Extension de l'adresse de l'acheteur (Bis, Ter ...)
- **setTypeAdresseAcheteur(string)** : Type de l'adresse de l'acheteur (Rue, Avenue, Boulevard...)
- **setNomAdresseAcheteur(string)** : Nom de la rue de l'acheteur
- **setCodePostalAdresseAcheteur(int)** : Code postal de l'acheteur *(Uniquement 5 caractères autorisés)*
- **setVilleAdresseAcheteur(string)** : Ville de l'acheteur

### Concernant l'achat :

- **setTypeAchat(int)** :
  - 1 : Achat classique
  - 2 : Achat pour destruction
- **setAgrementVHU(string)** : Numéro d'agrément VHU (dans le cas d'un achat pour destruction)
- **setDateAchat(string)** : Date d'achat au format jj/mm/aaaa *(Uniquement 10 caractères autorisés, comprenant les chiffres et les /)*
- **setHeureAchat(string)** : Heure d'achat au format hh:mm *(Uniquement 5 caractères autorisés, comprenant les chiffres et le :)*

### Concernant le véhicule :

- **setImmatriculation(string)** : Le numéro d'immatriculation du véhicule
- **setVIN(string)** : Le numéro de chassis du véhicule
- **setMarque(string)** : La marque du véhicule
- **setType(string)** : Le type du véhicule (D.2 sur la carte grise)
- **setModele(string)** : Le modèle / La désignation commerciale du véhicule
- **setGenre(string)** : Le genre du véhicule (J.1 sur la carte grise)

### Concernant le certificat d'immatriculation :

- **setPresenceCertificatImmatriculation(bool)** :
  - True : Présence du certificat d'immatriculation coché "Oui"
  - False : Présence du certificat d'immatriculation coché "Non"
- **setDateDerniereImmatriculation(string)** : Date du certificat d'immatriculation au format jj/mm/aaaa
- **setNumeroFormuleImmatriculation(string)** : Numéro de formule du certificat d'immatriculation
- **setMotifCertificatImmatriculationManquant(string)** : Motif de non présence de la carte grise

### Concernant la signature de l'acheteur :

- **setVilleSignatureAcheteur(string)** : Ville où l'acheteur a signé le document
- **setDateSignatureAcheteur(string)** : Date au format jj/mm/aaaa où l'acheteur a signé le document

### Concernant le vendeur :

- **setNomVendeur(string)** : Nom du vendeur
- **setSIRENVendeur(int)** : Numéro de SIREN du vendeur (s'il s'agit d'un professionnel) *(Uniquement 9 caractères autorisés)*
- **setNumeroAdresseVendeur(int)** : Numéro de l'adresse du vendeur
- **setExtensionAdresseVendeur(string)** : Extension de l'adresse du vendeur (Bis, Ter ...)
- **setTypeAdresseVendeur(string)** : Type de l'adresse du vendeur (Rue, Avenue, Boulevard...)
- **setNomAdresseVendeur(string)** : Nom de la rue du vendeur
- **setCodePostalAdresseVendeur(int)** : Code postal du vendeur *(Uniquement 5 caractères autorisés)*
- **setVilleAdresseVendeur(string)** : Ville du vendeur

### Concernant la signature du vendeur :

- **setVilleSignatureVendeur(string)** : Ville où le vendeur a signé le document
- **setDateSignatureVendeur(string)** : Date au format jj/mm/aaaa où le vendeur a signé le document

### Autres :

- **setOppositionReutilisationDonnees(bool)** :
  - True : Coche la case "*Je m'oppose à la réutilisation de mes données à des fins de prospection commerciale*"
  - False : Ne coche pas la case
- **output()** : Génère et affiche le PDF rempli

## Problèmes connus :

### Problème d'accents :

Au cas où vous auriez les accents qui se transforment en des caractères de la forme "*Ã©*" par exemple. Il s'agit probablement d'un problème de décodage des caractères.
La solution est simple, utilisez la fonction **utf8_decode()** native de PHP sur votre texte de la façon suivante :

```php
$da->setNomVendeur(utf8_decode('Texte avant des accents'));
```

## Dépendances :

Le projet utilise FPDF et son extension FPDI :

- **Site internet de FPDF :** http://www.fpdf.org/
- **Site internet de FPDI :** https://www.setasign.com/products/fpdi/about/

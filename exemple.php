<?php
require('RemplirDeclarationAchat.php');

$da = new RemplirDeclarationAchat();
$da->setTypeAcheteur(1);
$da->setNomAcheteur("SAS ROGER AUTOMOBILES");
$da->setSIRENAcheteur("123456789");
$da->setNumeroAdresseAcheteur('5');
$da->setExtensionAdresseAcheteur('BIS');
$da->setTypeAdresseAcheteur('AVENUE');
$da->setNomAdresseAcheteur("DE LA REPUBLIQUE");
$da->setCodePostalAdresseAcheteur(50000);
$da->setVilleAdresseAcheteur("SAINT-LO");

$da->setTypeAchat(1);
$da->setAgrementVHU('');
$da->setDateAchat("12/10/2020");
$da->setHeureAchat("10:30");

$da->setImmatriculation("AZ-123-ED");
$da->setVIN("VF7LDHC6554DS1232510");
$da->setMarque("PEUGEOT");
$da->setType("U2HDL5E");
$da->setModele("308");
$da->setGenre("VP");

$da->setPresenceCertificatImmatriculation(true);
$da->setDateDerniereImmatriculation('');
$da->setNumeroFormuleImmatriculation('2018DJFJHQJD545');
$da->setMotifCertificatImmatriculationManquant('');

$da->setVilleSignatureAcheteur('SAINT-LO');
$da->setDateSignatureAcheteur('15/10/2020');

$da->setNomVendeur('PIERRE DUPOND');
$da->setSIRENVendeur('');
$da->setNumeroAdresseVendeur('152');
$da->setExtensionAdresseVendeur('TER');
$da->setTypeAdresseVendeur('BLV');
$da->setNomAdresseVendeur('MARCEL PAGNOL');
$da->setCodePostalAdresseVendeur('14000');
$da->setVilleAdresseVendeur('CAEN');

$da->setVilleSignatureVendeur('CAEN');
$da->setDateSignatureVendeur('15/10/2020');

$da->setOppositionReutilisationDonnees(true);

$da->output();

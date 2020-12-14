<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

class RemplirDeclarationAchat
{
	private $pdf;

	public function __Construct()
	{
		require_once('fpdf182/fpdf.php');
		require_once('FPDI-2.3.5/src/autoload.php');

		$this->pdf = new Fpdi();

		$pageCount = $this->pdf->setSourceFile('cerfa-13751.pdf');
		$pageId = $this->pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

		$this->pdf->addPage();
		$this->pdf->useImportedPage($pageId, 0, 0);

		$this->pdf->SetFont('Helvetica','',12);
	}

	/**
	 * ### ACHETEUR ###
	 */

	//Type d'acheteur : 1 = Professionnel du commerce auto, 2 = Professionnel de la descruction, 3 = Assureur
	public function setTypeAcheteur(int $num)
	{
		if($num == 1)
		{
			$this->pdf->SetXY(32,29.3);
			$this->pdf->Cell(5,5,'X');
		}
		elseif($num == 2)
		{
			$this->pdf->SetXY(106,29.3);
			$this->pdf->Cell(5,5,'X');
		}
		elseif($num == 3)
		{
			$this->pdf->SetXY(161,29.3);
			$this->pdf->Cell(5,5,'X');
		}
		else{ return false; }
	}

	public function setNomAcheteur(string $nomAcheteur)
	{
		$this->pdf->SetXY(38,38);
		$this->pdf->Cell(80,5,$nomAcheteur);
	}

	public function setSIRENAcheteur(int $siren)
	{
		$this->setSIREN($siren,164,38);
	}

	public function setNumeroAdresseAcheteur(int $numero)
	{
		$this->pdf->SetXY(36,47);
		$this->pdf->Cell(15,5,$numero);
	}

	//Extension d'adresse : Bis, Ter ...
	public function setExtensionAdresseAcheteur(string $extension)
	{
		$this->pdf->SetXY(54,47);
		$this->pdf->Cell(15,5,$extension);
	}

	//Type de voie : Rue, Avenue, Boulevard ...
	public function setTypeAdresseAcheteur(string $type)
	{
		$this->pdf->SetXY(71,47);
		$this->pdf->Cell(25,5,$type);
	}

	public function setNomAdresseAcheteur(string $nom)
	{
		$this->pdf->SetXY(98,47);
		$this->pdf->Cell(101,5,$nom);
	}

	public function setCodePostalAdresseAcheteur(int $codePostal)
	{
		$this->setCodePostal($codePostal,31,56);
	}

	public function setVilleAdresseAcheteur(string $ville)
	{
		$this->pdf->SetXY(62,56);
		$this->pdf->Cell(138,5,$ville);
	}


	/**
	 * ### TYPE / DATE / HEURE ACHAT ###
	 */

	//Type d'achat : 1 = Achat classique, 2 = Achat pour descruction
	public function setTypeAchat(int $num)
	{
		if($num == 1)
		{
			$this->pdf->SetXY(30.6,66.3);
			$this->pdf->Cell(5,5,'X');
		}
		elseif($num == 2)
		{
			$this->pdf->SetXY(30.6,71);
			$this->pdf->Cell(5,5,'X');
		}
		else{ return false; }
	}

	public function setAgrementVHU(string $agrement)
	{
		$this->pdf->SetXY(101,69);
		$this->pdf->Cell(97,5,$agrement);
	}

	//Format de date Français jj/mm/aaaa
	public function setDateAchat(string $dateAchat)
	{
		$this->setDate($dateAchat,15,85);

		//On remplis aussi la date de vente avec les mêmes infos :
		$this->setDate($dateAchat,127,232);
	}

	//Format Français : hh:mm
	public function setHeureAchat(string $heure)
	{
		$this->setHeure($heure,65,85);
	}


	/**
	 * ### VEHICULE ###
	 */

	public function setImmatriculation(string $immatriculation)
	{
		$this->pdf->SetXY(11,97);
		$this->pdf->Cell(58,5,$immatriculation,0,0,'C');
	}

	public function setVIN(string $vin)
	{
		$this->pdf->SetXY(76,97);
		$this->pdf->Cell(58,5,$vin);
	}

	public function setMarque(string $marque)
	{
		$this->pdf->SetXY(141,97);
		$this->pdf->Cell(58,5,$marque);
	}

	public function setType(string $type)
	{
		$this->pdf->SetXY(11,106);
		$this->pdf->Cell(83,5,$type);
	}

	public function setModele(string $modele)
	{
		$this->pdf->SetXY(100,106);
		$this->pdf->Cell(53,5,$modele);
	}

	//Genre : VP, CTTE, DERIVE VP ...
	public function setGenre(string $genre)
	{
		$this->pdf->SetXY(160,106);
		$this->pdf->Cell(38,5,$genre);
	}


	/**
	 * ### CERTIFICAT D'IMMATRICULATION ###
	 */

	public function setPresenceCertificatImmatriculation(bool $presence)
	{
		if($presence)
		{
			$this->pdf->SetXY(82.3,118.2);
			$this->pdf->Cell(5,5,'X');
		}
		else
		{
			$this->pdf->SetXY(101.5,118.2);
			$this->pdf->Cell(5,5,'X');
		}
	}

	public function setDateDerniereImmatriculation(string $dateImmatriculation)
	{
		$this->setDate($dateImmatriculation,50,125);
	}

	public function setNumeroFormuleImmatriculation(string $formule)
	{
		$this->pdf->SetXY(115,125);
		$this->pdf->Cell(57,5,$formule);
	}

	public function setMotifCertificatImmatriculationManquant(string $motif)
	{
		$this->pdf->SetXY(58,141);
		$this->pdf->Cell(140,5,$motif);
	}


	/**
	 * ### INFOS SIGNATURE ACHETEUR ###
	 */

	public function setVilleSignatureAcheteur(string $ville)
	{
		$this->pdf->SetXY(20,160);
		$this->pdf->Cell(67,5,$ville);
	}

	public function setDateSignatureAcheteur(string $date)
	{
		$this->setDate($date,98,160);
	}


	/**
	 * ### VENDEUR ###
	 */

	public function setNomVendeur(string $nom)
	{
		$this->pdf->SetXY(38,200);
		$this->pdf->Cell(120,5,$nom);
	}

	public function setSIRENVendeur(string $siren)
	{
		$this->setSIREN($siren,161.5,200);
	}

	public function setNumeroAdresseVendeur(int $numero)
	{
		$this->pdf->SetXY(31,211);
		$this->pdf->Cell(13,5,$numero);
	}

	public function setExtensionAdresseVendeur(string $extension)
	{
		$this->pdf->SetXY(50,211);
		$this->pdf->Cell(13,5,$extension);
	}

	public function setTypeAdresseVendeur(string $type)
	{
		$this->pdf->SetXY(68,211);
		$this->pdf->Cell(22,5,$type);
	}

	public function setNomAdresseVendeur(string $nom)
	{
		$this->pdf->SetXY(96,211);
		$this->pdf->Cell(100,5,$nom);
	}

	public function setCodePostalAdresseVendeur(int $codePostal)
	{
		$this->setCodePostal($codePostal,31,221);
	}

	public function setVilleAdresseVendeur(string $ville)
	{
		$this->pdf->SetXY(62,221);
		$this->pdf->Cell(134,5,$ville);
	}


	/**
	 * ### INFOS SIGNATURE VENDEUR
	 */

	public function setVilleSignatureVendeur(string $ville)
	{
		$this->pdf->SetXY(21,245);
		$this->pdf->Cell(40,5,$ville);
	}

	public function setDateSignatureVendeur(string $date)
	{
		$this->setDate($date,72,244);
	}


	/**
	 * ### AUTRES ###
	 */

	public function setOppositionReutilisationDonnees(bool $opposition)
	{
		if($opposition)
		{
			$this->pdf->SetXY(105,187.2);
			$this->pdf->Cell(5,5,'X');
		}
	}

	public function output()
	{
		$this->pdf->Output();
	}


	/**
	 * PRIVATES FUNCTIONS
	 */
	private function setSIREN(string $siren, float $fx, float $fy)
	{
		if(strlen($siren) != 9){ return false; }

		$siren = str_split($siren);

		//Set première position :
		$x = $fx;
		$y = $fy;
		$this->pdf->SetXY($x,$y);

		foreach($siren as $c)
		{
			$this->pdf->Cell(4,5,$c);
			$x += 4;
			$this->pdf->SetX($x);
		}
	}

	private function setCodePostal(string $codePostal, float $fx, float $fy)
	{
		if(strlen($codePostal) != 5){ return false; }

		$codePostal = str_split($codePostal);

		//Set première position :
		$x = $fx;
		$y = $fy;
		$this->pdf->SetXY($x,$y);

		foreach($codePostal as $c)
		{
			$this->pdf->Cell(5,5,$c);
			$x += 5;
			$this->pdf->SetX($x);
		}
	}

	private function setDate(string $date, float $fx, float $fy)
	{
		if(strlen($date) != 10){ return false; }

		$date = str_replace('/','',$date);
		$date = str_split($date);

		//Set première position :
		$x = $fx;
		$y = $fy;
		$this->pdf->SetXY($x,$y);

		foreach($date as $k => $c)
		{
			$this->pdf->Cell(5,5,$c);
			$x += 5;
			if($k == 1 || $k == 3){ $x += 2; }
			$this->pdf->SetX($x);
		}
	}

	private function setHeure(string $heure, float $fx, float $fy)
	{
		if(strlen($heure) != 5){ return false; }

		$heure = str_replace(':','',$heure);
		$heure = str_split($heure);

		//Set première position :
		$x = $fx;
		$y = $fy;
		$this->pdf->SetXY($x,$y);

		foreach($heure as $c)
		{
			$this->pdf->Cell(5,5,$c);
			$x += 5;
			$this->pdf->SetX($x);
		}
	}
}

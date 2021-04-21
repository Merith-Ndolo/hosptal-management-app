<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_config extends CI_Model {

	public function echappe($string)
	{
		return str_replace("'","''",$string);
	}

	public function text($string) {
		$searched = array('&lt;','&gt;');
		$replaced = array('<','>');

		$string = htmlspecialchars($string, ENT_QUOTES, "UTF-8");
		$string = str_replace($searched,$replaced,$string);

		return $string;
	}

	public function upload($file,$destination_dir) {
		$tmp_name = $file['tmp_name'];
		$extension = substr($file['name'],strpos($file['name'],'.'));

		$name 	  = uniqid().$extension;

		move_uploaded_file($tmp_name,$destination_dir.$name);
		
		return $name;
	}
	
	//redirectionner & renommer une image
	
	public function uploadFile($file,$destination){
		// $destination = dirname(__DIR__).$destination_dir;
		 $extre = explode('.',$file['name']);
		$verif = array('png','jpg','jpeg','gif','ico','jfif','PNG','JPG','JPEG','GIF','ICO','JFIF');
		 if(in_array(end($extre),$verif)){
			$fichier = round(microtime(true)).'.'.end($extre);
			move_uploaded_file($file['tmp_name'], $destination . $fichier);
			return $fichier;
		 }
		 else{
			return false;
		 }
		
	}	
	
	
	public function uploadImage($file){
		// $destination = dirname(__DIR__).$destination_dir;
		 $extre = explode('.',$file['name']);
		$verif = array('png','jpg','jpeg','PNG','JPG','JPEG');
		 if(in_array(end($extre),$verif)){
			return true;
		 }
		 else{
			return false;
		 }
		
	}	
	
	
	public function uploadFichier($file){
		// $destination = dirname(__DIR__).$destination_dir;
		 $extre = explode('.',$file['name']);
		$verif = array('png','jpg','jpeg','PNG','JPG','JPEG','pdf','PDF','docx','DOCX');
		 if(in_array(end($extre),$verif)){
			return true;
		 }
		 else{
			return false;
		 }
		
	}	
	
	public function sizeImage($file,$t){
		// $destination = dirname(__DIR__).$destination_dir;
		$taille = $file['size'];
		$autorise = 1024*$t;
		if($taille<=$autorise){
			return true;
		}
		else{
			return false;
		}
	}	
	
	
	public function uploadVideo($file,$destination){
		// $destination = dirname(__DIR__).$destination_dir;
		 $extre = explode('.',$file['name']);
		$verif = array('mp4','avi','mpg','mov','mpa','wma','MP4','AVI','MPG','MOV','MPA','WMA');
		 if(in_array(end($extre),$verif)){
			$fichier = round(microtime(true)).'.'.end($extre);
			move_uploaded_file($file['tmp_name'], $destination . $fichier);
			return $fichier;
		 }
		 else{
			return false;
		 }
		
	}

	public function forUrl($string) {
		$string = str_replace('é','e',$string);
		$string = str_replace('?','e',$string);
		$string = $this->noAccent($string);
		$string = strtolower($string);
		$string = str_replace(' ','-',$string);
		$string = str_replace(',','-',$string);
		$string = str_replace("'",'-',$string);
		$string = str_replace('--','-',$string);
		$string = str_replace('_','-',$string);
											
		return $string;
	}

	public function noAccent($string){
		$string = utf8_decode($string);
		$string =  strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ?',
	'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUYe');

		$string = str_replace('?','e',$string);

		return $string;
	}

	public function redirect($destination_url) {
		$js = '<script type="text/javascript">';
		$js .= 'window.location = "'.$destination_url.'";';
		$js .= '</script>';

		echo $js;
	}

	public function tronque($string,$longueur = 100)
	{

		if (strlen($string) > $longueur)
		{
			$string = substr($string, 0, $longueur);
			$position_espace = strrpos($string, " ");
			$string = substr($string, 0, $position_espace);
			$string = $string."...";
		}

		return $string;
	}

	public function verifMail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function verifDate($dateDMY) {
		return preg_match("^\d{1,2}/\d{2}/\d{4}^",$dateDMY);
	}

	public function envoiMail($destinataire,$sujet,$contenu,$replyto = NULL) {

		if(is_null($replyto)) $replyto = EXP_MAIL;

		$from  = "From:".EXP_MAIL."\n";
		$from .= "MIME-version: 1.0\n";
		$from .= "Content-type: text/html; charset= utf-8\n";
		$from .= "Reply-To: $replyto\n";

		$message = '';

		$message .= stripslashes($contenu);

		$envoi = mail($destinataire,$sujet,$contenu,$from);
		mail('mouebo2018@gmail.com',$sujet,$contenu,$from); // copie pour tests

		return $envoi;
	}
	
	
	public function envoiMailReponse($exp,$destinataire,$sujet,$contenu,$replyto = NULL) {

		if(is_null($replyto)) $replyto = $exp;

		$from  = "From:".$exp."\n";
		$from .= "MIME-version: 1.0\n";
		$from .= "Content-type: text/html; charset= utf-8\n";
		$from .= "Reply-To: $replyto\n";

		$message = '';

		$message .= stripslashes($contenu);

		$envoi = mail($destinataire,$sujet,$contenu,$from);
		mail('mouebo2018@gmail.com',$sujet,$contenu,$from); // copie pour tests

		return $envoi;
	}
	

	public function getBouton($texte, $lien = '#') {
		$bouton = '<a href="'.$lien.'" style="color:#1172a9; font-weight:bold;">'.$texte.'</a>';

		return $bouton;
	}

	public function geocodeAdresse($address) {
		global $db;

		$address = utf8_decode($address);

		$address = $this->noAccent(strtolower($address));

		$geocoder = "https://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false&key=".GMAPS_APIKEY;
		$url_address = utf8_encode($address);
		$url_address = urlencode($url_address);
		$query = sprintf($geocoder,$url_address);

		$results = file_get_contents($query);
		$resultat = json_decode($results);

	//	var_dump($resultat);

		$latitude = ((float)$resultat->results[0]->geometry->location->lat);
		$longitude = ((float)$resultat->results[0]->geometry->location->lng);

		if(is_float($latitude)) {
			return array('lat' => $latitude, 'lng' => $longitude);
		}
		else {
			return false;
		}
	}

	public function dateFR2EN($dateFr) {
		$tabDate = explode('/',$dateFr);

		return $tabDate[2].'-'.$tabDate[1].'-'.$tabDate[0];
	}

	public function dateEN2FR($dateEN) {
		$tabDate = explode('-',$dateEN);

		return $tabDate[2].'/'.$tabDate[1].'/'.$tabDate[0];
	}

	public function dateTimeEN2FR($dateEN) {
		$tabDateEN = explode(' ',$dateEN);
		$tabDate = explode('-',$tabDateEN[0]);

		return $tabDate[2].'/'.$tabDate[1].'/'.$tabDate[0];
	}

	public function cryptPass($password) {
		return hash('sha512',$password);
	}

	public function formatTimestampToDate($timestamp) {
		if(!is_int($timestamp)) return $timestamp;

		return date('Y-m-d H:i:s',$timestamp);
	}

	public function formatDateToTimestamp($date) {
		$tabDate = explode(' ',$date);
		$tabJour = explode('-',$tabDate[0]);
		$tabHeure = explode(':',$tabDate[0]);

	 	$timestamp = mktime($tabHeure[0],$tabHeure[1],$tabHeure[2],$tabJour[1],$tabJour[2],$tabJour[0]);

		return $timestamp;
	}

	public function formatFileSize($size) {
		if($size > (1024*1024*1024)) {
			return round($size/(1024*1024*1024),2).' Go';
		}
		elseif($size > (1024*1024)) {
			return round($size/(1024*1024),2).' Mo';
		}
		elseif($size > 1024) {
			return round($size/1024).' Ko';
		}
		else {
			return $size.' o';
		}
	}
	
		
		//Genere un mot de passe automatiquement
		public function uniqidReal($lenght = 10) {
		
			if (function_exists("random_bytes")) {
				$bytes = random_bytes(ceil($lenght / 2));
			} elseif (function_exists("openssl_random_pseudo_bytes")) {
				$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
			} else {
				throw new Exception("no cryptographically secure random function available");
			}
			return substr(bin2hex($bytes), 0, $lenght);
		}
	
		public function trunc($phrase,$max){
			$phrase_array = explode(' ',$phrase);
			if(count($phrase_array) > $max && $max > 0){
				$phrase = implode(' ',array_slice($phrase_array, 0, $max)).'...';
			}
			return $phrase;
		}
		
	public	function affDateFr($date){
	
		$tab =explode(' ', $date);
		
		$year = $tab[2];
		$month = $tab[1];
		$day = $tab[0];
		$hour = $tab[4];
		$a = $tab[3];
		 
		$str = $day." ";
		if($month == 'January') $str .= "Janvier";
		if($month == 'February') $str .= "Février";
		if($month == 'March') $str .= "Mars";
		if($month == 'April') $str .= "Avril";
		if($month == 'May') $str .= "Mai";
		if($month == 'June') $str .= "Juin";
		if($month == 'July') $str .= "Juillet";
		if($month == 'August') $str .= "Août";
		if($month == 'September') $str .= "Septembre";
		if($month == 'October') $str .= "Octobre";
		if($month == 'November') $str .= "Novembre";
		if($month == 'December') $str .= "Décembre";
		$str .= " ".$year." ".$a." ".$hour;
		 
		return $str;
	}
	
	public	function affDateTimeFrAffich($date){
	
		$tab =explode('-', $date);
		
		$year = $tab[0];
		$month = $tab[1];
		$dayHour = $tab[2];
		$tabDayHour=explode(' ', $dayHour);
		
		$day = "le ".$tabDayHour[0];
		$hour = $tabDayHour[1];
		 
		$str = $day." ";
		if($month == 1) $str .= "Janvier";
		if($month == 2) $str .= "Février";
		if($month == 3) $str .= "Mars";
		if($month == 4) $str .= "Avril";
		if($month == 5) $str .= "Mai";
		if($month == 6) $str .= "Juin";
		if($month == 7) $str .= "Juillet";
		if($month == 8) $str .= "Août";
		if($month == 9) $str .= "Septembre";
		if($month == 10) $str .= "Octobre";
		if($month == 11) $str .= "Novembre";
		if($month == 12) $str .= "Décembre";
		$str .= " ".$year." - ".$hour;
		 
		return $str;
	}
	
	
	public	function affDateTimeFr($date){
	
		$tab =explode('-', $date);
		
		$year = $tab[0];
		$month = $tab[1];
		$dayHour = $tab[2];
		$tabDayHour=explode(' ', $dayHour);
		
		$day = "le ".$tabDayHour[0];
		$hour = $tabDayHour[1];
		 
		$str = $day." ";
		if($month == 1) $str .= "Janvier";
		if($month == 2) $str .= "Février";
		if($month == 3) $str .= "Mars";
		if($month == 4) $str .= "Avril";
		if($month == 5) $str .= "Mai";
		if($month == 6) $str .= "Juin";
		if($month == 7) $str .= "Juillet";
		if($month == 8) $str .= "Août";
		if($month == 9) $str .= "Septembre";
		if($month == 10) $str .= "Octobre";
		if($month == 11) $str .= "Novembre";
		if($month == 12) $str .= "Décembre";
		$str .= " ".$year." à ".$hour;
		 
		return $str;
	}

	public	function affTime($date){
	
		$tab =explode('-', $date);
		$year = $tab[0];
		$month = $tab[1];
		$dayHour = $tab[2];
		$tabDayHour=explode(' ', $dayHour);
		$hour = $tabDayHour[1];

		 
		return $hour;
	}

	public	function affMoisFr($month){
		
		if($month == 'January') $str = "Janvier";
		if($month == 'February') $str = "Février";
		if($month == 'March') $str = "Mars";
		if($month == 'April') $str = "Avril";
		if($month == 'May') $str = "Mai";
		if($month == 'June') $str = "Juin";
		if($month == 'July') $str = "Juillet";
		if($month == 'August') $str = "Août";
		if($month == 'September') $str = "Septembre";
		if($month == 'October') $str = "Octobre";
		if($month == 'November') $str = "Novembre";
		if($month == 'December') $str = "Décembre";
		 
		return $str;
	}
	
	
	public function recupDateTime($date){
		
		$tab =explode(' ', $date);
		
		$year = $tab[3];
		$month = $tab[2];
		$day = $tab[1];
		 
		if($month == 'January') $month = "01";
		if($month == 'February') $month = "02";
		if($month == 'March') $month = "03";
		if($month == 'April') $month = "04";
		if($month == 'May') $month = "05";
		if($month == 'June') $month = "06";
		if($month == 'July') $month = "07";
		if($month == 'August') $month = "08";
		if($month == 'September') $month = "09";
		if($month == 'October') $month = "10";
		if($month == 'November') $month = "11";
		if($month == 'December') $month = "12";
		 
		return $year."-".$month."-".$day;
	}
	
	
	public function affDateFrNum($date){
		
		$tab =explode('-', $date);
		
		$year = $tab[0];
		$month = $tab[1];
		$day = $tab[2];
		 
		$str = $day." ";
		if($month == 1) $str .= "Janvier";
		if($month == 2) $str .= "Février";
		if($month == 3) $str .= "Mars";
		if($month == 4) $str .= "Avril";
		if($month == 5) $str .= "Mai";
		if($month == 6) $str .= "Juin";
		if($month == 7) $str .= "Juillet";
		if($month == 8) $str .= "Août";
		if($month == 9) $str .= "Septembre";
		if($month == 10) $str .= "Octobre";
		if($month == 11) $str .= "Novembre";
		if($month == 12) $str .= "Décembre";
		$str .= " ".$year;
		 
		return $str;
	}
	public function recupMoisAnnee($date){
		
		$tab =explode('-', $date);
		
		$year = $tab[0];
		$month = $tab[1];
		$day = $tab[2];
		 
		return $month.'-'.$year;
	}
	
	public function formatPhoneCongo($phone){
		
		$tab = explode(" ",$phone);
		$phone = implode("",$tab);
		
		if(strlen($phone) == 9){
			$tel = $phone;
			$pref = substr($tel,0,2);
			if($pref=="06" || $pref==6 || $pref=="05" || $pref==5 || $pref=="04" || $pref==4 || $pref=="01" || $pref==1 || $pref == "22" || $pref == 22){
				return $tel;
			}
			else{
				return false;
			}
		}
		else if(strlen($phone) > 9){
			$fin = strlen($phone) - 1;
			$extre = substr($phone,-9,$fin);
			$tel = $extre;
			$pref = substr($tel,0,2);
			if($pref=="06" || $pref==6 || $pref=="05" || $pref==5 || $pref=="04" || $pref==4 || $pref=="01" || $pref==1 || $pref == "22" || $pref == 22){
				return $tel;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	
	
	
	public function ageAnnee($dateNaiss) {
		$recup = explode("-",$dateNaiss);
		$date = $recup[0];
		
		$age = date('Y') - date('Y', strtotime($date));
		if (date('md') < date('md', strtotime($date))) {
			return $age - 1;
		}
		return $age;
	}
	
	public function ageMois($dateNaiss) {
		$recup = explode("-",$dateNaiss);
		$date = $recup[1];
		$age = date('m') - $date;
		// if (date('md') < date('md', strtotime($date))) {
			// return $age - 1;
		// }
		return $age;
	}
	
	public function joursRestantDate($date1, $date2){
		date_default_timezone_set('Africa/Brazzaville');
		//Définition des date au format année-mois-jour
		// $date1 = date("Y-m-d"); 
		  
		//Extraction des données
		list($annee1, $mois1, $jour1) = explode('-', $date1);
		list($annee2, $mois2, $jour2) = explode('-', $date2);
		 
		//Calcul des timestamp
		$timestamp1 = mktime(0,0,0,$mois1,$jour1,$annee1);
		$timestamp2 = mktime(0,0,0,$mois2,$jour2,$annee2);
		$nbJours = abs($timestamp2 - $timestamp1)/86400; //On utilise abs afin d'obtenir toujours une valeur positive, donc les dates peuvent être mises dans n'importe quel ordre.
		echo "Nombre de jours : ".$nbJours;//Affichage du nombre de jour restant
	}
		
	
	public function Date_ConvertSqlTab($date_sql) {
		$jour = substr($date_sql, 8, 2);
		$mois = substr($date_sql, 5, 2);
		$annee = substr($date_sql, 0, 4);
		$heure = substr($date_sql, 11, 2);
		$minute = substr($date_sql, 14, 2);
		$seconde = substr($date_sql, 17, 2);
		
		$key = array('annee', 'mois', 'jour', 'heure', 'minute', 'seconde');
		$value = array($annee, $mois, $jour, $heure, $minute, $seconde);
		
		$tab_retour = array_combine($key, $value);
		
		return $tab_retour;
	}
	
	public function AuPluriel($chiffre) {
		if($chiffre>1) {
			return 's';
		};
	}
	
	public function joursRestantDateTime($end){
		date_default_timezone_set('Africa/Brazzaville');
		
		$tab_date = $this->Date_ConvertSqlTab($end);
		$mkt_jourj = mktime($tab_date['heure'],
						$tab_date['minute'],
						$tab_date['seconde'],
						$tab_date['mois'],
						$tab_date['jour'],
						$tab_date['annee']);
		$mkt_now = time();
		
		$diff = $mkt_jourj - $mkt_now;
		
		$unjour = 3600 * 24;
		
		if($diff>=$unjour) {
			// EN JOUR
			$calcul = $diff / $unjour;
			return 'Il reste <strong>'.ceil($calcul).' jour'.$this->AuPluriel($calcul).'</strong>.';
		} elseif($diff<$unjour && $diff>=0 && $diff>=3600) {
			// EN HEURE
			$calcul = $diff / 3600;
			return '<span class="text-warning">Il reste <strong>'.ceil($calcul).' heure'.$this->AuPluriel($calcul).'</strong></span>.';
		} elseif($diff<$unjour && $diff>=0 && $diff<3600) {
			// EN MINUTES
			$calcul = $diff / 60;
			return '<span class="text-danger">Il reste <strong>'.ceil($calcul).' minute'.$this->AuPluriel($calcul).'</strong></span>.';
		} elseif($diff<0 && abs($diff)<3600) {
			// DEPUIS EN MINUTES
			$calcul = abs($diff) / 60;
			return 'Depuis <strong>'.ceil($calcul).' minute'.$this->AuPluriel($calcul).'</strong>.';
		} elseif($diff<0 && abs($diff)<=3600) {
			// DEPUIS EN HEURES
			$calcul = abs($diff) / 3600;
			return 'Depuis <strong>'.ceil($calcul).' heure'.$this->AuPluriel($calcul).'</strong>.';        
		} else {
			// DEPUIS EN JOUR
			$calcul = abs($diff) / $unjour;
			return 'Depuis <strong>'.ceil($calcul).' jour'.$this->AuPluriel($calcul).'</strong>.';
		};
	}
	
	public function tempsEcoule($date1, $date2){
		
		// $date1 = time();
		// $data2 = strtotime($data2);
		$diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
		$retour = array();
	 
		$tmp = $diff;
		$retour['seconde'] = $tmp % 60;
	 
		$tmp = floor( ($tmp - $retour['seconde']) /60 );
		$retour['minute'] = $tmp % 60;
	 
		$tmp = floor( ($tmp - $retour['minute'])/60 );
		$retour['heure'] = $tmp % 24;
	 
		$tmp = floor( ($tmp - $retour['heure'])  /24 );
		$retour['jour'] = $tmp;
	 
		return $retour;
	}
	
		
	public function formatNombreVirgule($nb){
		
		$tab = explode(",",$nb);
		$nb = implode(".",$tab);
		
		if(is_numeric($nb)){
			return round($nb,2);
		}
		else{
			return "erreur";
		}
		 
	}
	
	
	public function genereCodeBarre($prefix,$destination,$ref){
		// Le code a générer
		
		$code = strtoupper($prefix).$this->uniqidReal(5).date("y");
		$this->md_barcode->setCode($code);
		// Type de code : EAN, UPC, C39...
		$this->md_barcode->setType('C128');
		// taille de l'image (hauteur, largeur, zone calme)
		//    Hauteur mini=15px
		//    Largeur de l'image (ne peut être inférieure a
		//        l'espace nécessaire au code barres
		//    Zones Calmes (mini=10px) à gauche et à droite
		//        des barres
		$this->md_barcode->setSize(65, 130, 10);
		  
		// Texte sous les barres :
		//    'AUTO' : affiche la valeur du codes barres
		//    '' : n'affiche pas de texte sous le code
		//    'texte a afficher' : affiche un texte libre
		//        sous les barres
		$this->md_barcode->setText('AUTO');
		  
		// Si elle est appelée, cette méthode désactive
		// l'impression du Type de code (EAN, C128...)
		$this->md_barcode->hideCodeType();
		  
		// Couleurs des Barres, et du Fond au
		// format '#rrggbb'
		$this->md_barcode->setColors('#123456', '#F9F9F9');
		// Type de fichier : GIF ou PNG (par défaut)
		$this->md_barcode->setFiletype('PNG');
		  
		// envoie l'image dans un fichier
		
		$image = './assets/codebarre/'.$destination.'/'.$ref.'-'.$code.'-'.date("m").'.png';
		$img = $this->forUrl($image);
		$this->md_barcode->writeBarcodeFile($img);
		// ou envoie l'image au navigateur
		// $this->md_barcode->showBarcodeImage();
		
		return $code."--//--".$img;
	}
	
	
}

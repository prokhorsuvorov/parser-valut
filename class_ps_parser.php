<?php
/**
 *  Класс PS_Parser отримує дані трьох основних валют для України з 
 *  офіційних сайтів НБУ і Приватбанку.
 */
class PS_Parser  
{
	public $valuta_privatbank;
	public $valuta_nbu = array();
	public $mass_valut = array();
	
	public function get($url_nby) {
		return file_get_contents($url_nby);		
	}
	
	/**
	 *  Отримує дані з сайту Приватбанку по API
	 *  @return array $valuta_privatbank
	 */ 
	public function get_valuta_privatbank() {	
		$this->valuta_privatbank = json_decode($this->get(URL_PRIVATBANK), true);
		return $this->valuta_privatbank;
	}
	
	/**
	 *  Добавляє дані з Приватбанку в масив $mass_valut
	 *  @return array $mass_valut
	 */ 
	public function foreach_valuta_privatbank() {
		foreach ($this->get_valuta_privatbank() as $valuta ) {
			if($valuta['ccy'] == 'EUR') { $this->mass_valut['eur_privat'] = $valuta['buy']; }
			if($valuta['ccy'] == 'USD') { $this->mass_valut['usd_privat'] = $valuta['buy']; }
			if($valuta['ccy'] == 'RUR') { $this->mass_valut['rur_privat'] = $valuta['buy']; }		
		}
		return $this->mass_valut;
	}
	
	/**
	 *  Отримує дані з сайту НБУ по API і добавляє в масив $mass_valut
	 *  @return array $mass_valut 
	 */ 
	public function get_valuta_nbu() {
		$this->temp_nbu_usd = json_decode($this->get(URL_NBY_USD), true);
		$this->mass_valut['usd_nbu'] = $this->temp_nbu_usd[0]['rate'];
		$this->temp_nbu_eur = json_decode($this->get(URL_NBY_EUR), true);
		$this->mass_valut['eur_nbu'] = $this->temp_nbu_eur[0]['rate'];
		$this->temp_nbu_rub = json_decode($this->get(URL_NBY_RUB), true);
		$this->mass_valut['rub_nbu'] = $this->temp_nbu_rub[0]['rate'];
		return $this->mass_valut;
	}
} // кінець класу PS_Parser

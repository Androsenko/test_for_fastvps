<?php
class Model_Main extends Model
	{
	private $db;
	public function __construct() 
		{
		$this->db = new MySQL(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		}

	public function checkUpdate() // Проверяем не нужно ли обновлять -----------
		{
		$query = $this->db->query("SELECT lupdate FROM testtesttest ORDER BY lupdate DESC LIMIT 1;");
		if ($query->num_rows) // если есть данные о валюте 
			{
			if((strtotime(date("Y-m-d H:i:s")) - strtotime($query->rows[0]['lupdate'])) > TIME_TO_LIVE) { return true; }
			else { return false; }
			}
		}
		
    public function getInfoFromDB() // Берем данные из БД -------------
		{
		if($this->checkUpdate()) { $this->getInfoFromRemoteUrl(SITE1); } // Проверяем не устарели ли данные 
		
		$query = $this->db->query("SELECT * FROM testtesttest ORDER BY vname;");
	
		if ($query->num_rows) // если есть данные о валюте
			{
			foreach ($query->rows as $result) {
					$product_data[$result['id']]['vname']	= $result['vname'];
					$product_data[$result['id']]['nominal']	= $result['nominal'];
					$product_data[$result['id']]['desc']	= $result['desc'];
					$product_data[$result['id']]['vprice']	= $result['vprice'];
					$product_data[$result['id']]['lupdate']	= $result['lupdate'];
					$product_data[$result['id']]['visible']	= $result['visible'];
					$product_data[$result['id']]['id']	= $result['id'];
					$product_data[$result['id']]['vid']	= $result['vid'];
				}
			return $product_data;
			}
		else 
			{
			return false;
			}
		
		}

	// -- Update curs valute ----------------	
	public function getInfoFromRemoteUrl($remote_url) 
		{
		$getcurs = simplexml_load_file($remote_url); // берем валюты с удаленного ресурса
		
		foreach ($getcurs->Valute as $curs)
			{
			$z+=1;
			$out_curs_data[$z]['vid'] = $curs['ID'];
			$out_curs_data[$z]['CharCode'] = $curs->CharCode;
			$out_curs_data[$z]['Nominal'] = $curs->Nominal;
			$out_curs_data[$z]['Name'] = iconv('utf-8','cp1251',$curs->Name);
			$out_curs_data[$z]['Value'] = $curs->Value; 
			
			$query = $this->db->query('SELECT id FROM testtesttest WHERE vname=\''.$out_curs_data[$z]['CharCode'].'\';');
			if ($query->num_rows) // если валюта есть в таблице то апдейтим, иначе добавляем
				{
				$this->db->query('UPDATE testtesttest SET `vid`=\''.$curs["ID"].'\', `vprice`=\''.str_replace(',','.',$curs->Value).'\', `nominal`=\''.$curs->Nominal.'\', `lupdate`=\''.date("Y-m-d H:i:s").'\', `desc`=\''.$curs->Name.'\' WHERE vname=\''.$curs->CharCode.'\'');
				}
			else
				{
				$this->db->query('INSERT INTO testtesttest (`id`,`vid`,`vname`,`nominal`,`vprice`,`lupdate`,`desc`,`visible`) VALUES(\'\',\''.$curs["ID"].'\',\''.$curs->CharCode.'\',\''.$curs->Nominal.'\',\''.str_replace(',','.',$curs->Value).'\',\''.date("Y-m-d H:i:s").'\',\''.$curs->Name.'\',0);');
				}
			}
		$valuta_out = $this->getInfoFromDB();
		return $valuta_out;
		}
	
	public function getInfoFromRemoteUrl_single($remote_url,$vid) // Обновляем выбранную валюту
		{
		$doc = new DOMDocument();
		$doc->load($remote_url);
		$xpath = new DOMXPath($doc);
		$results = $xpath->query("//Valute[@ID='".$vid."']/Value");
		$upd_val = $results->item(0)->nodeValue;

		$this->db->query('UPDATE testtesttest SET `vprice`=\''.str_replace(',','.',$upd_val).'\', `lupdate`=\''.date("Y-m-d H:i:s").'\' WHERE vid=\''.$vid.'\'');

		$valuta_out = $this->getInfoFromDB();
		return $valuta_out;
		}
	
	public function setVisible($vname) // устанавливаем флаг отображения валюты
		{
		$this->db->query('UPDATE testtesttest SET `visible`=1 WHERE vname=\''.$vname.'\'');
		$valuta_out = $this->getInfoFromDB();
		return $valuta_out;
		}
		
	public function delVisible($vname) // убираем флаг отображения валюты
		{
		$this->db->query('UPDATE testtesttest SET `visible`=0 WHERE vname=\''.$vname.'\'');
		$valuta_out = $this->getInfoFromDB();
		return $valuta_out;
		}
	}
?>
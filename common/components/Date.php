<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Date extends Component{

	function format_tanggal($tanggal, $tipe='long', $format='date'){
		$array = explode(' ', $tanggal);
		$arraydate = explode('-', $array[0]);

		if(count($array)==1 || (count($array) > 1 && $format == 'date'))
		{
			$array[1] = '';
		}
		else
		{
			$array[1] = ' - ' . substr($array[1], 0, 8);
		}

		if(count($arraydate) == 3)
		{
			if($tipe == 'short')
			{
				$nama_bulan = $this->nama_bulan_pendek($arraydate[1]);
			}
			else
			{
				$nama_bulan = $this->nama_bulan($arraydate[1]);
			}

			$output = $arraydate[2] . ' ' . $nama_bulan . ' ' . $arraydate[0] . $array[1];
            return $output;
		}
		else
		{
			return null;
		}

	}
    
    function nama_bulan($bulan)
    {
    	$nama = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 
								'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		return($nama[$bulan-1]);
	}

	function nama_bulan_pendek($bulan)
    {
		$nama = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 
								'Jun', 'Jul', 'Agust', 'Sept', 'Okt', 'Nov', 'Des');
		return($nama[$bulan-1]);
	}

	function konversi_tanggal($tanggal)
	{
		$array = explode('-', $tanggal);

		if(count($array) == 3)
		{
			$output = $array[2] .'/'. $array[1] .'/'. $array[0];
		}
		else if($tanggal && count($array))
		{
			$array = explode('/', $tanggal);
			$output = $array[2] .'-'. $array[1] .'-'. $array[0];
		}
		else
		{
			$output = null;
		}

		return $output;
	}

	function valid_tanggal($tanggal)
	{
		if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$tanggal)){
	        return true;
	    }else{
	        return false;
	    }
	}
}

?>
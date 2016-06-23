<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class ResizeImage extends Component{
	protected $dstSize = array();
	protected $imgResource;
	private $imgFrameResource;
	public $imgFileName;
	public $Height;
	public $Width;
	
	public function ReadImageFile(){
		$this->imgResource = imagecreatefromjpeg($this->imgFileName);
	}
	
	public function WriteToFile($dstFilename){
		if(file_exists($dstFilename)) unlink($dstFilename);
		imagejpeg($this->imgResource, $dstFilename);
	}
	
	public function Show(){
		imagejpeg($this->imgResource);
	}
	
	public function Destroy(){
		imageDestroy($this->imgResource);
	}
	
	private function GetDestSize($srcWidth, $srcHeight, $maxWidth, $maxHeight){
		if($srcWidth > $srcHeight){
			$dst['width'] = $maxWidth;
			$dst['height'] = $srcHeight*($maxWidth/$srcWidth);
		}elseif($srcWidth < $srcHeight){
			$dst['width'] = $srcWidth*($maxHeight/$srcHeight);
			$dst['height'] = $maxHeight;
		}else{ //jika sama
			if($maxWidth < $maxHeight){
				$dst['width'] = $maxWidth;
				$dst['height'] = $maxWidth;
			}elseif($maxWidth > $maxHeight){
				$dstHeight = $maxHeight;
				$dst['width'] = $maxHeight;
			}else{
				$dst['width'] = $maxWidth;
				$dst['height'] = $maxHeight;
			}
		}
		return($dst);
	}
	
	public function Resize($maxWidth, $maxHeight, $resizeIfSmaller){
		$this->Width 	= $maxWidth;
		$this->Height	= $maxHeight;
	
		$src['width'] = imageSX($this->imgResource);
		$src['height'] = imageSY($this->imgResource);
		
		if($maxWidth < $src['width'] || $maxHeight < $src['height'] || $resizeIfSmaller){
			$dst = $this->GetDestSize($src['width'], $src['height'], $maxWidth, $maxHeight);
			$temp = imagecreatetruecolor($dst['width'], $dst['height']);
			imagecopyresampled($temp, 
						$this->imgResource, 0, 0, 0, 0, 
						$dst['width'], $dst['height'], 
						$src['width'], $src['height']);
			$this->imgResource = $temp;
			$this->dstSize = $dst; 
		}else{
			$this->dstSize = $src;
		}
	}

	private function GetResourceFrame($maxWidth, $maxHeight){
		$this->imgFrameResource = imagecreatetruecolor($maxWidth, $maxHeight);
		$putih = imagecolorallocate($this->imgFrameResource, 255, 255, 255);
		$warnagaris = imagecolorallocate($this->imgFrameResource, 100, 100, 100);
		imagefill($this->imgFrameResource, 0, 0, $putih);
		imagerectangle($this->imgFrameResource, 0, 0, $maxWidth - 1, $maxHeight - 1, $warnagaris);			
	}
	
	public function ApplyFrame(){
		$this->GetResourceFrame($this->Width+2, $this->Height+2);
		imagecopy($this->imgFrameResource, $this->imgResource, 
					($this->Width-$this->dstSize['width']+2)/2, 
					($this->Height-$this->dstSize['height']+2)/2,
					0, 0, $this->dstSize['width'], $this->dstSize['height']);
		$this->imgResource = $this->imgFrameResource;
	}
}
?>
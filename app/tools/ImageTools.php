<?php

/**
 * Description of ImageTools
 * @version 1.0
 * @author jurriaan
 * @copyright (c) Oberon Interactive 2010
 */
class ImageTools {

	const TARGET_ASPECT_RATIO = 1;
	const FIT_AND_EXPAND = 2;
	const FIT_AND_EXPAND_IF_BIGGER = 3;

	/**
	 * Resizes JPEG image
	 * @param string $source
	 * @param string $target
	 * @param int $width
	 * @param int $height
	 * @param int $resizeMode - 1 - target aspect ratio,
	 * 					 2 - fit inside the width and height boundingbox, expand image,
	 * 					 3 - fit inside the width and height boundingbox, dont expand if smaller
	 */
	public static function resizeImage($source, $target, $width, $height, $resizeMode = 0, $jpegquality = 90) {
		// targetType
		if(!preg_match("/\.(jpe?g|png|gif|bmp)$/i", $target, $m)){
			return null;
		} else {
			$ext = strtoupper($m[1]);
		}

		// SETTINGS ///////////////////////////
		$imgdata = @getimagesize ($source);

		if ($imgdata[2] == IMAGETYPE_GIF) {
			$image = imagecreatefromgif($source);
		} elseif ($imgdata[2] == IMAGETYPE_JPEG) {
			$image = imagecreatefromjpeg($source);
		} elseif ($imgdata[2] == IMAGETYPE_PNG) {
			$image = imagecreatefrompng($source);
		} elseif ($imgdata[2] == IMAGETYPE_BMP || $imgdata[2] == IMAGETYPE_WBMP) {
			$image = imagecreatefromwbmp($source);
		}

		$result = self::resize($image, $width, $height, $resizeMode);

		if($ext == 'JPG' || $ext == 'JPEG'){
			imagejpeg($result, $target, $jpegquality);
		} else if($ext == 'PNG'){
			imagepng($result, $target);
		} else if($ext == 'GIF'){
			imagegif($result, $target);
		} else if($ext == 'BMP'){
			imagewbmp($result, $target);
		}

		// Clear memory
		@imagedestroy($result);

		return true;
	}

	/**
	 * Resizes JPEG image
	 * @param string $source
	 * @param string $target
	 * @param int $width
	 * @param int $height
	 * @param int $resizeMode - 1 - target aspect ratio,
	 * 							2 - fit inside the width and height boundingbox, expand image,
	 * 							3 - fit inside the width and height boundingbox, dont expand if smaller
	 */
	public static function resizeImageData($source, $width, $height, $resizeMode = 0) {
		$image = imagecreatefromstring($source);
		$result = self::resize($image, $width, $height, $resizeMode);

		ob_start();
		imagejpeg($result);
		$data = ob_get_contents();
		ob_clean();

		// Clear memory
		@imagedestroy($result);

		return $data;
	}

	protected static function resize($image, $width, $height, $resizeMode = 0){
		$sourceWidth  = imagesx($image);
		$sourceHeight = imagesy($image);

		if ($resizeMode == 1) {
			/*
			 * Use image aspectratio
			 */
			$targetBig = imagecreatetruecolor($width, $height);
			imagealphablending($targetBig, false);
			imagesavealpha($targetBig, true);
			//$bg = imagecolorallocate($targetBig, 255, 255, 255);
			//imagefill($targetBig, 0, 0, $bg);

			$sourceAspect = $sourceWidth / $sourceHeight;
			$targetAspect = $width / $height;

			if ($sourceAspect  > $targetAspect) {
				// Truncate sides if the image is too wide
				$sourceWidth = round($sourceHeight * $targetAspect);
				$deltah = 0;
				$deltaw = round(abs((imagesx($image) - $sourceWidth) / 2));
			} else {
				// Truncate the bottom and top if the image is too tall
				$sourceHeight = round($sourceWidth / $targetAspect);
				$deltaw = 0;
				$deltah = round(abs((imagesy($image) - $sourceHeight) / 2));
			}

			imageCopyResampled($targetBig, $image, 0, 0, $deltaw, $deltah, $width, $height, $sourceWidth, $sourceHeight);
		} elseif ($resizeMode == 2) {
			// Fit inside the width and height boundingbox, expand image
			$sourceAspect = $sourceWidth / $sourceHeight;
			$targetAspect = $width / $height;
			$deltah = 0;
			$deltaw = 0;

			if ($sourceAspect  > $targetAspect) {
				$height = round($width / $sourceAspect);
			} else {
				$width = round($height * $sourceAspect);
			}

			$targetBig = imagecreatetruecolor($width, $height);

			/*
			 * Use image aspectratio
			 */
			$bg = imagecolorallocate($targetBig, 255, 255, 255);
			imagefill($targetBig, 0, 0, $bg);
			imageCopyResampled($targetBig, $image, 0, 0, $deltaw, $deltah, $width, $height, $sourceWidth, $sourceHeight);
			imageinterlace($targetBig, 1);
		} elseif ($resizeMode == 3) {
			// Fit inside the width and height boundingbox, dont expand if smaller
			if ($sourceWidth < $width && $sourceHeight < $height) {
				$targetBig = imagecreatetruecolor($sourceWidth, $sourceHeight);
				imageinterlace($targetBig, 1);
				imagecopy($targetBig,$image,0,0,0,0,$sourceWidth, $sourceHeight);
			} else {
				$sourceAspect = $sourceWidth / $sourceHeight;
				$targetAspect = $width / $height;
				$deltah 	= 0;
				$deltaw 	= 0;

				if ($sourceAspect > $targetAspect) {
					if ($sourceWidth < $width) {
						$width = $sourceWidth;
					}

					$height = round($width / $sourceAspect);

				} else {
					if ($sourceHeight < $height) {
						$height = $sourceHeight;
					}

					$width = round($height * $sourceAspect);
				}

				$targetBig = imagecreatetruecolor($width, $height);

				/*
				 * Use image aspectratio
				 */
				$bg = imagecolorallocate($targetBig, 255, 255, 255);
				imagefill($targetBig, 0, 0, $bg);

				imageCopyResampled($targetBig, $image, 0, 0, $deltaw, $deltah, $width, $height, $sourceWidth, $sourceHeight);

				imageinterlace($targetBig, 1);
				//imagejpeg($targetBig, $image, $jpegquality);
			}

		} else {
			/*
			 * Use target aspectratio i.e 3/4
			 */

			$targetBig = imagecreatetruecolor($width, $height);
			imageCopyResampled($targetBig, $image, 0, 0 , 0, 0, $width, $height, $sourceWidth, $sourceHeight);
		}

		// Clear memory
		@imagedestroy($image);

		return $targetBig;
	}
}
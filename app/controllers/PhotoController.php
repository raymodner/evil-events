<?php

class PhotoController extends \BaseController {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showAction($type = 1, $w = 0, $h = 0, $name, $path = '') {
		// max image size 900x600
		// image_resize_min_width: 		30
		// image_resize_min_height: 	20
		// image_resize_max_width: 		2600
		// image_resize_max_height: 	1950

		$minwidth 	= 0;
		$minheight 	= 0;
		$maxwidth 	= 2600;
		$maxheight 	= 1950;

		if (Config::has('parameters.image_resize_min_width')) {
			$minwidth = Config::get('parameters.image_resize_min_width');
		}

		if (Config::has('parameters.image_resize_min_height')) {
			$minheight = Config::get('parameters.image_resize_min_height');
		}

		if (Config::has('parameters.image_resize_max_width')) {
			$maxwidth = Config::get('parameters.image_resize_max_width');
		}

		if (Config::has('parameters.image_resize_max_height')) {
			$maxheight = Config::get('parameters.image_resize_max_height');
		}

		$width = max($minwidth, min($w, $maxwidth));
		$height = max($minheight, min($h, $maxheight));

		try {
            
			$data_dir = $this->getDataDir() . DIRECTORY_SEPARATOR . GalleryItem::getFolder($type) . DIRECTORY_SEPARATOR;
			$photo_dir = $this->getPhotoDir() . DIRECTORY_SEPARATOR . GalleryItem::getFolder($type) . DIRECTORY_SEPARATOR;

			$src = $data_dir . $name;
            
			if (!file_exists($src)) {
                
				$color = 'eeeeee';
				if (Config::has('parameters.image_resize_color')) {
					$color = Config::get('parameters.image_resize_color');
				}

				$img = imagecreate($w, $h);
				$color = imagecolorallocate($img, hexdec(substr($color, 0, 2)), hexdec(substr($color, 2, 2)), hexdec(substr($color, 4, 2)));
				imagefill($img, 0, 0, $color);
				header('Content-Type: image/jpeg');
				imagejpeg ($img);
				imagedestroy($img);

				exit;
			}

			$info = getimagesize($src);

			if ($info) {

				$destination_dir = $photo_dir . $width . 'x' . $height . DIRECTORY_SEPARATOR;

				$destination = $destination_dir . $name;

				if (!file_exists($destination_dir)) {
					mkdir($destination_dir, 0777, true);
				} else {
					//		chmod( $destination_dir, 0777 );
				}

				if ($width == 0 && $height == 0) {
					$no_resize = TRUE;
				} else if ($width == 0 || $height == 0) {

					$no_resize = FALSE;
					$resize_type = ImageTools::FIT_AND_EXPAND;

					$w = $info[0];
					$h = $info[1];

					if ($height == 0) {
						$ar = $width / $w;
						$height = $h * $ar;
					} else {
						$ar = $height / $h;
						$width = $w * $ar;
					}
				} else {
					$no_resize = FALSE;
					$resize_type = ImageTools::TARGET_ASPECT_RATIO;
				}

				if (!$no_resize) {
					$quality = 80;
					if (Config::has('parameters.image_resize_quality')) {
						$quality = Config::get('parameters.image_resize_quality');
					}

					$success = ImageTools::resizeImage($src, $destination, $width, $height, $resize_type, $quality);
				} else {
					$success = copy($src, $destination);
				}

				//	chmod( $destination, 0776 );
				//		chmod( $photo_dir, 0775 );

				if ($success) {
					$fp = fopen($destination, 'rb');
					if ($fp) {
						$time = 60 * 60 * 24;
						header("Cache-Control: private, max-age={$time}, pre-check={$time}");
						header('Content-Type: image/jpeg');
						fpassthru($fp);

						exit;
					}
				}
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
			return new Response('Server Error', 500);
		}

		$reponse->setPublic();
		$reponse->setPrivate();

		$time = 60 * 60 * 24;

		// set the private or shared max age
		$reponse->setMaxAge($time);
		$reponse->setSharedMaxAge($time);

		return $reponse;
	}

}
<?php

class BaseController extends Controller {


	protected $data;



	function __construct(){
//		$this->addData('jsInclude', $this->getJsInclude());
	}

	protected function getJsInclude(){
		if(Request::ajax()){
			if(Request::isMethod('POST')){
				return false;
			}
		}
		return true;

	}


	protected function addData($key, $value){
		$this->data[$key] = $value;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		if ( ! is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}
    
    
    
    protected function getDataDir()  {
        if(Config::has('parameters.data_dir'))  {
            if(file_exists(Config::get('parameters.data_dir'))) {
                return Config::get('parameters.data_dir');
            }else{
                throw new Exception("Data folder does not exist");
            }
        }
        throw new Exception('No data_dir registered in config/parameters.php');
    }
    
    
    protected function getPhotoDir() {
        if(Config::has('parameters.photo_dir')) {
            if(file_exists(Config::get('parameters.photo_dir')))  {
                return Config::get('parameters.photo_dir');
            }else{
                throw new Exception("Photo folder does not exist");
            }
        }
        throw new Exception('No photo_dir registered in config/parameters.php');
    }

}
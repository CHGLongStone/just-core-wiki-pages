<?php
/**
 * WIKI
 * 
 * 
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE\SERVICE\UI\WIKI
 * 
 */
 
 

namespace JCORE\SERVICE\UI\WIKI;

use JCORE\TRANSPORT\SOA\SOA_BASE as SOA_BASE;
use JCORE\DAO\DAO as DAO;


/**
 * Class WIKI
 *
 * @package JCORE\SERVICE\UI\WIKI
*/
class WIKI { 
	/** 
	* 
	*/
	protected $serviceRequest = null;
	/** 
	* 
	*/
	public $serviceResponse = null;
	/** 
	* 
	*/
	public $error = null;
	/** 
	* 
	*/
	public $params = array();
	/** 
	* 
	*/
	public $changeList = array();
	
	
	/**
	* DESCRIPTOR: an empty constructor, the service MUST be called with 
	* the service name and the service method name specified in the 
	* in the method property of the JSONRPC request in this format
	* 		""method":"AJAX_STUB.aServiceMethod"
	* 
	* @param param 
	* @return return  
	*/
	public function __construct($args=null){
		#$this->parentTable = 'blackwatch_advertiser';
		$section = 'JUST_CORE';
		if(isset($args["section"])){
			$section = $args["section"];
		}
			
		$this->cfg = $GLOBALS["CONFIG_MANAGER"]->getSetting($section,'WIKI_ROUTES');
		return;
	}
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function init($args){
		$this->params = $args;
		return;
	}
	
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function isWIKIPage($args = null){
		#echo __METHOD__.'@'.__LINE__.'$GLOBALS["route"]<pre>['.var_export($GLOBALS["route"], true).']</pre>'.'<br>'.PHP_EOL;
		$segments = explode('/',$GLOBALS["route"]);
		#echo __METHOD__.'@'.__LINE__.'$segments<pre>['.var_export($segments, true).']</pre>'.'<br>'.PHP_EOL;
		if('WIKI' == $segments[0] || 'HOME' == $segments[0] ){
			return true;
		}
		
		return false;
	}
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function loadWIKIPage($args = null){
		if(!isset($args["namespace"])){
			
		}
		echo __METHOD__.'@'.__LINE__.'$GLOBALS["route"]<pre>['.var_export($GLOBALS["route"], true).']</pre>'.'<br>'.PHP_EOL;
		$segments = explode('/',$GLOBALS["route"]);
		echo __METHOD__.'@'.__LINE__.'$segments<pre>['.var_export($segments, true).']</pre>'.'<br>'.PHP_EOL;
		/**
		echo __METHOD__.'@'.__LINE__.'$this->cfg<pre>['.var_export($this->cfg, true).']</pre>'.'<br>'.PHP_EOL;
		*/
		
		if( isset($segments[1]) ){
			//$subSegments = explode(':',$segments[1]);
			if(isset($this->cfg[$segments[0]]["FILE_MAP"][$segments[1]])){

				$parsePath = $this->cfg[$segments[0]]["BASE_PATH"].$this->cfg[$segments[0]]["FILE_MAP"][$segments[1]];
				#echo '$parsePath['.$parsePath.']'.PHP_EOL;
				$markdown = file_get_contents($parsePath);

				$Parsedown = new \Parsedown();

				return $Parsedown->text($markdown);
				
			}
			echo __METHOD__.'@'.__LINE__.'$this->cfg['.$segments[0].']["FILE_MAP"]<pre>['.var_export($this->cfg[$segments[0]]["FILE_MAP"], true).']</pre>'.'<br>'.PHP_EOL;
			$index = array_search($segments[1],$this->cfg[$segments[0]]["FILE_MAP"]);
			if(false != $index ){
				$index = $this->cfg[$segments[0]]["FILE_MAP"][$index];
				echo __METHOD__.'@'.__LINE__.'$index<pre>['.var_export($index, true).']</pre>'.'<br>'.PHP_EOL;
			}
		}
		return false;
	}
	
}



?>
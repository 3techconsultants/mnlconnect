<?php

namespace Utilimum\DefaultException;

class DefaultException extends \Exception{

	var $_APICode;
	var $_APICodeTextSP;
	var $_APICodeTextEN;

	public function __construct($_APICode, $_APICodeTextSP, $_APICodeTextEN){
		$this->_APICode				= $_APICode;
		$this->_APICodeTextSP	= $_APICodeTextSP;
		$this->_APICodeTextEN	= $_APICodeTextEN;
	}

	public function getAPICode(){
		return $this->_APICode;
	}
	public function getError(){
		return ['APICode'=>$this->_APICode,'Status'=>'error','APICodeTextEN'=> $this->_APICodeTextSP,'APICodeTextSP'=>$this->_APICodeTextEN];
	}
	public function getAPICodeTextSP(){
		return $this->_APICodeTextSP;
	}

	public function getAPICodeTextEN(){
		return $this->_APICodeTextEN;
	}
}

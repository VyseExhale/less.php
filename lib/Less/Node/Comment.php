<?php

class Less_Tree_Comment extends Less_Tree{

	public function __construct($value, $silent, $index, $currentFileInfo ){
		$this->value = $value;
		$this->silent = !! $silent;
		$this->currentFileInfo = $currentFileInfo;
	}

	public function genCSS( $env, &$strs ){
		if( $this->debugInfo ){
			//self::toCSS_Add( $strs, tree.debugInfo($env, $this), $this->currentFileInfo, $this->index);
		}
		self::toCSS_Add( $strs, trim($this->value) );//TODO shouldn't need to trim, we shouldn't grab the \n
	}

	public function toCSS($env){
		return $env->compress ? '' : $this->value;
	}

	public function isSilent( $env ){
		$isReference = ($this->currentFileInfo && $this->currentFileInfo['reference'] && (!isset($this->isReferenced) || !$this->isReferenced) );
		$isCompressed = $env->compress && !preg_match('/^\/\*!/', $this->value);
		return $this->silent || $isReference || $isCompressed;
	}

	public function compile(){
		return $this;
	}

	public function markReferenced(){
		$this->isReferenced = true;
	}

}

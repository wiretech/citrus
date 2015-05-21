<?php

/**
 * This interface is to be applied to classes that can be returned as as data
 * using Citrus
 */

namespace Wiretech\Citrus\Response\Interfaces;

interface ResponseableInterface
{
	/**
	 * @return array in the desired format for returning in the 'data' index of Citrus's response OR return blank array for default 
	 * properties and values
	 */
	public function returnData();	
}
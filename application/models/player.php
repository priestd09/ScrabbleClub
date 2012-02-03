<?php

/*
CREATE  TABLE IF NOT EXISTS `wsc`.`players` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
	`firstname` VARCHAR(64) NOT NULL ,
	`lastname` VARCHAR(64) NOT NULL ,
	`email` VARCHAR(64) NOT NULL ,
	`password` VARCHAR(64) NOT NULL ,
	`naspa_id` VARCHAR(16) NULL ,
	`naspa_rating` SMALLINT NULL DEFAULT NULL ,
	`created_at` DATETIME NULL DEFAULT '0000-00-00' ,
	`updated_at` DATETIME NULL DEFAULT '0000-00-00' ,
	PRIMARY KEY (`id`) ,
	INDEX `fullname` (`lastname`(8) ASC, `firstname`(8) ASC) )
ENGINE = MyISAM
*/


class Player extends BaseModel {

	public static $timestamps = true;

	public $rules = array(
		'firstname'    => 'required|max:64',
		'lastname'     => 'required|max:64',
		'email'        => 'email|unique:players|max:64',
		'naspa_rating' => 'integer',
	);


	public function ratings()
	{
	 return $this->has_many('Rating');
	}

	public function games()
	{
		return $this->has_many('Game');
	}

	public function currentRating()
	{
		return $this->ratings()->order_by('date','desc')->first();
	}


	public function fullname()
	{
		return $this->firstname . ' ' . $this->lastname;
	}


}
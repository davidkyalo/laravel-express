<?php


class User {



	protected $props = function($bulder){
		$bulder->increments('id');
		$bulder->string('firstName');
		$bulder->string('lastName');
		$bulder->string('fullName')->readOnly()->get(function() {
			return $this->firstName. ' ' .$this->lastName;
		})
		$bulder->email('email')->unique();
		$bulder->string('password')->writeOnly()->set(function($password){
			return HASH::Make($password);
		});
		


	}
}
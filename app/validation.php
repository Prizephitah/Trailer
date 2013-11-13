<?php

/**
 * Custom validator
 *
 * @author Björn Hjortsten
 */
class CustomValidator extends Illuminate\Validation\Validator {
	
	public function validateEndDate($attribute, $value, $parameters) {
		$startDate = $this->getValue($parameters[0]);
		return (strtotime($value) >= strtotime($startDate));
	}
}

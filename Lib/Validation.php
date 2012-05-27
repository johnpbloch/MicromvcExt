<?php

namespace MicromvcExt\Lib;

class Validation extends \Core\Validation
{

	/**
	 * Check to see if the email entered is valid.
	 *
	 * @param string $data to validate
	 * @return boolean
	 */
	protected function email_rule( $data )
	{
		return (bool)filter_var( $data, FILTER_VALIDATE_EMAIL );
	}

	/**
	 * Test a value against a regular expression
	 *
	 * @param string $data to validate
	 * @param string $regex the regex to check the data against
	 * @return boolean
	 */
	protected function pattern_rule( $data, $pattern )
	{
		return preg_match( $pattern, $data );
	}

	/**
	 * Test a value to see if it is a float
	 * @param mixed $data to validate
	 * @return boolean
	 */
	protected function float_rule( $data )
	{
		return is_float( $data );
	}

	/**
	 * Test whether a value is numeric
	 * @param mixed $data
	 * @return bool
	 */
	protected function numeric_rule( $data )
	{
		return is_numeric( $data );
	}

	/**
	 * Test whether a value is greater than another value
	 * 
	 * @param int|float $data
	 * @param int|float $value
	 * @return type bool
	 */
	protected function greater_than_rule( $data, $value )
	{
		return $data > $value;
	}

	/**
	 * Test whether a value is less than another value
	 * 
	 * @param int|float $data
	 * @param int|float $value
	 * @return bool 
	 */
	protected function less_than_rule( $data, $value )
	{
		return $data < $value;
	}

}


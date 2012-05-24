<?php

namespace Lib;

class Validation extends \Core\Validation
{
	/**
	 * Check to see if the email entered is valid.
	 *
	 * @param string $data to validate
	 * @return boolean
	 */
	protected function email_rule($data)
	{
		return (bool) filter_var($data, FILTER_VALIDATE_EMAIL);
	}

	/**
	 * Test a value against a regular expression
	 *
	 * @param string $data to validate
	 * @param string $regex the regex to check the data against
	 * @return boolean
	 */
	protected function pattern_rule($data, $pattern)
	{
		return preg_match($pattern, $data);
	}
}


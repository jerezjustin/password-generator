<?php

namespace JerezJustin\Exceptions;

class PasswordGeneratorException extends \Exception
{
	public const EMPTY_CHARACTERS_STRING = 'No characters to generate password from. This is probably due to invalid configuration or defining
			all options as false.';

	public const INVALID_LENGTH = 'Invalid length. The length of the password should be a positive integer.';

	public static function emptyCharactersString(): PasswordGeneratorException
	{
		return new PasswordGeneratorException(self::EMPTY_CHARACTERS_STRING);
	}

	public static function invalidLength(): PasswordGeneratorException
	{
		return new PasswordGeneratorException(self::INVALID_LENGTH);
	}
}
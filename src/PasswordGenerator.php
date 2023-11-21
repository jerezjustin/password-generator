<?php

declare(strict_types=1);

namespace JerezJustin;

use JerezJustin\Exceptions\PasswordGeneratorException;

class PasswordGenerator
{
	private string $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,
	.<>?'";

	public function __construct(
		protected int  $length = 8,
		protected bool $lowercase = true,
		protected bool $uppercase = true,
		protected bool $numbers = true,
		protected bool $specialCharacters = false
	)
	{
		if ($length <= 0) {
			throw PasswordGeneratorException::invalidLength();
		}
	}

	public function length(int $length = 8): PasswordGenerator
	{
		if ($length <= 0) {
			throw PasswordGeneratorException::invalidLength();
		}

		$this->length = $length;

		return $this;
	}

	public function includeLowercase(bool $value = true): PasswordGenerator
	{
		$this->lowercase = $value;

		return $this;
	}

	public function includeUppercase(bool $value = true): PasswordGenerator
	{
		$this->uppercase = $value;

		return $this;
	}

	public function includeNumbers(bool $value = true): PasswordGenerator
	{
		$this->numbers = $value;

		return $this;
	}

	public function includeSpecialCharacters(bool $value = true): PasswordGenerator
	{
		$this->specialCharacters = $value;

		return $this;
	}

	public function generate(): string
	{
		$characters = $this->filterCharacters();

		if (empty(trim($characters))) {
			throw PasswordGeneratorException::emptyCharactersString();
		}

		$randomPassword = '';

		for ($i = 0; $i < $this->length; $i++) {
			$randomPassword .= $characters[rand(0, strlen($characters) - 1)];
		}

		return $randomPassword;
	}

	protected function filterCharacters(): string
	{
		$pattern = '';

		if (!$this->lowercase) {
			$pattern .= 'a-z';
		}

		if (!$this->uppercase) {
			$pattern .= 'A-Z';
		}

		if (!$this->numbers) {
			$pattern .= '0-9';
		}

		if (!$this->specialCharacters) {
			$pattern .= '!@#$%^&*()\-_=+\[\]{}|;:,.<>?\'';
		}

		return empty($pattern)
			? $this->characters
			: preg_filter("/[$pattern]/", '', $this->characters);
	}
}
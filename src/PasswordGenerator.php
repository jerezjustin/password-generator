<?php

declare(strict_types=1);

namespace JerezJustin;

use JerezJustin\Exceptions\PasswordGeneratorException;

class PasswordGenerator
{
	private array $characterTypeRange = [
		'lowercase' => 'a-z',
		'uppercase' => 'A-Z',
		'numbers' => '0-9',
		'specialCharacters' => '!@#$%^&*()\-_=+\[\]{}|;:,.<>?\'',
	];

	private string $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>?'";

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

		$password = '';

		foreach ($this->getRequiredCharacterTypes() as $type => $value) {
			if ($value) {
				$password .= $this->getRandomCharacter($characters, $type);
			}
		}

		$remainingLength = $this->length - strlen($password);

		for ($i = 0; $i < $remainingLength; $i++) {
			$password .= $this->getRandomCharacter($characters);
		}

		return str_shuffle($password);
	}

	protected function getRandomCharacter(string $characters, string $type = null): string
	{
		$allowedCharacters = is_null($type)
			? $characters
			: $this->filterCharactersByType($characters, $type);

		return $allowedCharacters[rand(0, strlen($allowedCharacters) - 1)];
	}

	protected function getRequiredCharacterTypes(): array
	{
		return [
			'lowercase' => $this->lowercase,
			'uppercase' => $this->uppercase,
			'numbers' => $this->numbers,
			'specialCharacters' => $this->specialCharacters,
		];
	}

	protected function filterCharacters(): string
	{
		$pattern = '';

		foreach ($this->getRequiredCharacterTypes() as $characterType => $value) {
			if (!$value) {
				$pattern .= $this->characterTypeRange[$characterType];
			}
		}

		return empty(trim($pattern))
			? $this->characters
			: preg_filter("/[$pattern]/", '', $this->characters);
	}

	protected function filterCharactersByType(string $characters, string $type): string
	{
		return match ($type) {
			'lowercase' => preg_replace('/[^a-z]/', '', $characters),
			'uppercase' => preg_replace('/[^A-Z]/', '', $characters),
			'numbers' => preg_replace('/[^0-9]/', '', $characters),
			'specialCharacters' => preg_replace('/[^!@#$%^&*()\-_=+\[\]{}|;:,.<>?\'"]/u', '', $characters),
			default => $characters
		};
	}
}
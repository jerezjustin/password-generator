<?php

declare(strict_types=1);

namespace JerezJustin\Tests;

use JerezJustin\Exceptions\PasswordGeneratorException;
use JerezJustin\PasswordGenerator;
use PHPUnit\Framework\TestCase;

class PasswordGeneratorTest extends TestCase
{

	private PasswordGenerator $passwordGenerator;

	public function setUp(): void
	{
		$this->passwordGenerator = new PasswordGenerator();
		$this->passwordGenerator->includeSpecialCharacters(true);
	}

	public function test_it_can_create_a_password_with_default_configuration(): void
	{

		$password = $this->passwordGenerator
			->length($expectedLength = 16)
			->generate();

		$this->assertIsString($password);
		$this->assertEquals($expectedLength, strlen($password));
	}

	public function test_it_can_create_a_password_without_lowercase_characters(): void
	{
		$this->passwordGenerator->includeLowercase(false);

		$password = $this->passwordGenerator->generate();

		$this->assertFalse((bool)preg_match('/[a-z]/', $password));
	}

	public function test_it_can_create_a_password_without_uppercase_characters(): void
	{
		$this->passwordGenerator->includeUppercase(false);

		$password = $this->passwordGenerator->generate();

		$this->assertFalse((bool)preg_match('/[A-Z]/', $password));
	}

	public function test_it_can_create_a_password_without_numeric_characters(): void
	{
		$this->passwordGenerator->includeNumbers(false);

		$password = $this->passwordGenerator->generate();

		$this->assertFalse((bool)preg_match('/[0-9]/', $password));
	}

	public function test_it_can_create_a_password_without_special_characters(): void
	{
		$this->passwordGenerator->includeSpecialCharacters(false);

		$password = $this->passwordGenerator->generate();

		$this->assertFalse((bool)preg_match('/[!@#$%^&*()\-_=+\[\]{}|;:,.<>?\']/', $password));
	}

	public function test_it_throws_exception_if_users_try_to_create_password_with_all_the_configuration_in_false(): void
	{
		$this->expectException(PasswordGeneratorException::class);

		$password = $this->passwordGenerator
			->includeLowercase(false)
			->includeUppercase(false)
			->includeNumbers(false)
			->includeSpecialCharacters(false)
			->generate();
	}

	public function test_it_throws_exception_if_users_provide_invalid_length(): void
	{
		$this->expectException(PasswordGeneratorException::class);

		$this->passwordGenerator->length(0)->generate();
	}
}
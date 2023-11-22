<?php

declare(strict_types=1);

namespace JerezJustin\Tests\Support;

trait PasswordGeneratorConfigProvider
{
	public static function passwordGeneratorConfigProvider(): array
	{
		$combinations = [
			[
				'lowercase' => true,
				'uppercase' => true,
				'numbers' => true,
				'specialCharacters' => true,
			],
			[
				'lowercase' => false,
				'uppercase' => true,
				'numbers' => true,
				'specialCharacters' => true,
			],
			[
				'lowercase' => true,
				'uppercase' => false,
				'numbers' => true,
				'specialCharacters' => true,
			],
			[
				'lowercase' => true,
				'uppercase' => true,
				'numbers' => false,
				'specialCharacters' => true,
			],
			[
				'lowercase' => true,
				'uppercase' => true,
				'numbers' => true,
				'specialCharacters' => false,
			],
			[
				'lowercase' => false,
				'uppercase' => false,
				'numbers' => true,
				'specialCharacters' => true,
			],
			[
				'lowercase' => false,
				'uppercase' => true,
				'numbers' => false,
				'specialCharacters' => true,
			],
			[
				'lowercase' => true,
				'uppercase' => false,
				'numbers' => false,
				'specialCharacters' => true,
			],
			[
				'lowercase' => true,
				'uppercase' => true,
				'numbers' => false,
				'specialCharacters' => false,
			],
			[
				'lowercase' => false,
				'uppercase' => false,
				'numbers' => false,
				'specialCharacters' => true,
			],
			[
				'lowercase' => false,
				'uppercase' => true,
				'numbers' => false,
				'specialCharacters' => false,
			],
			[
				'lowercase' => true,
				'uppercase' => false,
				'numbers' => false,
				'specialCharacters' => false,
			],
			[
				'lowercase' => false,
				'uppercase' => false,
				'numbers' => true,
				'specialCharacters' => false,
			],
			[
				'lowercase' => false,
				'uppercase' => true,
				'numbers' => false,
				'specialCharacters' => false,
			],
			[
				'lowercase' => true,
				'uppercase' => false,
				'numbers' => true,
				'specialCharacters' => false,
			]
		];

		return array_map(fn($config) => [$config], $combinations);
	}
}

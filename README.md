# Password Generator

This is a basic password generator created with the finality of learning the process of creating packages using PHP.

## How to use 

The password generator is easy to use it consists of only one class to generate password. Here is an example of how 
can you use it.

```php
$passwordGenerator = new JerezJustin\PasswordGenerator();

$password = $passwordGenerator->generate();
```

By default, the password generator will include lowercase, uppercase and numeric characters, and it will have a default length of 8 characters. This can be changed by providing a value for the different arguments to the constructor of the class.

```php
$passwordGenerator = new JerezJustin\PasswordGenerator(
    length: 8,
    lowercase: true,
    uppercase: true,
    numbers: true,
    specialCharacters: false   
);

$password = $passwordGenerator->generate();
```

Additionally, you can call methods to configure the password generator as in the following example:

```php
$passwordGenerator = new JerezJustin\PasswordGenerator();

$password = $passwordGenerator
                ->length(8)
                ->includeLowercase(true)
                ->includeUppercase(true)
                ->includeNumbers(true)
                ->includeSpecialCharacters(false)
                ->generate();
```

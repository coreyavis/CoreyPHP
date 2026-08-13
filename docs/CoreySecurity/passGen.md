# passGen

Generates a cryptographically secure random password of a specified length based on the current active configuration rules. The generator guarantees that at least one character from each active character pool is present in the final password.

## Usage

```
passGen(integer $len = 16, string $exclusions = ''): string
```

## Parameters

**len** (integer)
: The desired length of the password. Automatically coerced to `minLength` if it falls below the configured threshold. (*default*: `16`) *^(optional)^*

**exclusions** (string)
: A custom string of characters to exclude from the generator pool. Note: This parameter is strictly case-sensitive (e.g., excluding `a` will not exclude `A`). (*default*: `''`) *^(optional)^*

> :pushpin: Why are certain symbols (like `&`, `"`, `<`, `\`) already excluded?
>
> This generator uses a curated Safe Symbol List: `! @ # $ % ^ * + - = _ . , ? : ; ( )`
>
> To ensure maximum compatibility across the web, certain high-entropy symbols have been intentionally excluded. Characters like quotes (`"`, `'`), slashes (`\`, `/`), ampersands (`&`), and angle brackets (`<`, `>`) are frequently used as syntax in programming languages, HTML, SQL databases, and command-line scripts. Including them can cause poorly sanitized systems to crash, truncate your password, or fail during login.
>
> Our curated list maximizes password strength (entropy) while ensuring your generated passwords won't unexpectedly break the websites or apps you use them on.

## Return Value

Returns a secure password at specified length.

## Examples

```
$sec->passGen() = 16-character password
$sec->passGen(12) = 12-character password
$sec->passGen(14, '!') = 14-character password, excluding the '!' (exclamation)
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| exclude.similar | false | *bool* | Exclude similar characters from password generation (`0`, `O`, `o`, `1`, `l`, `I`). |
| exclusion | '' (Empty) | *string* | Letters, numbers, or symbols you would like to exclude from password generation as string. |
| minLength | 8 | *integer* | Minimum password length. |
| numbers | true | *bool* | Allow numbers in password generation. |
| symbols | true | *bool* | Allow symbols in password generation. (`!@#$%^*+-=_.,?:;()`) |
| uppercase | true | *bool* | Allow uppercase letters in password generation. |

## Debug Errors

- Throws an exception if the character pool is empty after applying configurations and exclusions.
- Throws an exception via `validatePool()` if any active character category is completely wiped out by the exclusion list.
- Throws an exception if the method times out due to too many attempts.

## Related Methods

[idGen](idGen.md) | [passEntropy](passEntropy.md) | [passStrength](passStrength.md) | [saltGen](saltGen.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Generators](../CoreySecurity.md#generators)

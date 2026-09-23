# credentialGen

Generates a secure, random password alongside a unique salt, its hashed representation, and the hashing algorithm used. This method is ideal for creating new user credentials during registration or password resets.

## Usage

```
credentialGen(integer $passLength = 16, ?string $algo = null): array
```

## Parameters

**passLength** (integer)
: The desired length of the generated password. (*default*: `16`) *^(optional)^*

**algo** (string)
: A specific hashing algorithm to use. Case-insensitive. If `null`, the currently set algorithm or class default is used. (*default*: `null`) *^(optional)^*

## Return Value

(array)
: Returns an `array` containing the generated credential details:

| Key | Type | Description | Dependancy |
| --- | --- | --- | --- |
| password | *string* | The plaintext randomly generated password. | `passGen()` |
| salt | *string* | The unique salt generated for hashing. | `saltGen()` |
| hash | *string* | The hashed version of the password combined with the salt. | `passHash()` |
| algorithm | *string* | The normalized (lowercase, trimmed) name of the algorithm used. | `getAlgorithm()` |

## Examples

```
$sec->credentialGen();
// Result: Array(
    [password] => W1-F1_p4$$w0rd?!
    [salt] => 5adc0ffee1584dc0d3f33dd34d833f88
    [hash] => e7eeec6b1076f8e404b90150937c569ff459194294ca854ee661c94d80b7e3f8
    [algorithm] => sha256
)
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| exclude.similar | false | *bool* | Exclude similar characters from password generation (`0`, `O`, `o`, `1`, `l`, `I`). |
| exclusion | '' (Empty) | *string* | Letters, numbers, or symbols you would like to exclude from password generation as string. |
| numbers | true | *bool* | Allow numbers in password generation. |
| symbols | true | *bool* | Allow symbols in password generation. (`!@#$%^*+-=_.,?:;()`) |
| uppercase | true | *bool* | Allow uppercase letters in password generation. |

## Debug Errors

- No debug errors.

## Related Methods

[getAlgorithm](getAlgorithm.md) | [passGen](passGen.md) | [passHash](passHash.md) | [saltGen](saltGen.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Generators](../CoreySecurity.md#generators)

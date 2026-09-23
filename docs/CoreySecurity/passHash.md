# passHash

Secures user passwords by prefixing them with a cryptographic salt and hashing the combined value. This method delegates algorithm validation and fallback handling entirely to the core `hash()` method, keeping the implementation simple and incredibly secure.

## Usage

```
passHash(string $pw, string $salt, ?string $algo = null): string
```

## Parameters

**pw** (string)
: The plaintext password to be hashed. Cannot be empty.

**salt** (string)
: A unique cryptographic salt to prefix to the password. Cannot be empty.

**algo** (string|null)
: A specific hashing algorithm to use. Case-insensitive. If `null`, the currently set algorithm or class default is used. (*default*: `null`) *^(optional)^*

## Return Value

(string)
: Returns the combined hashed password and salt.

> :pushpin: To ensure maximum security, this method strictly enforces the presence of both a password and a salt.
>
> If the password is empty and the exception is suppressed, it returns a safe, non-bypassable, randomized `error_` hex string.
>
> If the salt is empty it is treated as a failure and the method will halt, or safely return a randomized `error_` hex string to prevent weak, unsalted password hashes from ending up in your database.
>
> If an invalid algorithm name is passed (e.g., `'sha2560'`), the validation failure is caught and handled seamlessly downstream by the `hash()` method.

## Examples

1. Standard Salted Password Hashing

Uses your primary configured class algorithm.

```
$sec->passHash('password', 'salt');
// Result (using default sha256): "13601bda4ea78e55a07b98866d2be6be..."
```

2. Specific Hashing Algorithm Override

Hashes the salted password using a specific algorithm (e.g., `md5`) on the fly.

```
$sec->passHash('password', 'salt', 'md5');
// Result (using md5): "67a1e09bb1f83f50..."
```

3. Handling Empty Parameter Failures (Suppressed Exception)

If an empty password is passed and the exception is caught or suppressed, a safe, unique token is returned:

```
$sec->passHash('', 'salt');
// Result: "error_5f18c642ad91bc1b47df1120409fe6923cf992fa..."
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| algorithm | sha256 | *string* (See: ) | Default hashing algorithm. |

## Debug Errors

- Throws an exception if the password is empty.
- Triggers a warning if the salt is empty.

## Related Methods

[errorHash](errorHash.md) | [hash](hash.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Hashing](../CoreySecurity.md#hashing)

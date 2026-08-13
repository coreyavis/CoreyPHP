# hash

Generates a cryptographic hash of a single string value. This method supports on-the-fly algorithm switching, automatic system default fallbacks, and features a unique fail-secure fallback system designed to protect the application if validation exceptions are suppressed.

## Usage

```
hash(string $data, ?string $algo = null): string
```

## Parameters

**data** (string)
: The raw, plaintext string data to be hashed.

**algo** (string|null)
: A specific hashing algorithm to use. Case-insensitive. If `null`, the currently set algorithm or class default is used. (*default*: `null`) *^(optional)^*

## Return Value

Returns the succesfully hashed string or fallback string.

> :pushpin: If a developer passes an invalid algorithm (e.g., a typo like `sha2560`) and the resulting exception is caught and suppressed by the application's global exception handler, the method refuses to return an empty string `''` or a silent, successful-looking hash.
>
> Instead, it generates a secure, randomized fail-safe token:
>
> > Output = "error_" + 56 characters of cryptographically secure random hexadecimal bytes
>
> This results in a unique 62-character string (e.g., `error_7f1b623ac78e10408...`).
>
> This prevents authentication bypass since multiple failed attempts will never produce matching strings. It elimates false successes since the `error_` prefix serves as an unmistakable visual flag. It also protects database integrity.
 
## Examples

1. Default Behavior (Using Class/Config Settings)

Uses the primary algorithm established during class initialization.

```
$sec->hash('user@example.com');
// Result (using default sha256): "b4c9a289323b21a01c3e940f150eb9b8..." 
```

2. Dynamic Algorithm Override

Allows choosing an alternative algorithm on the fly (for example, generating an MD5 hash for a Gravatar URL lookup).

```
$sec->hash('user@example.com', 'md5');
// Result (using md5): "b58996c504c56387..." 
```

3. Handling Supressed Failures

If an invalid algorithm is requested but the execution is forced to continue.

```
$sec->hash('user@example.com', 'invalid-algo-name');
// Result: "error_5f18c642ad91bc1b47df1120409fe6923cf992fa..."
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| algorithm | sha256 | *string* (See: ) | Default hashing algorithm. |

## Debug Errors

- Throws an exception if an invalid or unsupported algorithm name is passed to the `$algo` parameter.

## Related Methods

[errorHash](errorHash.md) | [passHash](passHash.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Hashing](../CoreySecurity.md#hashing)

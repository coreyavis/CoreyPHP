# errorHash *[Protected]*

Creates a safe, non-bypassable, randomized `error_` hex string to prevent weak, invalid, or unsalted password hashes from ending up in your database or validating as a match.

## Usage

```
errorHash(): string
```

## Parameters

- Takes no arguments.

## Return Value

(string)
: Returns a `string` containing `error_` prepended to a cryptographically secure, randomized 56-character hex string (total length of 62 characters).

> :pushpin: This method serves as a critical security circuit breaker.
>
> During normal operations, methods like `passHash()` and `hash()` will trigger error logs or throw exceptions when they encounter invalid states (such as an empty password, missing salt, or unsupported algorithm).
>
> However, if those error exceptions are bypassed, suppressed (e.g., using `@`), or ignored by the calling application, returning a blank string or a predictable error value could create critical security vulnerabilities (e.g., allowing empty hashes to match in a database query).
>
> How `errorHash()` Protects Your System
>
> - Guaranteed Non-Match: Because the output is generated using cryptographically secure random bytes (`random_bytes(28)`), it is statistically impossible for two separate calls of `errorHash()` to produce the same string.
>
> - Neutralizes Bypasses: Even if an attacker manages to bypass the exception handler and force the application to save or compare the returned string, the resulting value will never match another generated error hash, nor will it match any valid password.
>
> - Easy Identification: The `error_` prefix allows system administrators to easily spot corrupted or bypassed hash entries in database records during audits.

## Examples

```
$sec->errorHash();
// Result: "error_5f18c642ad91bc1b47df1120409fe6923cf992fa..."
```

## Debug Errors

- No debug errors.

## Related Methods

[hash](hash.md) | [passHash](passHash.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Helpers](../CoreySecurity.md#helpers)

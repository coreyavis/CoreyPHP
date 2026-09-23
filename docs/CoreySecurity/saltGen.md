# saltGen

Generates a cryptographically secure, high-entropy salt string formatted in hexadecimal notation. This salt is designed to be globally unique per user to protect stored passwords against precomputed rainbow table and dictionary attacks.

## Usage

```
saltGen(integer $len = 32): string
```

## Parameters

**len** (integer)
: The desired length of the returned hexadecimal string. Automatically enforced to a minimum baseline of `32` characters (equivalent to 16 raw bytes / 128 bits of entropy) to ensure cryptographic safety. (*default*: `32`) *^(optional)^*

## Return Value

(string)
: Returns a string consisting strictly of alphanumeric hexadecimal characters (`0-9`, `a-f`).

> :pushpin: Why a Salt is Required:
>
> Without a salt, identical passwords produce identical hashes, leaving them vulnerable to instant decryption. A unique salt forces every password hash to be completely distinct, neutralizing precomputation attacks and forcing hackers to guess passwords one by one.

## Examples

```
$sec->saltGen() = 32-character salt
$sec->saltGen(64) = 64-character salt
```

## Debug Errors

- No debug errors.

## Related Methods

[idGen](idGen.md) | [passGen](passGen.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Generators](../CoreySecurity.md#generators)

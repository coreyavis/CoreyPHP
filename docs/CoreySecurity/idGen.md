# idGen

Generates a cryptographically secure, numeric ID string. If a prefix string is provided, it is cleaned and factored directly into the total requested length.

## Usage

```
idGen(integer $len = 12, ?string $prefix = null): string
```

## Parameters

**len** (integer)
: The total target length of the returned ID string (including the prefix). Automatically enforced to a minimum based on your `minLength` configuration. (*default*: `12`) *^(optional)^*

**prefix** (string)
: An optional prefix (e.g., `usr_`, `inv_`). If provided, it is trimmed of surrounding whitespace and prepended to the numeric sequence. (*default*: `null`) *^(optional)^*

## Return Value

Returns a string consisting of the optional prefix and a cryptographically secure, random sequence of digits (`0-9`).

> If the length of the `$prefix` is close to or exceeds the target `$len`, the method automatically enforces a fallback minimum of 4 random digits to ensure the ID preserves a safe level of unique entropy and never crashes.
>
> If no `$prefix` is provided (or it trims down to an empty string), the generator guarantees the ID will never start with a `0` (using `1-9` for the first digit) to keep it safe for integer parsing.

## Examples

1. Standalone ID (Ensures no leading zero, default 12 digits)

```
$sec->idGen() = 135798642374
```

2. Custom length prefix ID (exactly 12 characters total)

```
$sec->idGen(14, 'inv_') = inv_0135798642
```

3. Fail-safe Fallback (Target is 4, prefix is 5 characters)

```
$sec->idGen(4, 'item_') = item_1234
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| minLength | 8 | *integer* | Minimum password length. |

## Debug Errors

- No debug errors.

## Related Methods

[passGen](passGen.md) | [saltGen](saltGen.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Generators](../CoreySecurity.md#generators)

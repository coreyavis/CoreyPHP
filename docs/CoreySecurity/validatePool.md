# validatePool *[Protected]*

Pre-validates the integrity of the built character pool before password generation begins. It ensures that no active character category required by the configuration has been completely removed by exclusions.

## Usage

```
validatePool(string $pool): bool
```

## Parameters

**pool** (string)
: The compiled and filtered master character pool to validate.

## Return Value

Returns `true` on success.

### Validation Rules

The method performs a "fail-fast" check using regular expressions against the `$pool` variable:

- Lowercase letters must always be present.
- If `uppercase` is enabled, at least one uppercase letter must exist in the pool.
- If `numbers` is enabled, at least one number must exist in the pool.
- If `symbols` is enabled, at least one symbol must exist in the pool.

## Examples

```
$sec->validatePool('abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%^*+-=_.,?:;()') = true
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| numbers | true | *bool* | Allow numbers in password generation. |
| symbols | true | *bool* | Allow symbols in password generation. (`!@#$%^*+-=_.,?:;()`) |
| uppercase | true | *bool* | Allow uppercase letters in password generation. |

## Debug Errors

- Throws an exception if all lowercase letters are excluded.
- Throws an exception if all uppercase letters are excluded when `uppercase` is enabled.
- Throws an exception if all numbers are excluded when `numbers` is enabled.
- Throws an exception if all symbols are excluded when `symbols` is enabled.

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Helpers](../CoreySecurity.md#helpers)

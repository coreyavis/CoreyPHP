# isEmail

Validates if a string is a valid email address.

## Usage

```
isEmail(mixed $email, array &$matches): bool
```

## Parameters

**email** (mixed)
: The email address to validate.

**matches** (array)
: If matches is populated, then it returns an array that is filled with the results of the match. **^(optional)^**

## Return Value

(bool)
: Returns `true` on success and `false` on failure.

If `$matches` is provided then an array is returned with the following:
| Key | Example | Description |
| --- | --- | --- |
| email | `user@example.com` | The full email address. |
| local | `user` | The local part of the email address (everything before the `@`). |
| domain | `example.com` | The entire domain part of the email address (everything after the `@`). |

## Examples

```
$fx->isPhone('user@example.com') = true
$fx->isPhone('admin123@domain.org') = true
$fx->isPhone('@domain.io') = false
```

## Debug Errors

- No debug errors.

## Related Methods

[isPhone](isPhone.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Validation](../CoreyFX.md#validation)

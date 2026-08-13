# codeToHex

Part of the custom CoreyPHP color code utility system used to dynamically render and style generated files. Converts a single CoreyPHP color code character into a 6-digit hex color string, prefixed with `#`.

## Usage

```
codeToHex(string|int $colorCode): string
```

## Parameters

**colorCode** (string|integer)
: A case-insensitive single character (`a-z`, `0-9`).

### Color Code

- See the internal mapping rules: [CoreyPHP Color Code Utility System Documentation](../ColorCodes.md)

## Return Value

Returns a lowercase, 7-character CSS-compatible hex value (e.g., `"#ffff00"`).

## Examples

```
$cphp->codeToHex('y') = #ffff00 (yellow)
```

## Debug Errors

- No debug errors.

## Related Methods

[codeToColor](codeToColor.md) | [codeToRgb](codeToRgb.md) | [colorToCode](colorToCode.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Color Code](../CoreyPHP.md#color-code)

# colorToCode

Part of the custom CoreyPHP color code utility system used to dynamically render and style generated files. Converts a human-readable color name back into its corresponding single-character CoreyPHP color code.

## Usage

```
colorToCode(string $color): string
```

## Parameters

**color** (string)
: The full name of the color. This method is case-insensitive and automatically strips internal whitespace (e.g., both `Sky Blue` and `skyblue` map to the same color).

### Color Code

- See the internal mapping rules: [CoreyPHP Color Code Utility System Documentation](../ColorCodes.md)

## Return Value

Returns the lowercase single-character representation of the color. Defaults to `"w"` (white) if the name is unrecognized.

## Examples

```
$cphp->colorToCode('yellow') = y
```

## Debug Errors

- No debug errors.

## Related Methods

[codeToColor](codeToColor.md) | [codeToHex](codeToHex.md) | [codeToRgb](codeToRgb.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Color Code](../CoreyPHP.md#color-code)

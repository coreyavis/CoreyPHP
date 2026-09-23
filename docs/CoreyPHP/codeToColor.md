# codeToColor

Part of the custom CoreyPHP color code utility system used to dynamically render and style generated files. Converts a single CoreyPHP color code character into its English name representation.

## Usage

```
codeToColor(string|int $colorCode): string
```

## Parameters

**colorCode** (string|integer)
: A case-insensitive single character (`a-z`, `0-9`).

### Color Code

- See the internal mapping rules: [CoreyPHP Color Code Utility System Documentation](../ColorCodes.md)

## Return Value

(string)
: Returns the lowercase common name of the color (e.g., `"yellow"`, `"blue"`). Defaults to `"white"` if the code is unrecognized.

## Examples

```
$cphp->codeToColor('y') = yellow
```

## Debug Errors

- No debug errors.

## Related Methods

[codeToHex](codeToHex.md) | [codeToRgb](codeToRgb.md) | [colorToCode](colorToCode.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Color Code](../CoreyPHP.md#color-code)

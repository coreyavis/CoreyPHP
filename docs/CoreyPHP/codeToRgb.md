# codeToRgb

Part of the custom CoreyPHP color code utility system used to dynamically render and style generated files. Converts a single CoreyPHP color code character into an indexed array containing Red, Green, and Blue channels.

## Usage

```
codeToRgb(string|int $colorCode): array
```

## Parameters

**colorCode** (string|integer)
: A case-insensitive single character (`a-z`, `0-9`).

### Color Code

- See the internal mapping rules: [CoreyPHP Color Code Utility System Documentation](../ColorCodes.md)

## Return Value

(array)
: Returns a 3-element array matching `[red, green, blue]` where each element is an integer between `0` and `255`. Defaults to `[255, 255, 255]` (white) if unrecognized.

## Examples

```
$cphp->codeToRgb('y') = [255, 255, 0] (yellow)
```

## Debug Errors

- No debug errors.

## Related Methods

[codeToColor](codeToColor.md) | [codeToHex](codeToHex.md) | [colorToCode](colorToCode.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Color Code](../CoreyPHP.md#color-code)

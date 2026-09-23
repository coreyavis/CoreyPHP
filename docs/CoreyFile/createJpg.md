# createJpg

Generates and saves a true-color pixel-art style JPG image to disk based on a grid of color codes.

> :pushpin: This method relies internally on the **CoreyPHP Color Code Utility System** to translate individual characters into RGB values. For a complete list of supported color characters or to modify the color palette, please refer to the [Color Code Lookup Table](../ColorCodes.md#color-code-lookup-table).

## Usage

```
createJpg(string $filename, ?string $colors = null, integer $width = 1, integer $height = 1): string|bool
```

## Parameters

**filename** (string)
: The desired name of the output file. The method automatically sanitizes this path and enforces the `.jpg` extension.

**colors** (string|null)
: A continuous string of single character color codes mapping left-to-right. Any unrecognized character defaults to white. If it contains exactly one character (e.g., 'y'), the method skips pixel mapping and instantly floods the entire canvas background with that color. (*default*: `null`) *^(optional)^*

- See the internal mapping rules: [CoreyPHP Color Code Utility System Documentation](../ColorCodes.md)

**width** (integer)
: The total width of the image layout in pixels. (*default*: `1`) *^(optional)^*

**height** (integer)
: The total height of the image layout in pixels. (*default*: `1`) *^(optional)^*

## Return Value

(string|bool)
: Returns the absolute `string` path to the saved file on success, or `false` on failure.

## Examples

```
$cphp->createJpg('image', 'yyywwwyyy', 3, 3);
// Result: Outputs image.jpg with a width of 3 pixels and a height of 3 pixels. Top 3 pixels and bottom 3 pixel would be yellow and the middle 3 pixels would be white.

$cphp->createJpg('white', null, 5, 5);
// Result: Outputs white.jpg with a width of 5 pixels and a height of 5 pixels with a fully white background.
```

## Debug Errors

- Logs a notice if the colors string length is greater than the width x height.
- Triggers a warning if the file already exists.
- Throws an exception if image fails to save to disk.

## Related Methods

[createPng](createPng.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)

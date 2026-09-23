# createPng

Generates and saves a true-color pixel-art style PNG image to disk based on a grid of color codes and supports alpha-channel transparency.

> :pushpin: This method relies internally on the **CoreyPHP Color Code Utility System** to translate individual characters into RGB values. For a complete list of supported color characters or to modify the color palette, please refer to the [Color Code Lookup Table](../ColorCodes.md#color-code-lookup-table).

## Usage

```
createPng(string $filename, ?string $colors = null, int $width = 1, int $height = 1): string|bool
```

## Parameters

**filename** (string)
: The desired name of the output file. The method automatically sanitizes this path and enforces the `.png` extension.

**colors** (string|null)
: A continuous string of single character color codes mapping left-to-right. Any unrecognized character defaults to white. If left blank image is fully transparent or you can use spaces (`' '`) to leave pixel transparent. (*default*: `null`) *^(optional)^*

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
$cphp->createPng('image', 'yyywwwyyy', 3, 3);
// Result: Outputs image.png with a width of 3 pixels and a height of 3 pixels. Top 3 pixels and bottom 3 pixel would be yellow and the middle 3 pixels would be white.

$cphp->createPng('transparent', null, 5, 5);
// Result: Outputs transparent.png with a width of 5 pixels and a height of 5 pixels with a fully transparent background.

$cphp->createPng('checkered', 'k k k k k', 3, 3);
// Result: Outputs checkered.png with a width of 3 pixels and a height of 3 pixels, in a checkered pattern of black and transparency.
```

## Debug Errors

- Logs a notice if the colors string length is greater than the width x height.
- Triggers a warning if the file already exists.
- Throws an exception if image fails to save to disk.

## Related Methods

[createJpg](createJpg.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)

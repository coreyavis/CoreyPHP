# CoreyPHP Color Code Utility System Documentation

The **CoreyPHP Color Code Utility System** is a compact, single-character color mapping standard designed for building pixel art, rapid image layouts, and grid systems.

By mapping colors to individual letters and numbers, it compresses complex image data into human-readable strings (e.g., `'w'` for white, `'k'` for black).

## Evolution to Version 2 (36-Color Grid)

In its original iteration, this utility supported only 17 basic colors. To maximize layout efficiency and unlock full alphanumeric support, the CoreyPHP version has been expanded to a **36-color palette** utilizing all lowercase letters ('a-z') and numbers ('0-9').

> :pushpin: **Breaking Changes Notice:** During the upgrade to 36 colors, several original character mappings were shifted to new letters to allow for better grouping, a few legacy colors were removed, and numerous modern shades were introduced. Please review the lookup table below carefully if migrating from the legacy 17-color script.

## How the Color String System Works

Both `createJpg()` and `createPng()` within the `CoreyFile` class transform a flat string of single-character codes into a structured 2D grid based on the provided `$width` and `$height` parameters. The string maps sequentially from left-to-right, row-by-row, top-to-bottom.

### Layout Mechanics Visualized

If you pass a string of 9 characters (`'rwbwkrgby'`) to a 3 x 3 grid, the conversion tracks coordinates like a grid coordinate system:

| Coordinates | Visual Layout | Map Breakdown |
| :---: | :---: | :--- |
| `(0,0) (1,0) (2,0)` | `[ r ] [ w ] [ b ]` | **Row 1:** `r` (Red), `w` (White), `b` (Blue) |
| `(0,1) (1,1) (2,1)` | `[ w ] [ k ] [ r ]` | **Row 2:** `w` (White), `k` (Black), `r` (Red) |
| `(0,2) (1,2) (2,2)` | `[ g ] [ b ] [ y ]` | **Row 3:** `g` (Gray), `b` (Blue), `y` (Yellow) |

### Format Quirks & Exceptions

When constructing your layout strings, keep these method-specific format rules in mind:

1. **Unrecognized Fallback:** Any character that does not exist in the alphanumeric lookup table below will automatically fall back to solid **White** `[255, 255, 255]`.
2. **Short Strings (Padding):** If your string does not contain enough characters to fill the entire grid (`width` * `height`):
    - `createJpg()` will automatically pad the remaining unmapped pixels with solid **White**.
    - `createPng()` will leave the remaining unmapped pixels perfectly **Transparent**.
3. **Explicit Transparent Gaps:** Inside `createPng()`, you can introduce a space character (`' '`) inside your color string to deliberately skip a pixel, keeping it transparent while continuing your layout alignment.
4. **Single-Character Flood (`createJpg` only):** If you provide exactly *one* character to `createJpg()`, it acts as a shortcut to paint the entire canvas that single color, ignoring the grid math entirely.

## Color Code Lookup Table

| Code | Color Name | Hex Code | RGB Array | Notes / Status |
| --- | --- | --- | --- | --- |
| a | amber | #ffbf00 | [255, 191, 0] | New Addition |
| b | blue | #0000ff | [0, 0, 255] | Maintained from Legacy |
| c | peach | #ffdab9 | [255, 218, 185] | New Addition |
| d | emerald | #50c878 | [80, 200, 120] | New Addition |
| e | green | #008000 | [0, 128, 0] | Maintained from Legacy |
| f | forest green | #228b22 | [34, 139, 34] | New Addition |
| g | gray | #808080 | [128, 128, 128] | Maintained from Legacy |
| h | magenta | #ca1f7b | [202, 31, 123] | New Addition |
| i | violet | #ee82ee | [238, 130, 238] | New Addition |
| j | jade | #00a86b | [0, 168, 107] | New Addition |
| k | black | #000000 | [0, 0, 0] | Maintained from Legacy |
| l | lime | #00ff00 | [0, 255, 0] | Maintained from Legacy |
| m | maroon | #800000 | [128, 0, 0] | Maintained from Legacy |
| n | brown | #a52a2a | [165, 42, 42] | New Addition |
| o | orange | #ff8000 | [255, 128, 0] | Maintained from Legacy |
| p | pink | #ffc0cb | [255, 192, 203] | New Addition |
| q | turquoise | #40e0d0 | [64, 224, 208] | New Addition |
| r | red | #ff0000 | [255, 0, 0] | Maintained from Legacy |
| s | silver | #c0c0c0 | [192, 192, 192] | Maintained from Legacy |
| t | teal | #008080 | [0, 128, 128] | Maintained from Legacy |
| u | purple | #800080 | [128, 0, 128] | Relocated from 'p' |
| v | olive | #808000 | [128, 128, 0] | Maintained from Legacy |
| w | white | #ffffff | [255, 255, 255] | Maintained from Legacy |
| x | crimson | #dc143c | [220, 20, 60] | New Addition |
| y | yellow | #ffff00 | [255, 255, 0] | Maintained from Legacy |
| z | bronze | #b87333 | [184, 115, 51] | New Addition |
| 0 | plum | #dda0dd | [221, 160, 221] | New Addition |
| 1 | gold | #ffd700 | [255, 215, 0] | New Addition |
| 2 | navy | #000080 | [0, 0, 128] | Relocated from 'n' |
| 3 | coral | #ff7f50 | [255, 127, 80] | New Addition |
| 4 | indigo | #4b0082 | [75, 0, 130] | New Addition |
| 5 | beige | #f5f5dc | [245, 245, 220] | New Addition |
| 6 | sky blue | #87ceeb | [135, 206, 235] | New Addition |
| 7 | tan | #d2b48c | [210, 180, 140] | New Addition |
| 8 | mint | #98fb98 | [152, 251, 152] | New Addition |
| 9 | lavender | #e6e6fa | [230, 230, 250] | New Addition |

### Legacy Reference (Old Project)

| Code | Color Name | Hex Code | RGB Array | Notes / Status |
| --- | --- | --- | --- | --- |
| a | aqua | #00ffff | [0, 255, 255] | Deprecated / Removed |
| b | blue | #0000ff | [0, 0, 255] | Maintained |
| e | green | #008000 | [0, 128, 0] | Maintained |
| f | fuchsia | #ff00ff | [255, 0, 255] | Deprecated / Removed |
| g | gray | #808080 | [128, 128, 128] | Maintained |
| k | black | #000000 | [0, 0, 0] | Maintained |
| l | lime | #00ff00 | [0, 255, 0] | Maintained |
| m | maroon | #800000 | [128, 0, 0] | Maintained |
| n | navy | #000080 | [0, 0, 128] | Relocated to '2' |
| o | orange | #ff8000 | [255, 128, 0] | Maintained |
| p | purple | #800080 | [128, 0, 128] | Relocated to 'u' |
| r | red | #ff0000 | [255, 0, 0] | Maintained |
| s | silver | #c0c0c0 | [192, 192, 192] | Maintained |
| t | teal | #008080 | [0, 128, 128] | Maintained |
| v | olive | #808000 | [128, 128, 0] | Maintained |
| w | white | #ffffff | [255, 255, 255] | Maintained |
| y | yellow | #ffff00 | [255, 255, 0] | Maintained |

## Related Methods

[codeToColor](CoreyPHP/codeToColor.md) | [codeToHex](CoreyPHP/codeToHex.md) | [codeToRgb](CoreyPHP/codeToRgb.md) | [colorToCode](CoreyPHP/colorToCode.md) | [createJpg](CoreyFile/createJpg.md) | [createPng](CoreyFile/createPng.md)

---
[Home](Home.md) | CoreyPHP Color Code Utility System

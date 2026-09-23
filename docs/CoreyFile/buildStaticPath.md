# buildStaticPath *[Protected]*

Helper method that translates `.php` URLs and query string parameters into clean, nested static HTML relative directory paths.

## Usage

```
method(string $url, integer $depth = 0): string
```

## Parameters

**url** (string)
: The original internal URL string (e.g., `index.php?page=2`, `blog.php?year=2026`).

**depth** (integer)
: The current directory depth level used to prepend relative parent traversals (`../`). (*default*: `0`) *^(optional)^*

## Return Value

(string)
: Returns the transformed, static relative path ending in `.html` (with optional fragment hashes preserved).

> :pushpin: This method decodes HTML entities (`&amp;` -> `&`) and replaces special characters in query values with underscores (`_`).
>
> If the base file name is `index`, the folder prefix is omitted (`index.php?page=2` -> `page/2.html`). Non-index controllers use the script name as the root directory (`blog.php?year=2026` -> `blog/2026.html`).

## Examples

```
$file->buildStaticPath('blog.php?year=2026&month=07&post=CoreyPHP-Is-Great', 0);
// Result: blog/2026/07/CoreyPHP_Is_Great.html
```

### Output Examples

| Input `$url` [^1] | `$depth` [^2] | Output Static Path [^3] |
| --- | :---: | :---: |
| `index.php` | 0 | `index.html` |
| `index.php?page=2` | 0 | `page/2.html` |
| `blog.php?year=2026&month=07` | 0 | `blog/2026/07.html` |
| `blog.php?year=2026&month=07&post=Top-Reviews` | 0 | `blog/2026/07/Top_Reviews.html` |
| `index.php?category=music&instrument=piano` | 0 | `music/piano.html` |
| `index.php` | 2 | `../../index.html` |
| `contact.php?ref=test#form` | 1 | `../contact/test.html#form` |

[^1]: Example PHP URLs supplied to method.
[^2]: The URL depth if it applies.
[^3]: The static HTML URLs returned.

## Debug Errors

- No debug errors.

## Related Methods

[endCode](endCode.md) | [startCode](startCode.md) | [writeHtml](writeHtml.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Helpers](../CoreyFile.md#helpers)

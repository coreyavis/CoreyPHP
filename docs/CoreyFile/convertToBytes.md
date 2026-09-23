# convertToBytes

Converts a human-readable file size string (such as `2MB`, `1.5 GB`, or `512 KB`) into its raw integer equivalent in bytes. This is particularly useful for parsing `php.ini` configuration values like `memory_limit` or `upload_max_filesize`.

## Usage

```
convertToBytes(string $size): integer
```

## Parameters

**size** (string)
: The file size string to convert (e.g., `128M`, `5GB`, `2 KB`).

## Return Value

(integer)
: Returns the converted size in bytes as an integer.
: Returns `-1` if the input string is exactly `-1` (representing an unlimited configuration in PHP).

### Conversion

The method dynamically parses the string using a regular expression defined by `self::FILESIZEUNITS`. It safely handles optional spaces between the number and the unit, and matches units case-insensitively.

| Unit | Prefix/Matches (Case-Insensitive) | Mathematical Multiplier |
| --- | --- | --- |
| Kilobyte | K, KB | *Value* x 1024 |
| Megabyte | M, MB | *Value* x 1024^2^ |
| Gigabyte | G, GB | *Value* x 1024^3^ |
| Terabyte | T, TB | *Value* x 1024^4^ |
| Petabyte | P, PB | *Value* x 1024^5^ |

## Examples

```
$file->convertToBytes('2G') = 2147483648 
$file->convertToBytes('512 KB') = 524288 
```

## Debug Errors

- No debug errors.

## Related Methods

[filesizeConvert](filesizeConvert.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Conversion](../CoreyFile.md#conversion)

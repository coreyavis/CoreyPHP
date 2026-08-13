# filesizeConvert

Converts a raw integer of bytes into a human-readable string formatted with the appropriate binary data unit (e.g., KB, MB, GB).

## Usage

```
filesizeConvert(int|float $bytes = 0): string
```

## Parameters

**bytes** (integer|float)
: The raw file size in bytes to be converted. (*default*: `0`)

## Return Value

Returns the formatted file size string rounded to two decimal places (where applicable), appended with the correct unit.

### Conversion

The method automatically evaluates the `$bytes` value against the following binary scale thresholds (2^10^ integer steps):

| Byte Range | Output Format | Example Input | Example Output |
| --- | --- | --- | --- |
| &ge; 1,125,899,906,842,624 | X.XX PB (Petabytes) | 1125899906842624 | 1.00 PB |
| &ge; 1,099,511,627,776 | X.XX TB (Terabytes) | 2500000000000 | 2.27 TB |
| &ge; 1,073,741,824 | X.XX GB (Gigabytes) | 1073741824 | 1.00 GB |
| &ge; 1,048,576 | X.XX MB (Megabytes) | 5420000 | 5.17 MB |
| &ge; 1,024 | X.XX KB (Kilobytes) | 2048 | 2.00 KB |
| > 1 and < 1024 | X bytes | 42 | 42 bytes |
| == 1 | 1 byte | 1 | 1 byte |
| &le; 0 | 0 bytes | 0 | 0 bytes |

## Examples

```
$file->filesizeConvert(512) = 512 bytes
$file->filesizeConvert(1542000) = 1.47 MB
```

## Debug Errors

- No debug errors.

## Related Methods

[convertToBytes](convertToBytes.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Conversion](../CoreyFile.md#conversion)

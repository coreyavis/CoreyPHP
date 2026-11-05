# resolveRelativePath *[Private]*

Resolves and cleans relative path strings containing parent directory traversals (`../`) and current directory indicators (`./`) into a normalized, canonical relative path

:pushpin: This method is private and used internally to handle relative asset path calculations across nested directories.

## Usage

```
resolveRelativePath(string $path): string
```

## Parameters

**path** (string)
: The raw relative path string containing traversals (e.g., assets/css/../images/logo.png)

## Return Value

(string)
: Returns the normalized relative path string.

## Debug Errors

- No debug errors.

## Related Methods

[processLocalAssets](processLocalAssets.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Helpers](../CoreyFile.md#helpers)

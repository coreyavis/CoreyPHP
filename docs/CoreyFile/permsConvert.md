# permsConvert

Converts a decimal file permission integer (such as those returned by `DirectoryIterator::getPerms()`) into a standard 4-digit octal permission string.

## Usage

```
permsConvert(int $perms = 0): string
```

## Parameters

**perms** (integer)
: The raw decimal permission integer to convert. (*default*: `0`)

## Return Value

(string)
: Returns a 4-digit octal permission string (e.g., `"0644"`, `"0755"`). If `0` is passed, it returns `"0"`

> :pushpin: Filesystem functions and classes like `DirectoryIterator` return file permissions as a combined decimal bitmask containing both the file type and the permissions. This method isolates and converts those permissions into the standard human-readable octal format.

## Examples

```
$file->permsConvert(33188) = 0644
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Conversion](../CoreyFile.md#conversion)

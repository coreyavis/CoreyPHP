# removeFile

Removed a specified file from the filesystem. This method includes built-in security checks to prevent Directory Traversal attacks by ensuring the target file resides strictly within the designated trusted root directory.

> :pushpin: This method safely mitigates `../` path traversal exploits by utilizing `realpath()`. However, ensure that `$this->path` is properly sanitized and initialized before invoking this method.

## Usage

```
removeFile(string $filename): bool
```

## Parameters

**filename** (string)
: The name or path of the file to be removed. Can be an absolute path or relative to the configured base path.

## Return Value

(bool)
: Returns `true` on success and `false` on failure.

## Examples

```
$file->removeFile('file.txt');
```

## Debug Errors

- Throws an exception if file does not exists or access is restricted.
- Throws an exception if target is a directory, not a file.
- Throws an exception if permission is denied.

## Related Methods

[copyFile](copyFile.md) | [renameFile](renameFile.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)

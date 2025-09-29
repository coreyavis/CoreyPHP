# renameFile

Renames an existing file within the configured base directory path. It validates path permissions, sanitizes the new file name, preserves the original file extension, and prevents overwriting existing files.

> :pushpin: This method safely mitigates `../` path traversal exploits on the source file by expanding relative paths with `realpath()` and enforcing a boundary check against `$this->path`. Ensure that `$this->path` is properly initialized and points to a valid directory before invoking this method.

## Usage

```
renameFile(string $filename, string $name): bool
```

## Parameters

**filename** (string)
: The name or relative path of the existing target file to rename. Must exist within the configured directory.

**name** (string)
: The new name for the file. Path components, leading dots, and illegal characters are automatically sanitized, while the original file extension is preserved.

## Return Value

Returns `true` if the file was successfully renamed, or `false` on failure.

## Examples

```
$file->renameFile('oldnote.txt', 'newnote.txt');
```

## Debug Errors

- Throws an exception if file does not exists or access is restricted.
- Throws an exception if target is a directory, not a file.
- Throws an exception if permission is denied.
- Throws an exception if the new name is empty or contains only invalid characters.
- Throws an exception if a file with the new target name already exists.

## Related Methods

[removeFile](removeFile.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)

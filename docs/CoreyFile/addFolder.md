# addFolder

Creates a new folder or nested folder hierarchy at the specified path if it does not already exist.

## Usage

```
addFolder(string $folder): bool
```

## Parameters

**folder** (string)
: The name, relative path, or nested directory structure to create (e.g., `images` or `uploads/images`).

## Return Value

(bool)
: Returns `true` if the folder exists or was successfully created, and `false` if directory creation failed. 

## Examples

```
// Create a single directory
$file->addFolder('images');

// Recursively create nested directorie in one call
$file->addFolder('uploads/images');
```

## Debug Errors

- No debug errors.

## Related Methods

[removeFolder](removeFolder.md) | [renameFolder](renameFolder.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)

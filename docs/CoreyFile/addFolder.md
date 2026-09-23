# addFolder

Creates a new folder at the specified path if it does not already exist.

## Usage

```
addFolder(string $folder): bool
```

## Parameters

**folder** (string)
: The name or relative path of the folder to create.

## Return Value

(bool)
: Returns `true` on success and `false` if the folder already exists or could not be created. 

## Examples

```
$file->addFolder('images');
```

## Debug Errors

- No debug errors.

## Related Methods

[removeFolder](removeFolder.md) | [renameFolder](renameFolder.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)

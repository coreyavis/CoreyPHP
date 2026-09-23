# removeFolder

Removes an existing folder. To prevent accidental data loss, this method will only remove the folder if it is completely empty.

## Usage

```
removeFolder(string $folder): bool
```

## Parameters

**folder** (string)
: The name, relative path, or absolute path of the folder to delete.

## Return Value

(bool)
: Returns `true` on success and `false` if the folder doesn't exist, or if it contains files/subfolders.

## Examples

```
$file->removeFolder('images')
```

## Debug Errors

- Triggers a warning if the folder is not empty.

## Related Methods

[addFolder](addFolder.md) | [renameFolder](renameFolder.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)
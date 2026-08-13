# renameFolder

Renames an existing folder relative to the base working path or via an absolute path.

## Usage

```
renameFolder(string $folder, string $newFolder): bool
```

## Parameters

**folder** (string)
: The current folder name (relative to `$this->path`) or an absolute path.

**newFolder** (string)
: The new folder name or destination path.

## Return Value

Returns `true` on success, or `false` on failure (e.g., source does not exist, target already exists, or permission denied).

## Examples

```
$file->renameFolder('images', 'pictures');
$file->renameFolder('/var/www/uploads/images', 'pictures');
```

## Debug Errors

- Triggers a warning if the folder does not exist.
- Triggers a warning if the new folder already exists.

## Related Methods

[addFolder](addFolder.md) | [removeFolder](removeFolder.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)
# setOutputPath

Sets a dedicated target directory for methods that generate files (such as `writeHtml`, `writeText`, `createJpg`, `createPng`, and `endCode`). If an absolute or relative output path cannot be resolved directly, the method dynamically searches the current directory context - checking both parent paths and immediate child folders - to resolve the absolute path.

> :pushpin: The `outputPath` property is used strictly for output file generation. If `setOutputPath()` is not called or fails to resolve, the output path remains undefined, and file generation methods automatically fall back to the primary `path` property. Furthermore, `setOutputPath()` will not create non-existant directories; the target directory must exist on disk prior to being set.

## Usage

```
setOutputPath(string $path): bool
```

## Parameters

**path** (string)
: The directory path or partial folder name to resolve and set as the output destination.

## Return Value

Returns `true` if a valid absolute directory path was successfully resolved and set; otherwise, returns `false`.

### Path Resolution Flow

When a string is supplied to `setOutputPath`, it evaluates the target directory using a three-tiered fallback strategy:

1. Direct Resolution: It first tests if the input string is already a valid absolute path or relative path via PHP's `realpath()`.
2. Upward Matching (`getParents`): If direct resolution fails, it scans up the parent directory chain to see if an ancestor path matches the partial target (e.g., jumping back up to a previous folder).
3. Downward Matching (`getFolders`): If parent matching fails, it scans the immediate child folders of the current directory to see if any child folder matches the partial target name.

## Examples

1. Standard Absolute Output Path Placement

If you provide a complete, existing absolute path, it normalizes the slashes and updates the output destination.

```
$file->setOutputPath('/var/www/project');
// Output Path becomes: /var/www/project/ 
```

2. Resolving via Parent History (Upward)

If you pass a partial folder name that exists higher up in the current directory's parent tree, `getParents()` intercepts it and resolves the full path.

```
$file->setOutputPath('www');
// Output Path becomes: /var/www/
```

3. Resolving via Child Folders (Downward)

If you pass a partial folder name that exists lower down in the current directory's child tree, `getFolders()` intercepts it and resolves the full path.

```
$file->setOutputPath('src');
// Output Path becomes: /var/www/project/src/
```

## Debug Errors

- Triggers a warning if the path is invalid or does not exist on disk.

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Environment](../CoreyFile.md#environment)

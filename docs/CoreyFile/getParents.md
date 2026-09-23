# getParents

Retrieves an array of all the parent directories for a given path, traversing upwards until it hits the root directory.

## Usage

```
getParents(?string $path = null, bool $base = false): array
```

## Parameters

**path** (string)
: The file path to parse. If `null` or empty, it defaults to the instance's `$this->path`. (*default*: `'$this->path'`) *^(optional)^*

**base** (bool)
: If set to `true`, returns only the trailing folder names (e.g., `www`). If set to `false`, returns the absolute directory paths. (*default*: `false`) *^(optional)^*

## Return Value

(array)
: Returns a list of parent directories as an array, ordered from deepest child directory up to the root drive.

## Examples

1. Fetch Full Absolute Paths (Default)

By default, the method replaces all system backslashes with your preferred separator and appends a trailing separator.

```
$parents = $file->getParents(null, false);
// Result:
Array
(
    [0] => '/var/www/project/src/',
    [1] => '/var/www/project/',
    [2] => '/var/www/',
    [3] => '/var/'
)
```

2. Fetch Directory Names Only (`$base = true`)

Perfect for breadcrumbs or simple tree evaluations. It isolates the directory name and preserves the root drive at the end.

```
$parents = $file->getParents(null, true);
// Result:
Array
(
    [0] => '/src/',
    [1] => '/project/',
    [2] => '/www/',
    [3] => '/var/'
)
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Environment](../CoreyFile.md#environment)

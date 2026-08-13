# getDirectory

Retrieves the contents of a specified directory, separating folders and files. It can optionally return detailed metadata arrays for each item, including file sizes, timestamps, and permissions.

> :pushpin: This method normalizes file paths into standardized URLs (`file://`) using a configured directory separator. It automatically filters out dot directories (`.` and `..`) as well as symlinks.

## Usage

```
getDirectory(?string $directory = null, bool $details = false, bool $perms = false): array|bool
```

## Parameters

**directory** (string)
: The directory path to scan. If `null`, defaults to the directory where the script initially ran. *^(optional)^*

> If no `$directory` argument is supplied, the method automatically targets `$this->path`, running the scan on the initialization directory where the script first executed.

**details** (bool)
: If set to `true`, returns a multidimensional array containing detailed metadata for each file/folder. If set to `false`, returns a flat array of names. (*default*: `false`) *^(optional)^*

**perms** (bool)
: If set to `true` (and `$details` is `true`), includes converted octal permission string in the metadata. (*default*: `false`) *^(optional)^*

## Return Value

Returns a merged array containing all found folders first, followed by all files.

Returns `false` if the directory does not exist or cannot be parsed by either the main iterator or the fallback handler.

### Public Properties

Upon a successful scan, this method automatically updates the following public properties on the object:

- **`$files`** (int) - The total number of files discovered. Defaults to `0` if the scan fails.
- **`$folders`** (int) - The total number of folders discovered. Defaults to `0` if the scan fails.

## Examples

1. Basic Structure (`$details = false`)

Returns a simple list of names. Folders include the trailing directory separartor.

```
$file->getDirectory($directory)
// Result: 
[
    'src/',
    'tests/',
    'README.md',
    'composer.json'
]
```

2. Detailed Structure (`$details = true`, `$perms = true`)

Returns descriptive associative arrays grouped by folders first, then files.

```
$file->getDirectory($directory, true, true)
// Result:
[
    // Folders
    [
        'folder'    => 'src/'
        'type'      => 'folder'
        'path'      => '/var/www/project/src/'
        'created'   => 'MM/DD/YYYY MM:SS AM|PM'
        'modified'  => 'MM/DD/YYYY MM:SS AM|PM'
        'accessed'  => 'MM/DD/YYYY MM:SS AM|PM'
        'perms'     => '0755'
    ],
    // Files
    [
        'file'      => 'README.md'
        'type'      => 'file'
        'path'      => '/var/www/project/README.md'
        'ext'       => 'md'
        'size'      => '4.2 KB'
        'created'   => 'MM/DD/YYYY MM:SS AM|PM'
        'modified'  => 'MM/DD/YYYY MM:SS AM|PM'
        'accessed'  => 'MM/DD/YYYY MM:SS AM|PM'
        'perms'     => '0644'
    ]
]
```

## Debug Errors

- Triggers a warning if the target directory does not exist or if the fallback reader fails to open the stream.

## Related Methods

[getFiles](getFiles.md) | [getFolders](getFolders.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Environment](../CoreyFile.md#environment)

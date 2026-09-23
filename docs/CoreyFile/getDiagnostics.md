# getDiagnostics

Gathers a comprehensive, hierarchical overview of the server environment, memory usage metrics, PHP configuration options (`php.ini`), and script execution timeouts.

## Usage

```
getDiagnostics(): array
```

## Parameters

- Takes no arguments.

## Return Value

(array)
: Returns an array with the following environmental data:

| Category | Key | Type | Retrieval Method | Source Query / Internal Property |
| --- | --- | --- | --- | --- |
| Environment | disk_free_space | string | On-Demand (System) | disk_free_space($path) *^(formatted)^* |
| Environment | disk_total_space | string | On-Demand (System) | disk_total_space($path) *^(formatted)^* |
| Environment | operating_system | string | Predefined Constant | PHP_OS |
| Environment | php_version | string | Predefined Constant | PHP_VERSION |
| Environment | temp_directory | string | On-Demand (System) | sys_get_temp_dir() |
| Environment | temp_directory_writable | boolean | On-Demand (System) | is_writable($tempDir) |
| Memory | limit | string | Configuration | ini_get('memory_limit') |
| Memory | memory_current | string | On-Demand (System) | memory_get_usage(true) *^(formatted)^* |
| Memory | memory_peak_usage | string | On-Demand (System) | memory_get_peak_usage(true) *^(formatted)^* |
| PHP INI | file_uploads | boolean | Configuration | ini_get('file_uploads') |
| PHP INI | max_file_uploads | integer | Configuration | ini_get('max_file_uploads') |
| PHP INI | post_max_size | string | Configuration | ini_get('post_max_size') |
| PHP INI | upload_max_filesize | string | Configuration | ini_get('upload_max_filesize') |
| Timeouts | max_execution_time | string | Configuration | ini_get('max_execution_time') |
| Timeouts | max_input_time | string | Configuration | ini_get('max_input_time') |

> :pushpin: The `disk_free_space` and `disk_total_space` parameters prioritize checking the internal `$this->path` property. If the path is unreadable, the method gracefully falls back to checking the current directory (`__DIR__`). Human-readable memory sizes are parsed using the `$this->filesizeConvert()` method.

## Examples

```
$file->getDiagnostics();
```

## Debug Errors

- No debug errors.

## Related Methods

[getFileMetadata](getFileMetadata.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Environment](../CoreyFile.md#environment)

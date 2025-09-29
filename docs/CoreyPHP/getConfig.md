# getConfig

This method retrieves the configuration value or values for the current class instance.

## Usage

```
getConfig(string $key): mixed
getConfig(null): array
```

## Parameters

**key**
: The key of the config option to return. (optional)

## Return Value

Returns the value of a specific key if a parameter exists, or all config options as an array if no parameter is provided.

Returns `false` if config key doesn't exist.

## Example

```
$value = $cphp->getConfig('key');
$config = $cphp->getConfig();
```

### Output Examples

| Parameter [^1] | Output |
| --- | :---: |
| null | ['key' => 'string', 'integer' => 1] |
| key | string |
| integer | 1 |

[^1]: These parameters are examples, but may not be actual configuaration keys.

## Debug Errors

- Logs a warning if the configuration key does not exist.

---
[Home](../Home.md) | [Configuration](../Config.md)

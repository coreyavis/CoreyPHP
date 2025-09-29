# setConfig

This method modifies the default configuration values for the current class instance.

## Usage

```
setConfig(string $key, mixed $value): bool
setConfig(array $key): bool
```

## Parameters

**key**
: Configuration key in *key/value* pair or an array containing all configuration options to modify.

**value**
: Configuration value in *key/value* pair. If using array in \'key\' parameter then value will be ignored. (**optional**)

## Return Value

Returns `true` on success and `false` if config key doesn't exist.

## Examples

```
$cphp->setConfig('key', 'value');
$cphp->setConfig(['key' => 'string', 'integer' => 1]);
```

## Debug Errors

- Logs a warning if the config key is empty.
- Logs a warning if the config value is empty; only when using key/value pair.
- Logs a warning if the configuration key does not exist.

---
[Home](../Home.md) | [Configuration](../Config.md)

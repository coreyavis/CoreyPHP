# getAlgorithm

Retrieves the active hashing algorithm by validating the object's configured properties, falling back to global configuration settings, or defaulting to a hardcoded safe fallback.

## Usage

```
getAlgorithm(): string
```

## Parameters

- Takes no arguments.

## Return Value

(string)
: Returns a `string` representing the validated hashing algorithm name (e.g., `sha256`, `md5`).

> :pushpin: The method determines which algorithm to return using a 3-step fallback chain:
>
> 1. Instance Property (`$this->algo`): Checks if an algorithm is explicitly set on the object instance and verifies its availability.
>
> 2. Global Configuration (`getConfig('algorithm')`): If the instance property is invalid or not set, it attempts to load the default algorithm from the configuration and validates it.
>
> 3. Hardcoded Fallback (`'sha256'`): If both of the above checks fail or are invalid, it defaults to returning `'sha256'`.

## Examples

```
$sec->getAlgorithm() = 'sha256'
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| algorithm | sha256 | *string* (See: ) | Default hashing algorithm. |

## Debug Errors

- No debug errors.

## Related Methods

[algorithmExists](algorithmExists.md) | [listAlgorithms](listAlgorithms.md) | [setAlgorithm](setAlgorithm.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Structure](../CoreySecurity.md#structure)

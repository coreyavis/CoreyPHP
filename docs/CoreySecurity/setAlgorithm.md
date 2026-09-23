# setAlgorithm

Sets the active hashing algorithm for the class. This method features automatic case-normalization and a multi-tiered fallback system to guarantee the class never enters an invalid state.

## Usage

```
setAlgorithm(string $algo): static
```

## Parameters

**algo** (string)
: The name of the hashing algorithm to set (e.g., `'sha256'`, `'sha512'`, `'whirlpool'`). Case-insensitive.

> :pushpin: If the requested algorithm does not exist on the host system then it attempts to fall back to the default algorithm defined in your configuration.
>
> If the configuration is missing or contains an invalid algorithm, it safely defaults to `sha256` as an absolute system fallback.

## Return Value

(static)
: Returns the current instance to allow for method chaining.

## Examples

```
$sec->setAlgorithm('md5');
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| algorithm | sha256 | *string* (See: ) | Default hashing algorithm. |

## Debug Errors

- No debug errors.

## Related Methods

[algorithmExists](algorithmExists.md) | [getAlgorithm](getAlgorithm.md) | [listAlgorithms](listAlgorithms.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Structure](../CoreySecurity.md#structure)

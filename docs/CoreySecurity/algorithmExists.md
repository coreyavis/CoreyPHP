# algorithmExists *[Private]*

A internal inspector method that queries the sytem's available hashing algorithms to verify if a specific algorithm is supported by the current PHP environment.

## Usage

```
algorithmExists(string $algo): bool
```

## Parameters

**algo** (string)
: The algorithm name to verify. Must be lowercase to match PHP's native `hash_algos()` registry.

## Return Value

(bool)
: Returns `true` if the algorithm is supported and available on the server; otherwise returns `false`.

## Examples

```
$sec->algorithmExists('md5') = true 
```

## Debug Errors

- No debug errors.

## Related Methods

[getAlgorithm](getAlgorithm.md) | [listAlgorithms](listAlgorithms.md) | [setAlgorithm](setAlgorithm.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Inspectors](../CoreySecurity.md#inspectors)

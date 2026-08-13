# listAlgorithms

Retrieves an array of registered hashing algorithms. To optimize performance, it caches the results in the `$this->algorithms` variable after the first retrieval. Subsequent calls read from this variable instead of querying the server, unless a refresh is forced.

## Usage

```
listAlgorithms(bool $refresh = false): array
```

## Parameters

**refresh** (bool)
: If set to `true`, bypasses the cached `$this->algorithms` variable and forces a fresh query of the server. (*default*: `false`) *^(optional)^*

## Return Value

Returns an array of algorithm names on success, or an empty array otherwise.

## Examples

```
$algos = $sec->listAlgorithms();
```

## Debug Errors

- No debug errors.

## Related Methods

[algorithmExists](algorithmExists.md) | [getAlgorithm](getAlgorithm.md) | [setAlgorithm](setAlgorithm.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Structure](../CoreySecurity.md#structure)

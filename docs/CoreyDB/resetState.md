# resetState *[Protected]*

Resets all internal query builder variables and state tracking to their default values. This ensures that subsequent SQL statements executed by the same class instance are built from a clean slate, preventing data bleed between queries.

> This method is typically called automatically at the end of a query execution lifecycle.

## Usage

```
resetState(): bool
```

## Parameters

- Takes no arguments.

## Return Value

Returns `true` upon successful reset.

## Examples

```
$db->resetState()
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Helpers](../CoreyDB.md#helpers)

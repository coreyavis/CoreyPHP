# checkConnection *[Private]*

Verifies whether a valid database connection exists and is an active instance of `mysqli`.

## Usage

```
checkConnection(): bool
```

## Parameters

- Takes no arguments.

## Return Value

Returns `true` on success and `false` on failure.

## Examples

```
$db->checkConnection() = true|false
```

## Debug Errors

- Throws an exception if no database connection has been established.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Internal Environment](../CoreyDB.md#internal-environment)

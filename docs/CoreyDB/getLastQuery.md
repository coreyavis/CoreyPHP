# getLastQuery

Retrives the last SQL query that was generated.

## Usage

```
getLastQuery(): string|null
```

## Parameters

- Takes no arguments.

## Return Value

(string|null)
: Returns the last SQL query or `null` if no query to return.

## Examples

```
$db->getLastQuery();
// Result: SELECT * FROM `users` WHERE `user` = 'name'
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Structure](../CoreyDB.md#structure)

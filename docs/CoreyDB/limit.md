# limit

Applies a limit and an optional offset to a `SELECT`, `UPDATE`, or `DELETE` query. This method restricts the number of rows affected or returned by the statement.

> :pushpin: This method is ideal for implementing data pagination. By dynamically calculating the `$offset` based on the current page number, you can easily slice your database results into manageable chunks. You can also handle offsets separately using the [offset](offset.md) method.

## Usage

```
limit(int $limit = 0, int $offset = 0): static
```

## Parameters

**limit** (integer)
: The maximum number of rows to return or affect. Must be a positive integer.

**offset** (interger)
: The number of rows to skip before starting to return rows. (Only applicable to `SELECT` statements.) *^(optional)^*

> If the offset number is a negative number than it will be ignored.

## Return Value

Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->limit(10)->execute();
// Result: SELECT * FROM `table` LIMIT 10

$db->select()->limit(10, 20)->execute();
// Result: SELECT * FROM `table` LIMIT 10 OFFSET 20
```

## Debug Errors

- Logs a notice if limit is not a positive integer.
- Triggers a warning if trying to use `OFFSET` on an `UPDATE` or `DELETE` statement.
- Throws an exception if `limit()` is used without an explicit `order()` clause.

## Related Methods

[offset](offset.md) | [compileLimit](compileLimit.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)

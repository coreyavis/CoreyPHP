# offset

Applies a standalone offset to a `SELECT` query. This method specifies the number of rows to skip before starting to return data.

> While you can provide an offset directly within the `limit()` method, using `offset()` allows you to decouple limit and offset logic dynamically in your application.
> 
> :pushpin: Note that an offset **requires** a limit to be set on the query to compile successfully.

## Usage

```
offset(int $offset = 0): static
```

## Parameters

**offset** (interger)
: The number of rows to skip before starting to return rows. Must be a positive integer.

> If the offset number is a negative number than it will be ignored.

## Return Value

(static)
: Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->order('id')->limit(10)->offset(20)->execute();
// Result: SELECT * FROM `table` ORDER BY `id` LIMIT 10 OFFSET 20
```

## Debug Errors

- Logs a notice if offset is not a positive integer.
- Logs a notice if an offset is defined without a corresponding `limit()`.
- Triggers a warning if applied to an `UPDATE` or `DELETE` statement during compilation.
- Throws an exception if `limit()` is used without an explicit `order()` clause.

## Related Methods

[limit](limit.md) | [compileLimit](compileLimit.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)

# in

The `in` method simplifies the process of filtering records against multiple possible values instead of chaining multiple `OR` conditions. It is designed to be chained directly after the `where` method. If the method is passed a single argument than the query will be converted.

> NOTE: If the `in` method is used before the `where` method than the `in` method will be ignored.

## Usage

```
in(array|string|int|float ...$args): static
```

## Parameters

**args** (array|string|int|float)
: A list or array of values to include in the `IN` statement.

> If `args` has only one value than the query will be converted to a standard `WHERE` equality condition.

## Return Value

(static)
: Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->where('color')->in('yellow', 'red', 'blue')->execute();
// Result: SELECT * FROM `table` WHERE `color` IN ('yellow', 'red', 'blue')

$db->select()->where('color')->in(['yellow', 'red', 'blue'])->execute();
// Result: SELECT * FROM `table` WHERE `color` IN ('yellow', 'red', 'blue')

$db->select()->where('color')->in('yellow')->execute();
// Result: SELECT * FROM `table` WHERE `color` = 'yellow'
```

## Debug Errors

- Logs a notice is query is modified.
- Logs a notice if method is ignored.

## Related Methods

[notIn](notIn.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)

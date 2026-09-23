# notIn

The `notIn` method simplifies the process of excluding records that match multiple possible values instead of chaining multiple `AND` conditions. It is designed to be chained directly after the `where` method. If the method is passed a single argument than the query will be converted.

> NOTE: If the `notIn` method is used before the `where` method than the `notIn` method will be ignored.

## Usage

```
notIn(array|string|int|float ...$args): static
```

## Parameters

**args** (array|string|int|float)
: A list or array of values to include in the `NOT IN` statement.

> If `args` has only one value than the query will be converted to a standard `WHERE` inequality condition.

## Return Value

(static)
: Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->where('color')->notIn('yellow', 'red', 'blue')->execute();
// Result: SELECT * FROM `table` WHERE `color` NOT IN ('yellow', 'red', 'blue')

$db->select()->where('color')->notIn(['yellow', 'red', 'blue'])->execute();
// Result: SELECT * FROM `table` WHERE `color` NOT IN ('yellow', 'red', 'blue')

$db->select()->where('color')->notIn('yellow')->execute();
// Result: SELECT * FROM `table` WHERE `color` <> 'yellow'
```

## Debug Errors

- Logs a notice is query is modified.
- Logs a notice if method is ignored.

## Related Methods

[in](in.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)

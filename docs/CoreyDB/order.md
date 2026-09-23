# order

Specifies the columns/keys to be used in the `ORDER BY` clause of the SQL query. It accepts either a list of string arguments or a single array of keys.

> :pushpin: By default, columns passed to `order()` are sorted in the database's default direction (usually ascending). To explicitly change or set the direction of specific columns, chain this method with the [asc](asc.md) or [desc](desc.md) modifier methods. Note that this modifier relationship does not apply to [orderByValue](orderByValue.md).

## Usage

```
order(array|string ...$columns): static
```

## Parameters

**columns** (array|string)
: A list of column names or an array containing column names to sort the query by.

## Return Value

(static)
: Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->order('id')->execute();
// Result: SELECT * FROM `table` ORDER BY `id`

$db->select()->order('name', 'qty')->execute();
// Result: SELECT * FROM `table` ORDER BY `name`, `qty`

$db->select()->order('name', 'qty')->desc('qty')->execute();
// Result: SELECT * FROM `table` ORDER BY `name`, `qty` DESC
```

## Debug Errors

- No debug errors.

## Related Methods

[orderByValue](orderByValue.md) | [asc](asc.md) | [desc](desc.md) | [compileOrder](compileOrder.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)

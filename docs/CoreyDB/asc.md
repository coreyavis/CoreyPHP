# asc

Appends the `ASC` (ascending) modifier to the specified key. If a key passed to this method already exists in the query order queue (via a previous `order()` call), it applies the `ASC` modifier to it. If the key does not exist, it creates it with the `ASC` modifier.

> :pushpin: In Mysql, queries sort in ascending order by default. Using the `asc()` method is not strictly required by the database engine, but it is recommended as a matter of preference to explicitly state your intent, maintain symmetry when mixing with `desc()`, and improve query readability.
>
> This modifier only applies to standard columns managed by `order()`. It has no effect on priority rules created via [orderByValue](orderByValue.md).

## Usage

```
asc(array|string ...$columns): static
```

## Parameters

**columns** (array|string)
: A list of column names or an array containing column names to sort the query by in ascending order. Existing keys will be modified to `ASC`; new keys will be created with the `ASC` modifier.

## Return Value

(static)
: Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->order('id')->asc('id')->execute();
// Result: SELECT * FROM `table` ORDER BY `id` ASC

$db->select()->asc('qty')->execute();
// Result: SELECT * FROM `table` ORDER BY `qty` ASC

$db->select()->order('name', 'qty')->asc('name')->execute();
// Result: SELECT * FROM `table` ORDER BY `name` ASC, `qty`

$db->select()->order('name')->asc('qty')->execute();
// Result: SELECT * FROM `table` ORDER BY `name`, `qty` ASC
```

## Debug Errors

- No debug errors.

## Related Methods

[order](order.md) | [orderByValue](orderByValue.md) | [desc](desc.md) | [compileOrder](compileOrder.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)

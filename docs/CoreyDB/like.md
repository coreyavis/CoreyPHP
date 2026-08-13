# like

Adds a `LIKE` clause to the current query. This method is used for pattern matching within a `WHERE` statement, wrapping the term in `%` wildcards to find specified patterns in a column, determining if the search is a partial, prefix, or suffix match.

## Usage

```
like(string $term, string $op = '%'): static
```

## Parameters

**term** (string)
: The search term to search for.

**op** (string)
: The search operator. (*default*: `'%'`) *^(optional)^*

| Operator | Description |
| --- | --- |
| % | Search ('%search%') |
| =% | Starts with ('search%') |
| %= | Ends with ('%search') |

## Return Value

Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->where('user')->like('name')->execute();
// Result: SELECT * FROM `table` WHERE `user` LIKE '%name%'

$db->select()->where('user')->like('name', '%=')->execute();
// Result: SELECT * FROM `table` WHERE `user` LIKE '%name'

$db->select()->where('user')->like('name', '=%')->execute();
// Result: SELECT * FROM `table` WHERE `user` LIKE 'name%'
```

## Debug Errors

- Logs a notice if method is ignored.

## Related Methods

[searchStr](searchStr.md) | [where](where.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)

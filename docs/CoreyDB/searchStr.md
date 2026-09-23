# searchStr *[Protected]*

A manual formatting helper that applies the necessary wildcards to a search term.

## Usage

```
searchStr(string $str, string $op = '%'): string
```

## Parameters

**str** (string)
: The string to format.

**op** (string)
: The search operator. (*default*: `'%'`) *^(optional)^*

| Operator | Description |
| --- | --- |
| % | Search ('%search%') |
| =% | Starts with ('search%') |
| %= | Ends with ('%search') |

## Return Value

(string)
: Returns the formatted search string.

## Examples

```
$db->searchStr('term') = %term%
$db->searchStr('term', '=%') = term%
$db->searchStr('term', '%=') = %term
```

## Debug Errors

- No debug errors.

## Related Methods

[sqlEscape](sqlEscape.md) | [sqlWrap](sqlWrap.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Helpers](../CoreyDB.md#helpers)

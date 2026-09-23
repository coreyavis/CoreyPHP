# sqlWrap

A manual formatting utility that applies the necessary SQL delimiters to a string based on the provided type. It ensures consistent syntax by wrapping identifiers (keys) in backticks or data (values/searches) in single quotes, acting as the final formatting stage before a variable is placed into a query string.

## Usage

```
sqlWrap(?string $wrap = null, string $type = 'key', string $op = %): ?string
```

## Parameters

**wrap** (?string)
: The string to wrap.

**type** (string)
: The wrap type. (*default*: 'key')

| Type | Description |
| --- | --- |
| key | Wrap as key. (\`key\`) |
| search | Wrap as search term with wildcards. ('%search%') |
| var or variable | Wrap as variable. ('value') |

**op** (string)
: The search operator for search type. (*default*: '%') *^(optional)^*

| Operator | Description |
| --- | --- |
| % | Search ('%search%') |
| =% | Starts with ('search%') |
| %= | Ends with ('%search') |

## Return Value

(?string)
: Returns the wrapped string.

## Examples

```
$db->sqlWrap('key') = `key`
$db->sqlWrap('term', 'search') = '%term%'
$db->sqlWrap('term', 'search', '=%') = 'term%'
```

## Debug Errors

- No debug errors.

## Related Methods

[sqlEscape](sqlEscape.md) | [searchStr](searchStr.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Utilities](../CoreyDB.md#utilities)

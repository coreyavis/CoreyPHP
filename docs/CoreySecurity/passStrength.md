# passStrength

Evaluates the overall security strength of a password by performing a comprehensive heuristic analysis. It calculates additive points for complexity factors, applies targeted deductions for predictable patterns, enforces dynamic threshold overrides for severe vulnerabilities, and returns a detailed audit report via an optional reference variable.

> :pushpin: Matrix Analysis + Behavioral Safeguards: Unlike pure entropy estimators, `passStrength()` accounts for real-world human behavior. It normalizes leet-speak substitutions against a word blacklist and enforces stair-step caps for sequential character runs, ensuring predictable passwords never pass with a falsely high score.

## Usage

```
passStrength(string $pw, ?array &$data = []): string
```

## Parameters

**pw** (string)
: The raw password string to evaluate.

**data** (array|null)
: If data is populated, the variable captures a detailed multi-dimensional audit array containing broken-down scores, metrics, test results, and total additions/deductions. (*default*: `[]`) *^(optional)^*

## Return Value

Returns the password security strength as percentage between `0%` to `100%`.

### Scoring System & Rules

The evaluation engine calculates a raw score using additions and deductions before applying forced caps:

<p style="padding-left: 25px; font-size: 24px;">Raw Score = Additions - Deductions</p>

The raw score is clamped between `0` and `100` before evaluating forced threshold overrides.

1. Additions

Points are rewarded based on positive complexity attributes:

| Test Factor | Addition Logic |
| --- | --- |
| Length | +(Length x 4) |
| Lowercase Letters | +(Count x 2) if present |
| Uppercase Letters | +([Length - Count] x 2) if mixed with other characters |
| Numbers | +(Count x 4) if mixed with other character types |
| Symbols | +(Count x 6) |
| Middle Numbers / Symbols | +(Count x 2) for non-letters placed inside internal indices |
| Requirements Met | +(Total Requirements x 2) if minimum length is met and &ge; 3 rules pass |

2. Deductions

Points are subtracted for predictable patterns or structural weaknesses:

| Test Factor | Deduction Logic |
| --- | --- |
| Letters Only | -(Length x 8) |
| Numbers Only | -(Length x 8) |
| Repeating Characters | -(Count x 2) for adjacent duplicates |
| Consecutive Lowercase | -(Count x 4) |
| Consecutive Uppercase | -(Count x 4) |
| Consecutive Numbers | -(Count x 4) |
| Sequential Letters | -(Count x 6) for 3+ letter alphabetical runs |
| Sequential Numbers | -(Count x 6) (or x8 for runs matching 4+ forward/reverse patterns) |
| Sequential Keys | -(Count x 6) for keyboard layout runs (e.g., `qwerty`, `asdf`) |
| Phone Number Pattern | -(Additions x [Phone Length / Password Length]) based on percentage of password by the phone number |
| Birthday / Date Pattern | -(Additions x [Date Length / Password Length]) based on percentage of password consumed by the date |

3. Dynamic Threshold Overrides

Severe vulnerabilities apply dynamic deductions to force the final score down to a hard safety cap:

- Stair-Step Sequential Override:
    - If the maximum single sequence count (`$seqMax`) &gt; 2 (e.g., 5-character sequence), score is capped at 50.
    - If `$seqMax` &gt; `3` (e.g., 6+ character sequence), score is capped at 40.
- Leet-Speak & Blacklist Override:
    - If normalized leet-speak matches any word in `$blacklist`, score is forcibly capped at 15.
- Email Address Override:
	- If password contains a valid email pattern (`user@domain.tld`), score is forcibly capped at 15.

### Complexity Tiers

The method returns a general strength percentage and categorizes the password into one of six primary complexity strings stored in `$data['Complexity']`:

| Score / Condition | Complexity Rating |
| --- | --- |
| Blacklisted Root Word | Common / Vulnerable |
| Length Below Minimum & Score &le; 20 | Too Short |
| Score &le; 20 | Very Weak |
| Score 21 - 40 | Weak |
| Score 41 - 60 | Good |
| Score 61 - 80 | Strong |
| Score 81 - 100 | Very Strong |

### Output Structure (`$data`)

When passing an array by reference into `$data`, the method populates it with the following structure:

```
[
	'Additions'	=> 138,
	'Complexity'	=> 'Common / Vulnerable',
	'Deductions'	=> 123,
	'Entropy'	=> '82.19 bits',
	'Length'	=> 13,
	'Password'	=> 'P@ssw0rd12345',
	'Score'		=> 15,
	'Strength'	=> '15%',
	'Tests'		=> [
		// Individual test arrays containing:
		// ['Test', 'Category', 'Count', 'Score', 'Strength', 'Code', 'Msg']
    ]
]
```

## Examples

1. Basic Strength Rating Check

```
$sec->passStrength('K9#mX!vL28P$') = 100%
```

2. Comprehensive Audit Inspection

```
$sec->passStrength('P@ssw0rd12345', $data);

$data['Complexity'] = Common / Vulnerable
$data['Score'] = 15
$data['Strength'] = 15%
...

foreach ($data['Tests'] as $test) {
	echo "{$test['Test']}: {$test['Score']} points ({$test['Msg']})\n";
}
```

## Debug Errors

- No debug errors.

## Related Methods

[loadCustomBlacklist](loadCustomBlacklist.md) | [passEntropy](passEntropy.md) | [passGen](passGen.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Metrics](../CoreySecurity.md#metrics)

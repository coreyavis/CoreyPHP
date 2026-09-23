# passEntropy

Calculates the cryptographic entropy of a given password string in bits and assigns a human-readable complexity rating based on the currently active character pools.

> :pushpin: The `passEntropy()` method calculates entropy based on ideal randomness (Shannon Entropy), assuming every character in the pool has an equal mathematical probability of being selected (e.g., a completely machine-generated password).
>
> **Important**: Do not rely on entropy alone to decide if a password is secure. Because the math is blind to the arrangement of characters, predictable strings like `P@ssw0rd12345` can score an exceptionally strong **82.19 bits** while still being fundamentally unsafe. Humans follow predictable linguistics patterns, structures, and common substitutions, which drastically reduces the search space for dictionary-based brute-force attacks.
>
> **Best Practice**: Always pair this informational metric with the `passStrength()` method. While `passEntropy()` measures theoretical brute-force resistance, `passStrength()` applies the tiered pattern matrices, sequential character clamps, and leet-speak blacklists required to evaluate actual human behavior.

## Usage

```
passEntropy(string $pw, bool $format = false, ?string &$complexity = null): string|float
```

## Parameters

**pw** (string)
: The password string to evaluate.

**format** (bool)
: If set to `true`, appends the string `" bits"` to the end of the calculation. (*default*: `false`) *^(optional)^*

**complexity** (string|null)
: If complexity is populated, it captures the complexity rating. (*default*: `null`) *^(optional)^*

### Complexity Tiers

The method automatically categorizes the password's strength into one of seven distinct tiers based on its calculated bit score:

| Entropy Range (Bits) | Complexity Rating | Security Assessment |
| --- | --- | --- |
| &ge; 128 | Excellent | Practically uncrackable; ideal for master seeds. |
| 100 - 127 | Very Strong | Extremely secure against targeted brute-force. |
| 80 - 99 | Strong | Highly recommended defense for modern applications. |
| 60 - 79 | Good | Solid baseline security for casual online accounts. |
| 36 - 59 | Fair | Vulnerable to optimized or distributed cracking rigs. |
| 28 - 35 | Weak | Easily guessed or cracked within minutes. |
| &lt; 28 | Very Weak | Zero real protection; highly vulnerable. |
| 0 | Zero Entropy! | Triggered if the active character pool size collapses to &le; 1. |

## Return Value

(string|float)
: Returns the entropy of the password as a float, or as a string with `bits` appended if $format is set to `true`.

> Context-Aware Pool Math: Rather than relying on rigid pool sizes, the method dynamically checks which configuration choices are active (e.g., `uppercase`, `numbers`, `symbols`) and scans the lookalike list (`SIMILARLIST`) with precise regular expressions to count exactly what was removed.

## Examples

1. Standard Usage (With Rating)

```
$sec->passEntropy('P@ssw0rd123!', false, $rating) = 72.43
// $rating: Good 
```

2. Formatted Usage (For Comparison)

```
$sec->passEntropy('MySuperSecretPassword!!!', true) = 132.18 bits
```

## Debug Errors

- Throws an exception if password is empty string.

## Related Methods

[passGen](passGen.md) | [passStrength](passStrength.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Metrics](../CoreySecurity.md#metrics)

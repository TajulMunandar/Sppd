# Laravel Comment Standards

## 1. Objective

Maintain clean, readable, and maintainable Laravel code by ensuring that comments provide meaningful information.

Comments must add context that cannot be easily understood from the code itself. Avoid redundant, outdated, misleading, or unnecessary comments.

The primary goal is to make code self-explanatory through clear naming, appropriate structure, and simple implementation rather than excessive commenting.

## 2. Existing Project Inspection

When inspecting or modifying an existing Laravel project:

1. Review comments in the files relevant to the current task.
2. Identify redundant, outdated, misleading, or irrelevant comments.
3. Remove comments that provide no additional technical or contextual value.
4. Update comments when their explanations no longer match the implementation.
5. Preserve comments that explain important business rules, architectural decisions, technical constraints, or non-obvious implementation details.
6. Do not perform a project-wide comment cleanup unless explicitly requested.
7. Never modify generated files, vendor dependencies, framework files, or third-party packages solely to clean up comments.

**Important:** Do not delete comments indiscriminately. A comment is not unnecessary merely because it is short or appears obvious without understanding its surrounding context.

## 3. Commenting Principles

### 3.1. Prefer Self-Documenting Code

Write code that communicates its intent through:

- Meaningful variable and method names.
- Clear class and method responsibilities.
- Small, focused methods.
- Appropriate separation of concerns.
- Consistent Laravel conventions.

Avoid adding comments to explain code that can be made clearer through better naming or refactoring.

### 3.2. Comments Must Provide Additional Context

Use comments only when they explain information that is not immediately apparent from the implementation.

Appropriate use cases include:

- Complex business rules.
- Non-obvious algorithms or calculations.
- Important architectural decisions.
- Technical limitations or workarounds.
- Security considerations.
- Performance-related decisions.
- External API integration requirements.
- Unexpected framework or database behavior.

### 3.3. Explain Why, Not What

Comments should primarily explain the reason behind an implementation rather than describe what the code already does.

Bad:
```php
// Get active users.
$users = User::where('is_active', true)->get();
```

Good:
```php
// Only active users are eligible to receive system notifications.
$users = User::where('is_active', true)->get();
```

### 3.4. Keep Comments Accurate

- Update comments whenever the related implementation changes.
- Remove comments that no longer reflect the actual behavior.
- Never leave misleading explanations.
- Do not document assumptions as established facts.
- Do not duplicate information already maintained in configuration, documentation, or database definitions unless the duplication provides essential context.

### 3.5. Use Clear and Concise Language

- Use clear, professional, and consistent language.
- Prefer Bahasa Indonesia for project-specific business explanations when that is the project's established convention.
- Use English for technical terminology when it improves precision.
- Avoid unnecessary abbreviations, vague statements, and excessive descriptions.

## 4. PHPDoc Standards

Use PHPDoc when it provides meaningful information about classes, methods, properties, parameters, return values, or complex data structures.

PHPDoc is particularly useful when:

- A method has a non-obvious contract.
- Parameter or return types require additional explanation.
- A method accepts or returns complex arrays or structured data.
- A public API needs explicit documentation.
- Static analysis or IDE tooling benefits from type annotations.
- A method has important preconditions, side effects, or exceptions.

Example:

```php
/**
 * Calculate the final assessment score using the weighted criteria.
 *
 * @param array<string, float> $scores
 * @return float
 */
public function calculateFinalScore(array $scores): float
{
    // Implementation
}
```

Rules:

1. Do not add PHPDoc that merely repeats native PHP type declarations.
2. Do not generate PHPDoc for every method automatically.
3. Keep annotations consistent with the actual implementation.
4. Use accurate generic types where applicable.
5. Document important side effects, exceptions, and business constraints when relevant.
6. Preserve framework-required annotations and metadata.

## 5. Laravel-Specific Guidelines

Follow these guidelines when writing comments in Laravel applications.

### 5.1. Models and Eloquent

Add comments when they clarify:

- Non-obvious relationships.
- Complex query scopes.
- Custom attribute behavior.
- Important model invariants.
- Non-standard casting or serialization behavior.

Do not add comments that simply restate relationship definitions or obvious Eloquent operations.

### 5.2. Controllers

Controllers should remain focused on HTTP request handling and response orchestration.

Avoid comments that describe routine operations such as:

- Validating requests.
- Retrieving records.
- Returning views.
- Redirecting users.

Document only non-obvious business decisions or important processing constraints.

### 5.3. Services and Business Logic

Services may contain comments explaining:

- Business rules.
- Complex calculations.
- Processing sequences.
- Transaction boundaries.
- Data consistency requirements.
- Important side effects.

For complex business logic, comments should explain the business context and reasoning, not narrate every statement.

### 5.4. Migrations and Seeders

Preserve comments that clarify important database design decisions, legacy compatibility, or non-obvious data transformations.

Do not add comments that simply repeat table names, column names, or migration operations.

### 5.5. Routes and Middleware

Avoid comments that merely describe route definitions or middleware assignments.

Use comments only for exceptional routing behavior, authorization constraints, or important integration requirements.

### 5.6. Blade Templates and JavaScript

Avoid comments that repeat the purpose of obvious HTML, Blade directives, or JavaScript statements.

Use comments to explain complex UI behavior, conditional rendering rules, or non-obvious frontend integration requirements.

## 6. TODO, FIXME, and NOTE Conventions

Use standardized tags only when they communicate an actionable issue.

- `TODO`: A specific improvement or unfinished implementation.
- `FIXME`: A known defect that requires correction.
- `NOTE`: Important contextual information that future developers should understand.

Example:

```php
// TODO: Replace the temporary calculation after the official scoring formula is approved.

// FIXME: Handle duplicate submissions before processing the transaction.

// NOTE: Scores are already weighted before being persisted.
```

Rules:

1. Every TODO or FIXME should describe a specific action or problem.
2. Include an issue reference when one exists.
3. Do not use TODO as a substitute for implementing an explicitly requested feature.
4. Remove completed TODO or FIXME comments.
5. Avoid vague comments such as `// TODO: Improve this later`.

## 7. Comments That Must Be Preserved

Never remove comments that serve a necessary technical or operational purpose, including:

- PHPDoc required by tooling or static analysis.
- Framework-specific annotations or directives.
- License and copyright notices.
- Generated-file warnings.
- Security-related explanations.
- Important business-rule documentation.
- Database compatibility notes.
- External API requirements.
- Necessary code-generation markers.
- Comments required by testing, deployment, or build tools.

When uncertain about the purpose of a comment, investigate before modifying or removing it.

## 8. Prohibited Commenting Practices

Do not:

1. Add comments to every line of code.
2. Repeat the implementation in natural language.
3. Add comments merely to make code appear documented.
4. Leave outdated or misleading comments.
5. Add speculative explanations.
6. Include passwords, API keys, tokens, credentials, or other sensitive information.
7. Use comments to hide poor code structure instead of improving the implementation.
8. Add redundant section separators or decorative comment blocks.
9. Leave commented-out code in the project unless it has a documented and necessary purpose.
10. Create unnecessary PHPDoc for simple methods with self-explanatory signatures.

## 9. Comment Review and Cleanup Workflow

When asked to review or clean up comments:

1. Identify the relevant files and inspect their surrounding implementation.
2. Classify comments as:
   - Essential: Must be preserved.
   - Useful: Should be preserved or improved.
   - Redundant: Should be removed.
   - Outdated: Should be corrected or removed.
   - Uncertain: Requires further investigation.
3. Make only justified changes.
4. Preserve application behavior and existing functionality.
5. Review the modified files to ensure comments accurately describe the implementation.
6. Run relevant formatting, static analysis, or tests when appropriate.
7. Report the cleanup performed and any unresolved comments.

Do not refactor unrelated code merely because it contains comments.

## 10. Final Quality Checklist

Before completing a task involving comments, verify:

- [ ] Comments provide meaningful additional information.
- [ ] No redundant or obvious comments have been introduced.
- [ ] Existing essential comments are preserved.
- [ ] PHPDoc matches actual method signatures and behavior.
- [ ] Business rules and technical constraints remain documented.
- [ ] TODO and FIXME comments are actionable.
- [ ] No sensitive information is exposed.
- [ ] No commented-out code remains without justification.
- [ ] No unrelated files or application behavior have been modified.

## 11. Core Rule

**Write self-documenting code first. Add comments only when they provide essential context that code alone cannot communicate effectively.**

The quality of comments is measured by their usefulness, accuracy, and relevance, not by their quantity.

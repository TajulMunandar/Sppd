---
paths:
  - "resources/views/**"
---

# Laravel Blade UI Architecture Rules

## 1. Existing Project Inspection

Before creating or modifying UI code, inspect the existing project structure and implementation, including:

- **Primary layouts:** Inspect the relevant layout files under `resources/views/layouts/`, including the layout used by `<x-app-layout>`.
- **Reusable layout partials:** Inspect `resources/views/layouts/partials/` for existing reusable interface elements, such as navigation, page headers, breadcrumbs, sidebars, alerts, dropdowns, and other shared UI patterns.
- **Blade pages:** Review representative pages that use `<x-app-layout>` to understand their content structure and established conventions.
- **Blade components:** Inspect existing components, partials, slots, attributes, and component APIs before creating new ones.
- **Frontend configuration:** Verify the installed Laravel and Tailwind CSS versions, JavaScript libraries, and existing interaction patterns.
- **Application behavior:** Review relevant route names, controller responses, validation behavior, and authorization constraints.

- Do not assume that the primary layout is located in `resources/views/components/`. Inspect the actual implementation to understand how `<x-app-layout>` uses the layout files under `resources/views/layouts/`.
- Do not assume that a reusable UI element is unavailable until you have checked `resources/views/layouts/partials/` and the relevant component directories.
- Do not introduce a new CSS framework, UI library, or JavaScript dependency without an explicit requirement and clear justification.

## 2. Blade Component Reuse and Layout Architecture

This project uses `<x-app-layout>` as its established application-page layout convention, with layout files under `resources/views/layouts/` and reusable interface partials under `resources/views/layouts/partials/`.

### Layout Rules

- MUST use `<x-app-layout>` for application pages where this is the established project convention.
- MUST inspect the actual `<x-app-layout>` implementation and its associated layout files before modifying layout behavior.
- MUST follow the content structure and slot conventions used by existing pages.
- MUST verify supported slots and attributes before using them. Do not assume that a header slot or any other named slot exists.
- MUST NOT assume that the primary layout is defined in `resources/views/components/app-layout.blade.php`.
- MUST NOT introduce `@extends`, `@section`, `@yield`, or `@show` as the default layout mechanism for pages that should use `<x-app-layout>`.
- MUST NOT convert component-based pages to template inheritance merely for stylistic preference.
- MAY use template inheritance only when a distinct application area explicitly requires it and the existing implementation follows that convention.
- MUST avoid arbitrarily mixing component-based layouts and template inheritance within the same application area.

### Reusable Partial Rules

- MUST inspect `resources/views/layouts/partials/` before creating a new shared interface element.
- MUST reuse an existing partial when it provides the required structure and behavior.
- MUST preserve the existing partial's expected data, variables, parameters, and rendering conventions.
- MUST use Laravel's `@include` directive for partials according to the existing project conventions.
- MUST keep shared UI elements consistent across pages by reusing the same partial rather than duplicating its markup.
- MUST NOT copy an existing partial's markup into individual pages merely to make small visual changes. Extend or modify the shared partial when that is the appropriate solution.
- MUST assess the impact on all pages that use a partial before modifying it.
- MUST NOT introduce a new partial for a one-off element unless extraction provides a clear maintainability or consistency benefit.

### Choosing the Appropriate Structure

Use the following decision process before implementing a UI element:

1. **Existing layout:** If the element belongs to the overall page structure, use the appropriate layout under `resources/views/layouts/`.
2. **Existing partial:** If the element is already implemented as a reusable partial under `resources/views/layouts/partials/`, reuse it.
3. **Existing Blade component:** If a component already provides the required behavior and matches the project's conventions, reuse it.
4. **New reusable element:** If no suitable implementation exists, determine whether a new partial or component is justified by actual reuse and maintainability needs.
5. **Page-specific markup:** Keep genuinely page-specific content in the relevant Blade page instead of creating unnecessary abstractions.

- Do not duplicate navigation, page headers, breadcrumbs, form controls, alerts, action groups, or other shared interface patterns when an appropriate reusable implementation already exists.
- If existing pages use inconsistent patterns, inspect the relevant feature and preserve its established architecture unless a justified change is required.

## 3. Separation of Concerns

- Keep Blade templates focused on presentation and rendering.
- Do not place complex business logic, database queries, or authorization decisions directly in Blade templates.
- Use controllers, services, policies, form requests, Livewire components, or other existing application layers for their appropriate responsibilities.
- Keep frontend behavior in the project's established JavaScript or component architecture.
- Preserve the distinction between visual presentation and application behavior.
- Use escaped Blade output (`{{ }}`) for ordinary or untrusted text.
- Use unescaped output (`{!! !!}`) only when the content is intentionally trusted and appropriately sanitized where necessary.
- Do not bypass backend validation, authorization, or permission checks to make a UI element appear or function.

## 4. UX Laws in Blade Implementation

All UI changes MUST apply the five UX laws (Jakob's Law, Hick's Law, Fitts's Law, Law of Proximity, Peak-End Rule) as defined in `ui-ux-design.md`. Do not apply them mechanically; use them to support the user's primary task.

Before implementation, identify the primary user task, establish the information hierarchy, and justify significant layout decisions using these laws.

## 5. Laravel Forms and Validation

- Use appropriate HTTP methods and named routes consistent with the existing application.
- Include CSRF protection for state-changing requests.
- Preserve valid user input using Laravel's `old()` helper where appropriate.
- Display server-side validation errors close to their corresponding fields.
- Associate labels with form controls using matching `for` and `id` attributes.
- Clearly communicate required fields, invalid values, and corrective actions.
- Do not display success messages unless the corresponding operation has actually succeeded.
- Keep destructive actions distinguishable and require confirmation when appropriate to the risk.
- Preserve backend authorization and validation; frontend restrictions are not a substitute for server-side enforcement.
- Reuse existing form components and established project patterns where available.
- Preserve existing field names, routes, validation rules, and business workflows unless the task explicitly requires a change.
- Ensure loading and disabled states do not misrepresent whether an operation has completed.

## 6. Existing Theme and Design-System Integrity

The project MUST follow the UI theme, design system, and visual conventions already established in the existing application. Do not assume that the project uses TailAdmin, Bootstrap, Tailwind CSS, or any other specific framework or theme until the actual implementation has been inspected.

Before creating or modifying an interface, inspect the relevant layouts, Blade components, partials, stylesheets, design tokens, assets, JavaScript integrations, and frontend configuration that are actually present in the project.

- MUST identify the existing theme and frontend stack from the project files and implementation before making UI decisions.
- MUST reuse existing components, layouts, design tokens, utility classes, and interaction patterns whenever appropriate.
- MUST preserve the established visual language, including typography, colors, spacing, borders, shadows, icons, buttons, forms, cards, navigation, dropdowns, modals, tables, and responsive behavior.
- MUST use CSS classes, utilities, component APIs, and conventions supported by the installed dependencies and actual project configuration.
- MUST follow the project's existing CSS, JavaScript, asset-loading, and build conventions.
- MUST verify that a component or style is available in the project before attempting to reuse it.
- MUST NOT assume that components shown in external documentation, templates, or demos are installed or implemented locally.
- MUST NOT replace established theme patterns with generic or newly invented implementations merely for stylistic preference.
- MUST NOT introduce arbitrary colors, spacing values, typography, or one-off styles when established theme patterns are available.
- MUST NOT introduce another UI framework, design system, component library, or frontend dependency without explicit authorization and clear justification.
- MUST NOT redesign unrelated interface sections simply to make them look more modern.

### Extending Existing Theme Components

When a requirement cannot be met by an existing component or pattern:

1. Search the project for an equivalent component or established pattern.
2. Reuse or extend the existing implementation if it satisfies the requirement.
3. If no suitable implementation exists, create the smallest extension that is consistent with the existing theme and architecture.
4. Preserve responsiveness, accessibility, and compatibility with existing interactions.
5. Avoid duplicated components, unnecessary CSS overrides, and inconsistent one-off styling.

Do not create a separate design system or introduce additional dependencies to solve a problem that can be addressed within the existing implementation.

## 7. Accessibility and Responsive Design

- Use semantic HTML elements appropriate to their purpose.
- Provide accessible names and labels for interactive controls.
- Ensure keyboard navigation and visible focus indicators.
- Use appropriate heading levels and a logical reading order.
- Use responsive layouts that preserve the information hierarchy across desktop, tablet, and mobile.
- Avoid horizontal overflow except where a specific component, such as a data table, reasonably requires it.
- Do not communicate status through color alone.
- Respect reduced-motion preferences when introducing nonessential animation.
- Ensure dialogs, dropdowns, menus, and other interactive components remain usable with the keyboard where applicable.
- Preserve the existing theme's responsive behavior unless a change is necessary to resolve a specific usability problem.

## 8. Implementation Integrity

- Follow existing naming conventions and directory structure.
- Preserve the project's established `<x-app-layout>` architecture and existing theme conventions.
- Do not rewrite unrelated Blade views or shared components when a targeted change is sufficient.
- Check the impact of shared-component changes on other pages that use them.
- Preserve existing routes, backend behavior, authorization, validation, and business workflows.
- Verify routes, validation states, authorization behavior, and frontend interactions affected by the implementation.
- Do not claim that a feature or interaction has been tested unless it has actually been tested.
- Report significant trade-offs, known regressions, and unresolved usability issues.

## 9. Completion Criteria

A Blade UI change is complete only when:

1. The implementation follows the five UX laws where relevant.
2. The user's primary task and the page's information hierarchy are clear.
3. The existing `<x-app-layout>` convention and Blade component architecture are respected.
4. Existing theme components, styling, and interaction patterns are reused where appropriate.
5. Important interaction, validation, loading, success, failure, and recovery states are handled where applicable.
6. Responsive behavior and accessibility have been considered.
7. Existing application functionality and unrelated workflows are preserved.
8. Relevant tests or manual verification have been performed where feasible.
9. Unverified behavior and unresolved usability issues are explicitly identified.

Before declaring the work complete, review the changed views against these rules and the applicable UI/UX requirements. Report what was verified, how it was verified, and what remains unverified.

**Core principle:** Every UI decision must support the user's task, usability, accessibility, or consistency with the existing application. Visual appeal alone is not sufficient justification.

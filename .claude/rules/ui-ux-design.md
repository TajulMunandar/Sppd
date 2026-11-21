---
paths:
  - "resources/views/**"
  - "public/js/**"
  - "public/css/**"
---

# UI/UX Design Rules — Five Laws of UX

## 1. Purpose

All UI/UX design decisions MUST be grounded in user needs, task requirements, information hierarchy, interaction patterns, and usability principles.

The five laws below are mandatory design evaluation principles:

1. Jakob's Law
2. Hick's Law
3. Fitts's Law
4. Law of Proximity
5. Peak-End Rule

These principles MUST influence layout structure, navigation, component selection, visual hierarchy, interaction behavior, and task completion flows.

Visual attractiveness alone is NOT sufficient justification for a design decision.

## 2. Mandatory Design Process

Before implementing or modifying any page, you MUST:

1. Identify the primary users and their expected tasks.
2. Determine the page's primary purpose and the most important user action.
3. Identify the information hierarchy: primary, secondary, and supporting information.
4. Map the user flow, including entry points, decision points, errors, and completion states.
5. Evaluate relevant design decisions against all five UX laws.
6. Inspect existing application patterns and design conventions before introducing new ones.
7. Implement the design and verify its usability across relevant screen sizes and interaction states.

Do NOT start by arranging cards, choosing colors, or adding decorative elements before establishing the information hierarchy and task flow.

If essential requirements are missing, inspect the existing application and infer only what is reasonably supported by its context. Ask for clarification when an unresolved requirement materially affects the design.

## 3. Law 1 — Jakob's Law

### Principle
Users bring expectations and mental models formed by using other applications. Familiar interaction patterns reduce the effort required to understand an interface.

### Mandatory rules
- Follow established conventions for navigation, search, filters, forms, tables, dialogs, pagination, and common actions.
- Preserve existing application patterns unless there is a clear usability reason to change them.
- Use familiar labels that describe the actual purpose of an action.
- Keep navigation structure and component behavior consistent across related pages.
- Use established platform conventions when designing for desktop, tablet, and mobile.
- Introduce unfamiliar interaction patterns only when their benefits justify the learning cost.

### Prohibited practices
- Inventing unconventional navigation merely to make the interface look unique.
- Changing the meaning or placement of familiar controls without justification.
- Using icons without recognizable meaning or an appropriate accessible label.
- Implementing different interaction behaviors for equivalent components across pages without a valid reason.

### Validation question
Can a first-time user reasonably predict how to navigate the page and operate its primary controls?

## 4. Law 2 — Hick's Law

### Principle
Increasing the number and complexity of choices can increase the time and effort required to make a decision.

### Mandatory rules
- Establish a clear visual hierarchy between primary, secondary, and destructive actions.
- Group related options into meaningful categories.
- Reveal advanced or infrequently used controls only when they become relevant.
- Use progressive disclosure when it reduces unnecessary cognitive load without hiding essential information.
- Simplify decision-making through sensible defaults, contextual options, and clearly differentiated choices.
- For dashboards, prioritize information according to user tasks rather than displaying every available metric at once.
- For complex forms, organize fields into logical sections and explain dependencies between them.

### Prohibited practices
- Giving every action equal visual prominence.
- Displaying large collections of unrelated options without grouping or prioritization.
- Splitting a simple task into unnecessary steps.
- Hiding essential actions or information merely to achieve a minimalist appearance.
- Reducing the number of choices when doing so removes meaningful user control.

### Validation question
Does the interface help users identify the appropriate next action without unnecessary analysis or navigation?

## 5. Law 3 — Fitts's Law

### Principle
The effort required to reach a target depends partly on its size and distance. Interaction targets should be easy to locate and activate.

### Mandatory rules
- Provide sufficiently large interactive targets, especially for frequently used actions and touch interfaces.
- Use adequate spacing between adjacent controls to reduce accidental activation.
- Position primary actions where users can locate them naturally within the task flow.
- Keep destructive actions visually and spatially distinguishable from routine actions.
- Ensure interactive elements have clear hover, focus, active, disabled, and loading states where applicable.
- Make keyboard navigation and focus indicators usable.
- Consider target reachability and layout changes on small screens.
- Follow applicable accessibility requirements; for example, use WCAG 2.2 target-size criteria where relevant.

### Prohibited practices
- Using tiny icon-only controls for important actions without adequate target size or accessible naming.
- Placing destructive actions immediately beside frequent actions without sufficient differentiation.
- Requiring unnecessary precision for common interactions.
- Using visual proximity that causes users to confuse adjacent interactive targets.

### Validation question
Can users locate and activate the intended control reliably, including users on touch devices and users who navigate by keyboard?

## 6. Law 4 — Law of Proximity

### Principle
Elements positioned close to one another are perceived as belonging together. Spatial relationships should communicate information relationships.

### Mandatory rules
- Group related content, controls, labels, and values into coherent visual units.
- Keep form labels close to their corresponding fields.
- Keep headings close to the content they introduce.
- Use spacing consistently to distinguish groups from items within a group.
- Separate unrelated dashboard metrics and functional areas through whitespace, alignment, or restrained visual boundaries.
- Establish a clear hierarchy between page sections, component groups, and individual elements.
- Ensure that visual grouping reflects actual semantic or functional relationships.
- Use responsive layouts that preserve meaningful grouping across screen sizes.

### Prohibited practices
- Placing unrelated metrics in the same visual group without a meaningful relationship.
- Separating labels, helper text, or validation messages from their associated fields.
- Using excessive borders and cards when spacing and alignment communicate the structure more clearly.
- Relying on color alone to communicate relationships between elements.

### Validation question
Can users understand which information and controls belong together without having to interpret every element individually?

## 7. Law 5 — Peak-End Rule

### Principle
Users' retrospective evaluation of an experience can be disproportionately influenced by its most emotionally salient moment and how the experience ends.

This principle should guide the design of important interactions, particularly workflows involving submissions, approvals, payments, data changes, and other consequential actions.

### Mandatory rules
- Design clear success, failure, empty, loading, and recovery states for important workflows.
- Confirm the actual outcome of a user action rather than showing success prematurely.
- Provide meaningful feedback after submissions, saves, deletions, approvals, and other consequential operations.
- Explain errors in actionable language and offer an appropriate recovery path.
- Provide a clear completion state and a relevant next action when a workflow ends.
- Preserve user input when an error can be recovered from safely.
- Use confirmation dialogs for destructive or irreversible actions when the risk warrants them.
- Ensure completion feedback reflects the real backend result, not merely a frontend interaction.
- Keep important workflows predictable and avoid unnecessary friction at their conclusion.

### Prohibited practices
- Displaying a success message before the operation has actually succeeded.
- Ending a critical workflow without explaining its outcome.
- Showing generic errors when a more useful explanation is available.
- Forcing users to repeat an entire workflow because of a recoverable error.
- Adding unnecessary celebratory animations or visual effects that interfere with task completion.

### Validation question
Does the user understand what happened, whether the task is complete, and what to do next?

## 8. Layout and Visual Hierarchy Rules

Every page MUST establish a deliberate information hierarchy.

- Define one clear primary purpose per page.
- Prioritize information according to relevance, frequency of use, and task importance.
- Use typography, spacing, alignment, and contrast to communicate hierarchy.
- Avoid unnecessary cards, borders, gradients, shadows, and decorative elements.
- Do not use a card-based layout by default when a simpler section, list, table, or split layout better represents the information.
- Do not force unrelated KPIs, charts, and actions into a single row merely for visual symmetry.
- Use tables when users need to compare, scan, sort, filter, or inspect structured records.
- Use alternative layouts when they better support the task, not merely to make the page look modern.
- Maintain consistent spacing, typography, control sizes, and component behavior.
- Treat responsive behavior as a structural design requirement rather than a final cosmetic adjustment.

## 9. Existing Application Consistency

Before introducing new components or changing the layout:

- Inspect existing pages, reusable components, design tokens, and navigation patterns.
- Reuse existing components and conventions when they meet the requirements.
- Avoid introducing a new design system or visual language without a clear need.
- Do not arbitrarily change established colors, typography, spacing, or component behavior.
- When an existing pattern causes usability problems, identify the problem and improve the pattern consistently.

## 10. Mandatory Design Review

Before declaring a UI implementation complete, evaluate it against the following checklist.

### Jakob's Law
- [ ] Navigation and interactions follow recognizable conventions.
- [ ] Existing application patterns remain consistent where appropriate.

### Hick's Law
- [ ] Primary actions and information are clearly prioritized.
- [ ] Choices are grouped and unnecessary decision complexity is reduced.

### Fitts's Law
- [ ] Important controls are easy to locate and activate.
- [ ] Target sizes, spacing, keyboard access, and destructive-action separation are appropriate.

### Law of Proximity
- [ ] Related information and controls are visually grouped.
- [ ] Unrelated information is clearly separated.

### Peak-End Rule
- [ ] Important workflows provide accurate feedback.
- [ ] Errors have useful recovery paths.
- [ ] Completion states clearly communicate outcomes and next steps.

### Overall quality
- [ ] The layout supports actual user tasks.
- [ ] The design remains coherent across relevant screen sizes.
- [ ] Empty, loading, error, success, and disabled states are handled where applicable.
- [ ] No decorative or structural choice undermines usability.

Do not mark an item as compliant without a reasonable design rationale or implementation evidence.

## 11. Required Response When Designing a Page

When asked to design or restructure a page, provide the following reasoning before or alongside implementation, proportionate to the complexity of the task:

1. **User objective:** The primary task the page must support.
2. **Information hierarchy:** What users need to see first, second, and later.
3. **Layout rationale:** Why the chosen layout is appropriate.
4. **Five-law evaluation:** Relevant design decisions and their relationship to the five laws.
5. **Interaction states:** Important success, error, loading, empty, and recovery states.
6. **Responsive considerations:** How the layout adapts to different screen sizes.
7. **Validation:** Any remaining usability concerns or assumptions.

For minor component changes, keep the explanation concise. For complete page redesigns, provide enough detail to make the reasoning reviewable.

## 12. Conflict Resolution

The five laws are complementary principles, not absolute formulas.

When they appear to conflict:

1. Prioritize user goals, task correctness, and accessibility.
2. Preserve familiar patterns unless there is evidence that changing them improves usability.
3. Reduce unnecessary complexity without hiding essential choices.
4. Optimize interaction targets without compromising layout hierarchy or responsiveness.
5. Use proximity to express meaningful relationships rather than merely minimizing whitespace.
6. Design completion feedback that is accurate, useful, and appropriate to the task.

Never claim that a design complies with all five laws solely because a checklist was completed.

**Final requirement:** Every substantial UI/UX design decision must have a clear functional or usability rationale. Do not generate arbitrary layouts based solely on visual preference, trend, or aesthetic symmetry.

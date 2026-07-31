# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 0.1.0 July 31, 2026

- feat: initial `ui-awesome/html-field` package structure.
- feat: add configuration for the widget to `FormModelInterface::class`.
- refactor: update namespace imports in test files.
- chore: migrate to the stable UI Awesome architecture and modern PHP `8.3` tooling.
- feat: add immutable semantic `ControlFactory` integrated with application-scoped `Config`.
- feat: connect `Field` to semantic control creation and scoped recipes for every field slot.
- feat: bind select values through `Select::value()` and reuse typed choice controls from `ui-awesome/html`.
- fix: preserve class-level defaults when `ControlFactory` creates `BaseTag` controls.
- fix: keep field selections separate from checkbox and radio option values.
- feat: add `Message` enum centralizing exception message templates.
- chore: require the `ui-awesome/html-core ^0.7` and `ui-awesome/html ^0.5` development lines.
- test: normalize the test suite with full-HTML assertions, failure messages, and external data providers.
- test: assert exception messages in the remaining `InvalidControl` and `TypeError` expectation tests.
- chore: remove the empty `tests/Control/` directory.
- refactor: replace `method_exists()` capability checks in `AbstractField` with `ui-awesome/html-contracts` interfaces.
- chore: require the `ui-awesome/html-contracts ^0.2` development line.
- test: replace the `InputWidget` stub with real `ui-awesome/html` controls across the suite.
- chore: rename the `test` composer script to `tests` and migrate the Infection configuration to `infection.json5` for ecosystem consistency.
- feat!: apply field configurations through the core Config applier in strict mode; unknown methods now throw `ConfigException`.
- feat!: apply field configurations to the form control only; entries naming field-level methods must move to the field or a theme recipe.
- feat: reject field config entries indexed by non-string or empty keys and entries passing named arguments with `InvalidFieldConfig`.
- refactor: remove `applyDefinitionsToWidget()` and the last `method_exists()` capability check from `AbstractField`.
- docs: add `UPGRADE.md` and document the supported field config shapes and strict-mode failures.
- fix: apply the field configuration once per render against the resolved control, removing fluent-order sensitivity where a replacement-control entry threw against the default control.
- refactor: guard the form model binding with an `instanceof` check instead of `@var` narrowing, keeping the intrinsic binding type-safe under style fixers.
- feat!: apply field configuration after model binding so explicit entries override derived `value`, `id`, `name`, `checked`, and `placeholder` state.
- fix: derive the label `for` attribute from the control's final `id`, keeping it linked when a field configuration overrides the identifier.
- feat: resolve control-specific input-container and label layout slots for semantic controls.
- feat: allow re-enabling a theme-suppressed label with `notLabel(false)`.

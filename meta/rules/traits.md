---
Trait:
  Name: Breathless
  Scope: Self
  Variable: BreathingRequired
  Override: false
  Conditions: null


Trait:
  Name: Breathless
  Effects:
    - target: BreathingRequired
      type: override
      value: false
      priority: 100
---

Character.BreathingRequired = default(true)

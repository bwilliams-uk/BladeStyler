# BladeStyler

BladeStyler is a Laravel extension designed to help maintain consistent styling across UI components, particularly suited for utility-first CSS frameworks like Tailwind.

## Installation & Setup

BladeStyler is installed using Composer. To install BladeStyler, run the following command in your Laravel project directory:

```bash
composer require williams/bladestyler
```

Next, specify which views should have BladeStyler enabled by adding `BladeStyler::initialize($views)` to the `boot()` method of your project's `AppServiceProvider.php` file.

```php
<?php
use Williams\BladeStyler\BladeStyler;

class AppServiceProvider(){
    public function boot(){
        BladeStyler::initialize(['partials.alert']); //Array of views with BladeStyler enabled
    }
}
```

## Usage

**Defining Styles**

BladeStyler introduces the `@setStyles` directive, allowing you to create reusable class aliases for UI components:

```php
// styles.blade.php

@setStyles([
    'alert' => 'p-2 border',
    'success' => 'text-green-800 border-green-800 bg-green-200',
    'error' => 'text-red-800 border-red-800 bg-red-200'
])
```

**Using Styles**

You can apply these styles within components using the `@applyStyles` directive:

```php
// partials/alert.blade.php

@include('styles')
<div @applyStyles('alert success')>Alert Message</div>

// Will be rendered as:
<div class="p-2 border text-green-800 border-green-800 bg-green-200">Alert Message</div>
```

If you would prefer to handle  the `class=""`  attribute yourself, the `@styles` directive can be used:

```php
<div class="@style('alert success')">Alert Message</div>
```

Alternatively, to obtain the styles in the context of PHP tags:

```php
@php
$styles = $_style('alert'); // 'p-2 border'
@endphp
```

**Conditional Styling**

BladeStyler supports conditional styling, similar to Laravel's `@class` directive:

```php
<div @applyStyles(
    'alert',
    'success' => ($alertType == 'success'), 
    'error' => ($alertType == 'error'))>Alert Message</div>
```

**Class Passthrough**

If a class is not registered using the `@setStyles` directive, it will be passed through directly to the generated HTML:

```php
<div @applyStyles('alert mb-2')>Alert Message</div>

// Will be rendered as:
<div class="p-2 border mb-2">Alert Message</div>
```

## Benefits of BladeStyler

While utility-first frameworks, like [Tailwind CSS](https://tailwindcss.com/docs/reusing-styles), often advise against creating an abstraction layer, there are scenarios where such an approach is necessary. BladeStyler provides an abstraction layer with key advantages that address common concerns:

- **Clear HTML Output**: The generated HTML retains the underlying utility classes, making it simple to see exactly which styling attributes are applied.

- **Simplified UI Development**: No need to manage external CSS files—BladeStyler streamlines the process directly within Blade templates.

- **Component-Level Styling**: Styles can be scoped to individual components rather than applied globally, offering more flexibility and control.

# BladeStyler

BladeStyler is a Laravel extension designed to help maintain consistent styling within views and components, particularly suited for utility-first CSS frameworks like Tailwind.

## Installation & Setup

BladeStyler is installed using Composer. To install BladeStyler, run the following command in your Laravel project directory:

```bash
composer require williams/bladestyler
```

## Directives

BladeStyler introduces five new blade directives:

- `@bs_set` - for defining reusable style class combinations.

- `@bs_class` - for applying class tags with the specified styles.

- `@bs_merge` - for merging style classes into blade component attributes.

- `@bs_string` - for printing the style classes as a string without any attribute handling.

- `@bs_clear` - for clearing definitions previously created with the `@bs_set` directive.

**Defining Styles**

Use `@bs_set` to define aliases for class style combinations:

```blade
@bs_set([
    'alert' => 'p-2 border',
    'success' => 'text-green-800 border-green-800 bg-green-200',
    'error' => 'text-red-800 border-red-800 bg-red-200'
])
```

**Applying styles**

You can apply these styles to HTML elements using the `@bs_class` directive:

```blade
<div @bs_class('alert success')>Alert Message</div>
```

This will produce the following output:

```blade
<div class="p-2 border text-green-800 border-green-800 bg-green-200">Alert Message</div>
```

**Merging Attributes**

BladeStyler offers a short, elegant solution for merging style classes  into a Blade component's attribute bag with the `@bs_merge` directive:

```blade
//components/button.blade.php

@props(['kind'=>'primary']) // Set default button as 'primary'

@bs_set([
    'primary' => 'text-white bg-blue-500 hover:bg-blue-800 rounded',
    'md' => 'p-2' 
])

<button @bs_merge($kind)>{{slot}}</button>
```

Using the component:

```blade
<x-button kind="primary md" type="submit">Submit</x-button>
```

This will produce:

```blade
<button class="text-white bg-blue-500 hover:bg-blue-800 rounded p-2" type="submit">Submit</button>
```

**Obtaining classes as a string**

If the class list is required without class tags, use `@bs_string`:

```blade
<div class="@bs_string('alert success')">Alert Message</div>
```

**Clearing style definitions**

`@bs_clear` can be used to remove all or a specific definition:

```blade
@bs_set([
    'alert' => 'p-2 border',
    'success' => 'text-green-800 border-green-800 bg-green-200',
    'error' => 'text-red-800 border-red-800 bg-red-200'
])

{{--Remove a single definition--}}
@bs_clear('success') 
@bs_string('alert success') {-- Output: p-2 border success --}

{{-- remove all definitions --}}
@bs_clear 
@bs_string('alert success') {-- Output: alert success --}

```

## Additional Features

**Conditional Styling**

The `@bs_class`, `@bs_merge` and `@bs_string` all support conditional styling, similar to Laravel's `@class` directive:

```blade
<div @bs_class([
    'alert',
    'success' => !$isError, 
    'error' => $isError
])>Alert Message</div>
```

**Class Passthrough**

If a class is not registered using the `@bs_set` directive, it will be passed through directly to the generated HTML. This allows additional utility classes to be applied as required:

```blade
<div @bs_class('alert mb-2')>Alert Message</div>
```

This will produce:

```blade
<div class="p-2 border mb-2">Alert Message</div>
```

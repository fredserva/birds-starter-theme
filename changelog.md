# What's New
Changelog for the Birds Starter Theme.

### 1.0.7
<hr />

#### Updated:
- normalize.css v8.0.1

#### Changed:
- WP Title Method
- Switch from Grillade to Gridflex

#### Added:
- Enable support for a few items to enhance this new Gutenberg editor

### 1.0.6
<hr />

#### Changed:
- Switch from Spectre to Grillade

### 1.0.5
<hr />

#### Updated:
- normalize.css v5.0.0

#### Added:
- Browse Happy banner placed before the main content area that shows a 100% width alert-style dialog to users of old versions of IE
- A main.css file to add custom CSS (*css/main.css*)

#### Changed:
- Switch from Bulma to Spectre

### 1.0.4
<hr />

#### Updated:
- normalize.css v4.2.0

#### Added:
- Minimum Requirements Class
<pre>Usage: $requirements = new Minimum_Requirements( '5.3.4', '4.5', 'YOUR THEME NAME', array( 'plugin-a', 'plugin-b' ) );</pre>where <code>5.3.4</code> is the minimum PHP version required, <code>4.5</code> is the minimum WordPress version required. Plugin slugs in the array are slugs of required plugins. If you use TGM Plugin Activation or don't need extra plugins, just use <code>array()</code>
- Call to Minimum Requirements Class (**in** *functions.php*)

#### Changed:
- Some typo in the code

### 1.0.3
<hr />

#### Added:
- Basic Site Branding and Navigation (**in** *header.php*)
- Custom functions that act independently of the theme templates (*inc/extras/extras.php*)
- Function to generate Facebook OG Tags And Twitter Cards (**in** *inc/extras/extras.php*)

### 1.0.2
<hr />

#### Changed:
- DNS Prefetching in a function (**in** *inc/extras/extras.php*)

### 1.0.1
<hr />

#### Added:
- Some Cleanups (*inc/extras/cleanup.php*)
- Google Fonts Prefetch
- Google Code Prefetch
- Google Analytics Prefetch
- Gravatar Prefetch

### 1.0

- Initial release

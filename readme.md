##Setting up the Boilerplate theme for a Drupal site
Change the boilerplate_theme folder name to the name of the site you're working on:  

* boilerplate_theme  

to 

* my_theme_name  

* rename the .info file to 'your site name'
* change the name and description values

Open up template.php and rename the function name as follows:  

* boilerplate_theme_preprocess_page
would be changed to   
* my_theme_name_preprocess_page

##LESS file structue
The file structure at my_theme_name/less is inspired by the [Bootstrap][bootstrap on github] project on Github:   

* bootstrap-less folder
* theme-variables.less
* bootstrap.less
* theme.less  

The .less files we need to edit are as follows:  
* theme.less
* theme-variables.less.

theme.less will be compiled to the folder css/theme.css. We dont need to compile theme-variables.less we just need to edit and save it. As mentioned below we can override other files using Bootstrap theme customiser tools.

All the files in the bootstrap-less folder are directly copied from [Bootstrap][bootstrap on github]

##Compiling LESS using a GUI application
You will need a LESS compiler such as [Koala][koala less app] or [WinLESS][winless less app]  

Drag and drop the entire my_theme_name folder into the application.

In Koala you will want to remove the Auto compile option on:

* bootstrap.less
* theme-variables.less

This is because:  
* We dont need to edit bootstrap.less: We can override it with Bootstrap theme customiser tools available online if we want/need to.  
* We will need to edit theme-variables.less and save this file in our text editors: But we dont need to compile it as its being included in our theme.less file. If you accidently compile theme-variables.less its not a problem, you simply get a blank css file with the same name which can be deleted with out any negative impact.
* Compiling a less file: If you compile a less file a css file with the same name will be created.

##Starting out using the LESS language
To begin with, you will most likely find using Variables, Mixins and Nesting and possibly Operations easiest to work with. See this [beginners guide][less beginners guide]. A comprehensive listing can be found [here][less comprehensive listing].

##Working with the Boilerplate theme
It is designed to be minimal so that it gives the developer more freedom to choose what they want/need to do. It has a copied version of the Drupal cores' page.tpl.php (with minor modifications) and node.tpl.php.

It also has the Bootstrap parent themes' template files for common Landscape Content types.

###Regions
If no regions are defined, the theme defaults to left sidebar, right sidebar, content, header and footer. Custom regions will override the defaults.

See [default .info values][default .info values] for more information.

##For responsive migrations
One strategy would be to use the same regions that was used in the previous theme and assign the same blocks to those regions.

Then apply boostrap classes such col-xs-12 (see [getbootstrap.com][bootstrap css home page]) to page.tpl and any necessary Drupal blocks.

You could also use live browser editors such [bootstrap-live-customizer.com][bootstrap live customizer]. This tool allows you to edit variables, as well as download complete customised variables.less, theme.less and bootstrap.css.

##Useful Information
* [Drupal 6 Global variables]
* [Drupal 6 Function reference]

##Troubleshooting
If you get into a mess, you can remove all the css files from the css folder.

Compile the boostrap.less file at less/bootstrap.less. This file contains all the Bootstrap classes you need for working with the Bootstrap framework.

Compile the theme.less file at less/theme.less. This file contains all the custom theme work you have done for a site.

It is also helpful to remove the Auto compile option from your LESS GUI application as this can be confusing especially if you have just started out.

[bootstrap on github]: http://www.github.com/twbs/bootstrap/tree/master/less
[koala less app]: http.//www.koala-app.com
[winless less app]: http://www.winless.org
[less beginners guide]: http://www.ostraining.com/blog/coding/less
[less comprehensive listing]: http://www.cssauthor.com/less-tutorials/
[bootstrap css home page]: http://www.getbootstrap.com
[bootstrap live customizer]: http://www.bootstrap-live-customizer.com
[drupal 6 Global variables]: https://api.drupal.org/api/drupal/globals/6
[drupal 6 Function reference]: https://api.drupal.org/api/drupal/functions/6
[default .info values]: https://www.drupal.org/node/171206

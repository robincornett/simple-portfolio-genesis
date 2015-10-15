# Simple Portfolio for Genesis

WordPress plugin that adds a custom post type and taxonomy for portfolios.

## Description

This plugin registers a simple custom post type to add a portfolio to your WordPress site. For Genesis Framework users, it has some nice templates and functionality. It does require CMB2 to make use of custom fields, although it will work without it.

*Note: although this plugin was written with the [Genesis Framework by StudioPress](http://studiopress.com/) in mind, it is not an official plugin for this framework and is neither endorsed nor supported by StudioPress.*

## Requirements
* WordPress 3.8, tested up to 4.4
* Genesis Framework (templates and widget will not work with other themes, although post type and metaboxes will work with any theme)

## Installation

### Upload

1. Download the latest tagged archive (choose the "zip" option).
2. Go to the __Plugins -> Add New__ screen and click the __Upload__ tab.
3. Upload the zipped archive directly.
4. Go to the Plugins screen and click __Activate__.

### Manual

1. Download the latest tagged archive (choose the "zip" option).
2. Unzip the archive.
3. Copy the folder to your `/wp-content/plugins/` directory.
4. Go to the Plugins screen and click __Activate__.

Check out the Codex for more information about [installing plugins manually](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

### Git

Using git, browse to your `/wp-content/plugins/` directory and clone this repository:

`git clone git@github.com:robincornett/simple-portfolio-genesis.git`

Then go to your Plugins screen and click __Activate__.

## Frequently Asked Questions

### I notice the archive links do something unusual.

Because I have a backlog of sites to add to my own portfolio, I implemented a way to add them without having to have everything completely written up. If you create a portfolio post and it has no content, it will show in your archive, but won't be linked. If it has no content, but you do add a project link to the post, the archive will link to the project.


## Changelog

### 1.0.0
* initial releast on github

## Credits

Built by [Robin Cornett](http://robincornett.com/)

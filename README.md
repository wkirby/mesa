# Mesa: An open-source Flat CMS

## JSON Config

JSON is great, and is already being used successfully to configure options in applications like Sublime Text. Using the extension `config.json` files, we should be able to manage all settings in a very straightforward way. Similarly, we can use the JSON object to build user-friendly front-end management of settings.

## More than just a Blog

The idea is to be able to manage any kind of content, dynamically, with the flat file structure. By default, the CMS should offer two types: Posts and Pages. Fundamentally, these are no different from each other, except for organizational and display purposes.

Post types are determined by file structure. The each subdirectory in the "content" directory will be assumed to be a post type, provided it has a valid `config.json` file. Creating new content types will also be simple from the backend, as it only requires creating a directory and a `config.json` file.

To start, these settings will be simple. Most likely just a "Name" field, and possible a description. Down the line we will likely want to add functionality like "is visible to search", "hierarchical", "taxonomies", etc.

## Media Management

Uploading, viewing, and deleting images is a must, and should be relatively simple to handle. 

## Dead Simple Setup

The WordPress 5-minute install is the goal. Literally unzip, upload, done. The first visit should create the core `mesa.config` file. This is also the reason to use PHP: most web servers are already set up with PHP 5+, making anything else an unnecessary barrier to entry.

## Easy to Theme

Ghost sets a great precedent by using handlebars for creating themes. I think it's probably best to follow this example, but there are other options. The easiest is to follow the Wordpress method of providing functions for accessing theme-relevant data. The other is to roll a lightweight PHP templating engine — or use an existing library like Smarty or Twig.

## Users?

Without a DB, the question of admin login is an important one. Since we'd like to provide an actual backend, Users will be one difficulty to overcome — especially if there's a desire to support more than one user, or different user roles. My assumption is that we'll have a `users.json` file locked down with `.htaccess`, but definitely a concern.

## Meta data?

How to store metadata about a post? Should we allow a JSON object in the file that will be parsed out before display?

## Search

Good search is essential. Wordpress has long had a fatal flaw, in which it sorts search by date.

## Core Features?

Some common CMS features to wonder about: plugins, contact forms, social settings, SEO.
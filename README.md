# An example for the laravel framework package

## This Package is For Learning Purpose

# Press
An elegant markdown-powered blog for the Laravel framework.


### Installation

``` composer require sherif/press ```


### Migrate Database

Now that we have our package installed, we need to migrate the database to add the necessary tables for Press. In the command line, run the following command.

`php artisan migrate`

### Publish the package config

Up next, you need to publish the package's config file that includes some defaults for us. To publish that, run the following command.

`php artisan vendor:publish --tag=press-config`

You will now find the config file located in `/config/press.php`

### Create directory to hold posts

The last step in the installation, is to create a directory for your markdown files that Press will use to turn into your blog posts. By default, it is just a directory in the root directory of your project called `blogs`. You may change that in the config file we published in the previous step.

`mkdir blogs`

### Sample Post

To create your first post, here's a sample markdown file to get you started. Copy and paste it into a `.md` file in your blogs diretory.

```
---
title: My First Blog Post
description: This is my very first blog post with Press
---

# Extra Extra Extra!

You are now a blogger!
```

### for Custtomization

`php artisan vendor:publish --tag=press-provider`

By this you can overwrite the fields and your extra fields chech this file example [File](https://github.com/sherifnabil/press-package/blob/main/src/Fields/Body.php)

# TechteekNews

- Simple app for creating articles
- Extend [editor.js](https://editorjs.io/) library to include GIFs into articles



## Steps to run the project
- After download the project, run "composer install" command
- run "npm run dev" to run node js 
- run "php artisan migrate" to create database tables (migration file "create_articles_table" added by me)

## Project Features and Files

1. Authentication: login, logout and register
2. Article model to map articles table in database (DB name "techteek_new" is set in config/database)
3. ArticleController to implement create/show articles, with implementing "auth" middleware on creating articles to ensure adding articles from just admins who have accounts.
4.  Javascript files: 
    4.1 main.js: contains "GIFImage" class which created to extend editor js for adding GIF images into the editor.
    By implement the basic methods and add the required ones
    
    4.2 search_GIFs.js: contains "GifyProvider" class to handle the gif images provider with its constant properties
    and search request, so we can easily change these properties or add another provider 
    
5. "spatie/laravel-sluggable": laravel package is added to generate slug for articles easily

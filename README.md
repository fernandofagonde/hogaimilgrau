
## About Project
 
Project Description.

- [Project Description](link).  


## Helpers

Look to "app/Http/Helpers" to know what's available.

[Helpers.php][Common configurations and helpers]
[Html.php][Dynamic way to create html elements, form elements and others]
[Main.php][Static class with a lot of data treatment functions]

## Configuration

[Admin Sidebar][Configure on App/Http/Helpers/Helpers::adminSidebarLinks]
[App Sidebar][Configure on App/Http/Helpers/Helpers::appSidebarLinks]


## Resources

- [Sass, Javascript][Look to resources/assets/]


## Laravel Mix Global
Won't work with compilable javascript files. To combine multiple JS files in one file, look to Uglify JS below.

- [Sass and Simple JS Files, /webpack.js][npm run dev/prod --notifications]


## Sass Watch
Open terminal, go to the "resources/sass" folder and run command. After this action, all files when saved (main files or includes) will be updated.
 
[Site][sass --watch site/:../../public/assets/css/site/ --style compressed --no-source-map]
[Admin][sass --watch admin/:../../public/assets/css/admin/ --style compressed --no-source-map] 
[App][sass --watch app/:../../public/assets/css/app/ --style compressed --no-source-map]

Note: App uses the same Admin styles, but if u need to add an specific configuration use "app.scss" on "resourses/sass/app" folder


## Uglify JS
Open terminal, go to the javascript resources folder and execute the desire command.

[Admin Main JS - folder resources/js/admin][uglifyjs includes/_main.js includes/_rest.js includes/_sidebar.js includes/_forms.js includes/_modal.js includes/_notification.js includes/dom.js --compress --mangle --output ../../../public/assets/js/admin/main.min.js]

[App Main JS - folder resources/js/app][uglifyjs includes/_main.js includes/_rest.js includes/_sidebar.js includes/_forms.js includes/_modal.js includes/_notification.js includes/_uploader.js includes/dom.js --compress --mangle --output ../../../public/assets/js/app/main.min.js]

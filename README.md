## Roofing Calculator (Current: Laravel 8.*) 

### Demo Credentials

**Application Admin:** landlord@test.com  
**Password:** secret

**Tenant Admin:** tenant_admin@test.com  
**Password:** secret

**Manager:** manager@test.com  
**Password:** secret

**Staff:** staff@test.com  
**Password:** secret

**User:** user@test.com  
**Password:** secret

### Installation instructions
> make a copy of **.env.example** as **.env** and fill the database info

    composer install
    npm install
    php artisan migrate:refresh --seed
    npm run dev
    php artisan storage:link
    vendor\bin\phpunit


### Resources

1. CoreUI Icon library: https://icons.coreui.io/icons/
2. FontAwesome Icon library: https://fontawesome.com/
3. Chart plugin: https://www.chartjs.org/
4. MarkDown syntax: https://www.markdownguide.org/basic-syntax
5. MarkDown (BitBucket) syntax: https://bitbucket.org/tutorials/markdowndemo/src/master/
6. API Documentation: https://scribe.readthedocs.io/en/latest/guide-getting-started.html
7. [PWA](https://github.com/silviolleite/laravel-pwa)
8. [FavIcon](https://favicon.io)

### Introduction

This template provides you with a massive head start on any size web application. Out of the box it has features like a backend built on CoreUI with Spatie/Permission authorization. It has a frontend scaffold built on Bootstrap 4. Other features such as Two Factor Authentication, User/Role management, searchable/sortable tables built on my [Laravel Livewire tables plugin](https://github.com/rappasoft/laravel-livewire-tables), user impersonation, timezone support, multi-lingual support with 20+ built in languages, demo mode, and much more.

### Features
- API login
- Permisstion system (Books)
- [CSV seeder import]()
- Role based menu
- Markdown email
- Date range plugin (Book > List)
- Typeahead: autocomplete, drop-down (Book > List)
- List/grid view (Book > View)
- CSV import with temp/preview table

### ToDo
- [Demo mode](https://github.com/spatie/laravel-demo-mode)
- Logo resize for mobile
- Filters for Author list
- View icon for Author list
- Custom user CRUD
- API sample
- User settings
- Tenant/Company/System settings
- CSV/PDF export (https://wynnt3o.medium.com/laravel-8-export-data-to-excel-and-pdf-using-datatables-6adaa68415d4)
- Login page expire timeout (pop-up to login again?)(https://www.codeproject.com/Tips/1175658/Session-Expiration-Popup)
- [Image upload preview](https://medium.com/@iamcodefoxx/how-to-upload-and-preview-an-image-with-javascript-749b92711b91)
- [Tag system](https://github.com/rtconner/laravel-tagging)
- Smart search, typeahead drop-down with tags (https://www.cssscript.com/multi-select-autocomplete-selectpure/)
- For dashboard notes, todo, wizard, buttons, invoice, table export to CSV/PDF: (https://colorlib.com/polygon/gentelella)
- FlatPicker for date/time (https://flatpickr.js.org/)
- RTF editor with image upload support (https://unisharp.github.io/laravel-filemanager/installation)

> Updated : 3rd Jan, 2022 by Azmeer


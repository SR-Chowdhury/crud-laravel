<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# CRUD Larave v1.0

## First Setup Database
> DB name: crud_laravel
> 
> Imort table from `public/assets/v1.0/db_&_read-me/crud_laravel.sql`
> 

* URL: http://localhost/crud-laravel/crud-v1

**Must include toastr_scripts & toastr_styles in dashboad.blade.php**

**N.B. Using Pagination must include - in `app/Providers/AppServiceProvider.php **

    Line 6: use Illuminate\Pagination\Paginator;
    
    public function boot()
    {
        Line 27: Paginator::useBootstrap();
    }

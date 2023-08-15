
# Barangay System

Barangay System made with Filament.

## About Filament

<p align="center">
    <img src="https://github.com/filamentphp/filament/assets/41773797/8d5a0b12-4643-4b5c-964a-56f0db91b90a" alt="Banner" style="width: 100%; max-width: 800px;" />
</p>

<p align="center">
    <a href="https://filamentphp.com"><img alt="Filament v3.x" src="https://img.shields.io/badge/Filament-v3.x-f59e0b?style=for-the-badge"></a>
    <a href="https://laravel.com"><img alt="Laravel v10.x" src="https://img.shields.io/badge/Laravel-v10.x-FF2D20?style=for-the-badge&logo=laravel"></a>
    <a href="https://livewire.laravel.com"><img alt="Livewire v3.x" src="https://img.shields.io/badge/Livewire-v3.x-FB70A9?style=for-the-badge"></a>
    <a href="https://php.net"><img alt="PHP 8.1" src="https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php"></a>
</p>

Filament is a collection of full-stack components for accelerated Laravel development. They are beautifully designed, intuitive to use, and fully extensible - the perfect starting point for your next Laravel app. Why waste time building the same features over and over again?

## To do

setup:

- [x] create laravel project
- [x] set minimum stability to "dev"
- [x] composer require livewire/livewire "^3.0@beta"
- [x] composer require filament/filament:"^3.0-stable" -W
- [x] php artisan filament:install --panels
- [x] php artisan make:filament-user
- [x] change app name (logo.blade.php)

barangay keys:

- [ ] php artisan make:model BarangayKey -mf
- [ ] schema
- [ ] model
- [ ] factory
- [ ] filament resource
- [ ] filament form
- [ ] filament table

barangays:

- [ ] php artisan make:model Barangay -mf
- [ ] schema
  - [ ] barangay key id
  - [ ] region code
  - [ ] region name
  - [ ] city or municipality
  - [ ] barangay code
  - [ ] barangay name
- [ ] model
- [ ] factory
- [ ] filament resource
- [ ] filament form
- [ ] filament table

household keys:

- [ ] php artisan make:model HouseholdKey -mf
- [ ] schema
- [ ] model
- [ ] factory
- [ ] filament resource
- [ ] filament form
- [ ] filament table

households:

- [ ] php artisan make:model Household -mf
- [ ] schema
  - [ ] household key id
  - [ ] household number
  - [ ] barangay id
- [ ] model
- [ ] factory
- [ ] filament resource
- [ ] filament form
- [ ] filament table

resident keys:

- [ ] php artisan make:model Resident -mf
- [ ] schema
- [ ] model
- [ ] factory
- [ ] filament resource
- [ ] filament form
- [ ] filament table

residents:

- [ ] php artisan make:model Residents -mf
- [ ] schema
  - [ ] resident key id
  - [ ] household id
  - [ ] last name
  - [ ] first name
  - [ ] middle name
  - [ ] name extension
  - [ ] birth place
  - [ ] birth date
  - [ ] sex
  - [ ] civil status
  - [ ] citizenship
  - [ ] occupation
  - [ ] house number
  - [ ] address id
  - [ ] accomplished at
  - [ ] accomplished by
  - [ ] attested by
  - [ ] left thumbmark
  - [ ] right thumbmark
- [ ] model
- [ ] factory
- [ ] filament resource
- [ ] filament form
- [ ] filament table

birth places:

- [ ] schema
  - [ ] city or municipality
  - [ ] province

addressses

- [ ] php artisan make:model Residents -mf
- [ ] schema
  - [ ] barangay id
  - [ ] street
  - [ ] area

requests:

- [ ] todo

officials:

- [ ] php artisan make:model BarangayOfficial -mf

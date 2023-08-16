
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

## Dev environments

### dev1

- database: barangay-system-dev1
- branch: dev1
- description: resources are based on entity keys

#### User flow

- barangays
  - list barangay.latest_record
    - actions
      - create barangay.records
    - widgets
      - count barangays
    - table
      - row actions
        - edit barangay.records
  - create barangay.records
    - actions
      - new barangay.records
      - cancel
  - edit barangay.records
    - list barangay.records
      - actions
        - create barangay.records
        - edit barangay.records
        - delete barangay.records
    - delete barangay and all related records

#### Tasks

- [ ] git branch
- [ ] database name
- [x] migrations
- [x] models
- [ ] 

<hr>

### dev2

- database: barangay-system-dev2
- branch: dev2
- description: resources are based on entity records

#### User flow



#### Tasks




<!-- 


## To do

setup:

- [x] create laravel project
- [x] set minimum stability to "dev"
- [x] composer require livewire/livewire "^3.0@beta"
- [x] composer require filament/filament:"^3.0-stable" -W
- [x] php artisan filament:install --panels
- [x] php artisan make:filament-user
- [x] change app name (logo.blade.php)

barangays:

- [x] php artisan make:model Barangay -mf
- [ ] model 
  - [x] records(): $this->hasMany(BarangayRecord::class)
  - [x] atestRecord(): $this->records()->one()->ofMany()
  - [x] searchRecords($query, $columns, $search)
- [ ] filament
  - [x] php artisan make:filament-resource Barangay
  - [x] list table // references barangay_records
  - [x] php artisan make:filament-relation-manager BarangayResource records long_name --soft-deletes
  - [x] create // show/create 1 record
  - [x] edit // show/edit many records
  - [x] relation manager

barangay records:

- [x] php artisan make:model BarangayRecord -mf
- [ ] schema
  - [x] barangay id
  - [x] region code
  - [x] region name
  - [x] city or municipality
  - [x] short name //abbreviation/short name
  - [x] long name //complete name
- [ ] model
  - [x] protected $fillable
  - [x] barangay(): $this->belongsTo(Barangay::class);
- [x] filament resource
- [ ] menu label
- [ ] filament
  - [x] php artisan make:filament-resource BarangayRecord
- [ ] factory

households:

- [x] php artisan make:model Household -mf
- [x] schema
- [ ] model
  - [x] records(): $this->hasMany(HouseholdRecord::class)
  - [x] latestRecord(): $this->records()->one()->ofMany()
  - [x] searchRecords($query, $columns, $search)
- [ ] filament
  - [x] php artisan make:filament-resource Household
  - [x] php artisan make:filament-relation-manager HouseholdResource records number
  - [x] list table
  - [x] create // barangay dropdown, single record
  - [x] edit // barangay dropdown, multiple records
  - [ ] php artisan make:filament-relation-manager HouseholdResource resident_records 
- [ ] factory

household records:

- [x] php artisan make:model Household -mf
- [ ] schema
  - [x] barangay record id
  - [x] household id
  - [x] number
- [ ] model
  - [x] protected $fillable
  - [x] household(): $this->belongsTo(Household::class)
- [ ] factory
- [ ] filament
  - [x] php artisan make:filament-resource HouseholdRecord

residents:

- [x] php artisan make:model Resident -mf
- [x] schema
- [ ] model
  - [x] records(): $this->hasMany(HouseholdRecord::class)
  - [x] latestRecord(): $this->records()->one()->ofMany()
- [ ] filament
  - [x] php artisan make:filament-resource Resident
  - [ ] php artisan make:filament-relation-manager ResidentResource resident_records 
  - [ ] list table
  - [ ] create
  - [ ] edit
- [ ] factory

resident records:

- [x] php artisan make:model ResidentRecord -mf
- [ ] schema
  - [x] resident key id
  - [x] household id
  - [x] last name
  - [x] first name
  - [x] middle name
  - [x] name extension
  - [x] birth place
  - [x] birth date
  - [x] sex
  - [x] civil status
  - [x] citizenship
  - [x] occupation
  - [x] house number
  - [x] address id
  - [x] accomplished at
  - [x] accomplished by
  - [x] attested by
  - [x] left thumbmark
    - [x] right thumbmark
- [ ] model
  - [x] protected $fillable
  - [x] residence(): $this->belongsTo(Residence::class)
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
  - [ ] street
  - [ ] area

requests:

- [ ] todo

officials:

- [ ] php artisan make:model BarangayOfficial -mf

 -->
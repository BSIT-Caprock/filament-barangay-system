<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('region_code');
            $table->string('region_name');
            $table->string('province');
            $table->string('municipality_or_city');
            $table->string('barangay_name');
            $table->timestamps();
        });
        
        //pre-populate addresses
        $region_code = 'VIII';
        $region_name = 'Eastern Visayas';
        $province = 'Leyte';
        $municipality_or_city = 'Barugo';
        $barangays = [
            'Abango',
            'Amahit',
            'Balire',
            'Balud',
            'Bukid',
            'Bulod',
            'Busay',
            'Cabarasan',
            'Cabolo-an',
            'Calingcaguing',
            'Can-isak',
            'Canomantag',
            'Cuta',
            'Domogdog',
            'Duka',
            'Guindaohan',
            'Hiagsam',
            'Hilaba',
            'Hinugayan',
            'Ibag',
            'Minuhang',
            'Minuswang',
            'Pikas',
            'Pitogo',
            'Poblacion Dist. I',
            'Poblacion Dist. II',
            'Poblacion Dist. III',
            'Poblacion Dist. IV',
            'Poblacion Dist. V',
            'Poblacion Dist. VI',
            'Pongso',
            'Roosevelt',
            'San Isidro',
            'San Roque',
            'Santa Rosa',
            'Santarin',
            'Tutug-an',
        ];

        $new_rows = array_map(
            fn ($x) => [
                'region_code' => $region_code,
                'region_name' => $region_name,
                'province' => $province,
                'municipality_or_city' => $municipality_or_city,
                'barangay_name' => $x,
            ], $barangays
        );

        DB::table('barangays')->insert($new_rows);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangays');
    }
};

 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->index();
            $table->string('fullname');
            $table->string('shop_name');
            $table->string('location');
            $table->mediumText('description');
            $table->boolean('certification')->default(false);
            $table->string('contact');
            $table->string('email');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}



// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class CreateProductsTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('products', function (Blueprint $table) {
//             $table->id();
//             $table->string('productId');
//             $table->string('store_id');
//             $table->string('name');
//             $table->mediumText('description');
//             $table->string('catigory');
//             $table->integer('stock')->unsigned();
//             $table->decimal('price', 5, 2)->nullable()->default(0.00);
//             $table->string('image');
//             $table->string('texture');
//             $table->string('size');
//             $table->string('location');
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('products');
//     }
// }


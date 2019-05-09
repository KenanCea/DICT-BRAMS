<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessClearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();  
        Schema::create('business_clearances', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('control_no');
            $table->string('business_address');
            $table->string('business_trade_name');
            $table->enum('business_application', ['new', 'renewal']);
            $table->enum('kind_business',['Agriculture','Construction','Electricity/gas and water','wholesale retail, and trade','Transport, storage communications', 'Community Social and personal services', 'Financing Insurance','Real States', 'Manufacturing', 'Mining']);
            $table->enum('line_of_business',['Poultry/Livestock','Nurseries/Flower Growing','Breeding Stations','Fishponds/Fishpens','Vineyards/Mussel Farms','Orchards/Vineyards','Vegetable Farms','Supermarkets','Groceries/Dry Goods Stores','Sari-sari Stores','Banks and Financial/Lending Institutions','Auto Supply and Motorports','Distributors, Dealers of Various Products',
            'Gasoline stations','Photo and Record Shops','Jewelry Stores','Pawnshops','General Services/Contractors','Beauty Parlors or Barber shops','Fitness Gyms','Restaurants','Insurance/Dealer in Securities','Furniture Shops','Livestock and Poultry Supplyes Stores','Hardware/Electric Supplies','Videoke Shops','Computer Shops/Internet Cafe','Buy and Sell Stations','Water Refilling Stations',
            'Hotel/Inns','Apartment/Boarding House','Handicraft','Metalcraft','Garments','Ceramics','Food Processing','Mining and Quarrying','Factories','Rice/Corn/Flour/Saw Mills','Junkshops']);
            $table->enum('action_taken', ['approval', 'disapproval']);
            $table->string('reasons_approv_disapprove');
            $table->date('date_issued');
            $table->integer('ctc_no');
            $table->date('ctc_issued_on');
            $table->string('ctc_issued_at');
            $table->integer('official_receipt_no');
            $table->date('date_OfficialReceipt');
            $table->double('total_amt_paid', 5);
            $table->timestamps();
            $table->integer('inhabitant_id')->unsigned();
            $table->foreign('inhabitant_id')->references('id')->on('inhabitants')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_clearances');
    }
}

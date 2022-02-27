<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateRepportsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'repports';
    /**
     * Run the migrations.
     * @table repports
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('lat', 45)->nullable();
            $table->string('long', 45)->nullable();
            $table->boolean('solved')->default(false);
            $table->timestamps();
            $table->unsignedBigInteger('problems_id');

            $table->index(["problems_id"], 'fk_repports_problems_idx');


            $table->foreign('problems_id', 'fk_repports_problems_idx')
                ->references('id')->on('problems')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}

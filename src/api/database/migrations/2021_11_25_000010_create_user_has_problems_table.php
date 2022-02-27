<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUserHasProblemsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_has_problems';
    /**
     * Run the migrations.
     * @table deppartments_has_problems
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('problem_id');
            $table->timestamps();

            $table->index(["problem_id"], 'fk_users_has_problems_problems1_idx');

            $table->index(["user_id"], 'fk_users_has_problems_users1_idx');


            $table->foreign('user_id', 'fk_users_has_problems_users1_idx')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('problem_id', 'fk_users_has_problems_problems1_idx')
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

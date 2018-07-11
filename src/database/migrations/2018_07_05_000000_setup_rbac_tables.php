<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupRbacTables extends Migration
{

    private $prefix;

    public function __construct()
    {
        $this->prefix = env('DB_PREFIX', '');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createRoles();
        $this->createRoleUser();
        $this->createPermissions();
        $this->createPermissionRole();

    }

    private function createRoles()
    {
        Schema::create("{$this->prefix}roles", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name", 100)->unique();
            $table->string("title");
            $table->string("description")->nullable();
            $table->timestamps();
        });
    }

    private function createRoleUser()
    {
        Schema::create("{$this->prefix}role_user", function (Blueprint $table) {

            $table->unsignedInteger("user_id");
            $table->unsignedInteger("role_id");

            $table
                ->foreign("user_id")
                ->references("id")
                ->on("{$this->prefix}users")
                ->onUpdate("cascade")
                ->onDelete("cascade");

            $table
                ->foreign("role_id")
                ->references("id")
                ->on("{$this->prefix}roles")
                ->onUpdate("cascade")
                ->onDelete("cascade");

            $table->primary(["user_id", "role_id"]);
        });
    }

    private function createPermissions()
    {
        Schema::create("{$this->prefix}permissions", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name", 100)->unique();
            $table->string("title");
            $table->string("description")->nullable();
            $table->timestamps();
        });
    }

    private function createPermissionRole()
    {
        Schema::create("{$this->prefix}permission_role", function (Blueprint $table) {

            $table->unsignedInteger("permission_id");
            $table->unsignedInteger("role_id");
            $table
                ->foreign("permission_id")
                ->references("id")
                ->on("{$this->prefix}permissions")
                ->onUpdate("cascade")
                ->onDelete("cascade");

            $table
                ->foreign("role_id")
                ->references("id")
                ->on("{$this->prefix}roles")
                ->onUpdate("cascade")
                ->onDelete("cascade");


            $table->primary(["permission_id", "role_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("{$this->prefix}permission_role");
        Schema::dropIfExists("{$this->prefix}permissions");
        Schema::dropIfExists("{$this->prefix}role_user");
        Schema::dropIfExists("{$this->prefix}roles");

    }

}

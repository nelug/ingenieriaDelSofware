<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
	         $table->string('username', 15)->unique();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 100)->unique();
            $table->tinyInteger('status')->default(2);
            $table->string('password', 100);
            $table->string('remember_token')->nullable();
				//$table->timestamp("created_at")->default('')->nullable();
				//$table->timestamp("updated_at")->default('')->nullable();
		});


	/*	$user = new User;
		$user->id = 1;
		$user->username = 'admin';
		$user->nombre = 'admin';
		$user->apellido = 'system';
		$user->email = 'admin@sistem.com';
		$user->status = 1;
		$user->password = 'admin';
		$user->save();
*/
	}

	public function down()
	{
		Schema::drop('users');
	}

}

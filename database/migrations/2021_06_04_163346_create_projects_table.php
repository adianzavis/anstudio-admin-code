<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration {

	public function up() {
		Schema::create('projects', function (Blueprint $table) {
			$table->id();

			$table->string('name');
			$table->string('summary');
			$table->longText('total_description');
			$table->string('image');

			//Detail data
			$table->string('web')->nullable();
			$table->string('instagram')->nullable();
			$table->string('facebook')->nullable();
			$table->string('google_disk')->nullable();

			//Page data
			$table->longText('site_content');
			$table->boolean('public')->default(0);
			$table->boolean('public_author')->default(0);
			$table->string('title')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('meta_keywords')->nullable();

			//Social media
			$table->string('og_title')->nullable();
			$table->string('og_site_name')->nullable();
			$table->string('og_description')->nullable();
			$table->string('og_image')->nullable();

			$table->string('status')->nullable()->constrained('project_statuses');
			$table->foreignId('customer_id')->nullable()->constrained('customers');

			$table->timestamps();
		});
	}

	public function down() {
		Schema::dropIfExists('projects');
	}
}

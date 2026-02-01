<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('title');            // عنوان الورشة
            $table->string('category');         // التخصص (Frontend, Backend, etc)
            $table->string('date');             // التاريخ (نتركه string ليسهل عليكِ إدخاله)
            $table->string('type')->default('workshop'); // نوعه: workshop أو post

            // الحقول الأساسية للمحتوى
            $table->longText('content');        // نص الورشة أو المقال الطويل

            // حقول إضافية (اختيارية) - جعلناها nullable عشان لو ما ضفتيها الورشة تنحفظ عادي
            $table->text('code_snippet')->nullable(); // مكان لوضع كود برمجي كمثال
            $table->string('image_url')->nullable();   // رابط صورة توضيحية
            $table->string('video_url')->nullable();   // رابط فيديو يوتيوب (الـ ID فقط)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};

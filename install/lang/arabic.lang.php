<?php

// charset
define('NAV_WELCOME', "أهلاً!");
define('NAV_CHECK', "تحقق");
define('NAV_DETAILS', "معلومات");
define('NAV_INSTALL', "تنصيب");
define('NAV_DONE', "انتهى");

define('ERROR_CANNOT_INSTALL', "لا يمكن تنصيب المجلة لأسباب أمنية");

// Date conversion class
define('STEP0_FORM', "<br><br><form action='index.php' method='get'><select name='lang'><option value='arabic'>عربي</option><option value='english'>English</option></select> <input type='submit' value='ارسل' name='submit'>");
define('MAIN_PAGE_TITLE', "معالج تنصيب المجلة السهلة");
define('MAIN_TITLE', "معالج تنصيب المجلة السهلة");
define('STEP0_TEXT', "أهلا بك إلى معالج تنصيب المجلة السهلة الإصدارة 1.1<br><br>سوف يقوم المعالج بتنفيذ الخطوات المطلوبة لتنصيب المجلة السهلة<br><br>اضغط على التالي للبدأ بالتنصيب أو اختر اللغة من القائمة في الاسفل<br>". STEP0_FORM);
define('STEP_NEXT', "التالي");
define('STEP1_TEXT', "يتم التحقق من متطلبات الخادم:");
define('STEP1_CHMOD_UPLOAD_SUCCESS', "المجلد upload يحمل التصريح المطلوب");
define('STEP1_CHMOD_UPLOAD_FAIL', "الرجاء تغيير تصريح المجلد upload  إلى التصريح 777");
define('STEP1_PHP_SUCCESS', "نسخة الـ PHP متوافقة مع المجلة");
define('STEP1_PHP_FAIL', "نسخة الـ PHP  غير متوافقة مع المجلة ويستحسن استعمال نسخة أحدث من 5.0");
define('STEP1_ZIP_SUCCESS', "الخادم يحتوي على مكتبة ZIP");
define('STEP1_ZIP_FAIL', "الخادم لا يتضمن مكتبة ZIP. الرجاء القيام بتنصيبها.");
define('STEP1_MEMORY_SUCCESS', "حجم الذاكرة المسموحة أكثر من 64MB.");
define('STEP1_MEMORY_FAIL', "حجم الذاكرة المسموحة أقل من 64 MB. الرجاء القيام بزيادة الذاكرة المسموحة للموقع.");

define('STEP2_DETAILS_DATABASE_TITLE', "معلومات قاعدة البيانات");
define('STEP2_DETAILS_DATABASE_SERVER', "سيرفر قاعدة البيانات");
define('STEP2_DETAILS_DATABASE_NAME', "اسم قاعدة البيانات");
define('STEP2_DETAILS_DATABASE_USER', "مستخدم قاعدة البيانات");
define('STEP2_DETAILS_DATABASE_PASSWORD', "كلمة سر قاعدة البيانات");

define('STEP2_DETAILS_FOLDER', "معلومات الموقع");
define('STEP2_DETAILS_FOLDER_PATH', "مسار مجلد الموقع");
define('STEP2_DETAILS_FOLDER_UPLOAD_PATH', "مسار مجلد upload");
define('STEP2_DETAILS_FOLDER_SITE_LINK', "مسار الموقع");
define('STEP2_DETAILS_FOLDER_SITE_TITLE', "عنوان الموقع");
define('STEP2_DETAILS_FOLDER_SITE_EMAIL', "بريد الموقع");

define('STEP2_DETAILS_COOKIES', "معلومات الكوكيز");
define('STEP2_DETAILS_COOKIES_TITLE', "اسم الكوكيز");
define('STEP2_DETAILS_COOKIES_DOMAIN', "مسار الكوكيز");

define('STEP2_DETAILS_ADMIN', "معلومات مدير الموقع");
define('STEP2_DETAILS_ADMIN_USERNAME', "اسم المستخدم");
define('STEP2_DETAILS_ADMIN_PASSWORD', "كلمة السر");


define('STEP3_TEXT_SERVER_FAIL', "لم يستطع المعالج الاتصال بالسيرفر<br>الرجاء التأكد من معلومات قاعدة البيانات<br><a href='index.php?step=2&lang=$lang'><br>عد إلى الخطوة السابقة</a>");
define('STEP3_TEXT_DATABASE_FAIL', "لم يستطع المعالج من الاتصال بقاعدة البيانات<br>الرجاء التأكد من معلومات قاعدة البيانات<br><a href='index.php?step=2&lang=$lang'><br>عد إلى الخطوة السابقة</a>");
define('STEP3_TEXT_FILL_FIELDS', "الرجاء العودة وملأ حقلي اسم المدير وكلمة المرور<br><a href='index.php?step=2&lang=$lang'><br>عد إلى الخطوة السابقة</a>");
define('STEP3_TEXT_MYSQL_ERRORS', "حصلت بعض الأخطاء أثناء التنصيب: ");
define('STEP3_TEXT_MYSQL_SUCCESS', "تم تركيب الجداول في قاعدة البيانات بنجاح");
define('STEP3_TEXT_CONF_SUCCESS', "تمت كتابة ملف الاعدادات بنجاح<br>الرجاء تحويل ترخصيه إلى 644 أو 444 من اجل حماية أفضل");
define('STEP3_TEXT_CONF_FAIL', "ضع هذا النص في ملف admin/conf.php <br>");
define('STEP3_TEXT_LOCK_CREATED', "تم إنشاء ملف الحماية بنجاح.<br>الرجاء حذف مجلد install بالكامل من الموقع");
define('STEP3_TEXT_LOCK_NOT_CREATED', "لم يتمكن المعالج من إنشاء ملف الحماية<br>الرجاء حذف مجلد install بالكامل من الموقع");


?>

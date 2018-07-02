<?php

// charset
define('_CHARSET', "utf-8");

// Date conversion class
define('DAY_MONDAY', "الاثنين");
define('DAY_TUESDAY', "الثلاثاء");
define('DAY_WEDNESDAY', "الأربعاء");
define('DAY_THURSDAY', "الخميس");
define('DAY_FRIDAY', "الجمعة");
define('DAY_SATURDAY', "السبت");
define('DAY_SUNDAY', "الأحد");

define('HIJRI_MONTH_MUHARRAM', "محرم");
define('HIJRI_MONTH_SAFAR', "صفر");
define('HIJRI_MONTH_RABI_AL-AWWAL', "ربيع الأول");
define('HIJRI_MONTH_RABI_AL-THANI', "ربيع الثاني");
define('HIJRI_MONTH_JUMADA_AL-AWWAL', "جمادى الأول");
define('HIJRI_MONTH_JUMADA_AL-THANI', "جمادى الثاني");
define('HIJRI_MONTH_RAJAB', "رجب");
define('HIJRI_MONTH_SHAABAN', "شعبان");
define('HIJRI_MONTH_RAMADAN', "رمضان");
define('HIJRI_MONTH_SHAWWAL', "شوّال");
define('HIJRI_MONTH_DHU_AL-QIDAH', "ذو القعدة");
define('HIJRI_MONTH_DHU_AL-HIJJAH', "ذو الحجة");


define('MONTH_JANUARY', "كانون الثاني");
define('MONTH_FEBRUARY', "شباط");
define('MONTH_MARCH', "آذار");
define('MONTH_APRIL', "نيسان");
define('MONTH_MAY', "آيار");
define('MONTH_JUNE', "حزيران");
define('MONTH_JULY', "تموز");
define('MONTH_AUGUST', "آب");
define('MONTH_SEPTEMBER', "أيلول");
define('MONTH_OCTOBER', "تشرين الأول");
define('MONTH_NOVEMBER', "تشرين الثاني");
define('MONTH_DECEMBER', "كانون الأول");

define('TIME_AM', "صياحاً");
define('TIME_PM', "مساءً");

// global lang
define("LANG_ERROR_VALIDATE", "فضلاً تحقق أنك قد كتبت الحقول المطلوبة  <br> والموضحة بهذه الإشارة ( <font color=\"#FF0000\">*</font> )");
define("LANG_ERROR_ADD_DB", "حصل خطأ أثناء الإضافة إلى قاعدة البيانات، الرجاء المحاولة مرة أخرى في وقت لاحق");
define("LANG_TITLE_ERROR", "حصل خطأ");
define("LANG_MODULE_NOT_FOUND", "الموديل %s غير موجود");
define("LANG_MODULE_FILE_NOT_FOUND", "الملف %s غير موجود");


define("LANG_TITLE_LOG_IN", "Log in page");
define("LANG_ERROR_WAIT_SECONDS", "You have to wait a few seconds before adding another post");

define("LANG_FORM_ADD_BUTTON","أضف");
define("LANG_FORM_SUBMIT_BUTTON","أرسل");
define("LANG_FORM_EDIT_BUTTON","تحرير");
define("LANG_FORM_DELETE_POST","حذف المشاركة؟");
define("LANG_FORM_TEXTAREA_LENGTH","يجب أن يكون النص أقل من");
define("LANG_FORM_TEXTAREA_CHARCHTERS","حرف");
define("LANG_FORM_TEXTAREA_REMAIN","المتبقي: ");
define("FORM_BBCODE_SIZE","الحجم");
define("FORM_BBCODE_ALIGN","الاتجاه");
define("FORM_BBCODE_ALIGN_JUSTIFY","كشيدة");
define("FORM_BBCODE_ALIGN_LEFT","يسار");
define("FORM_BBCODE_ALIGN_RIGHT","يمين");
define("FORM_BBCODE_ALIGN_CENTER","وسط");
define("FORM_BBCODE_COLOR","اللون");
define("FORM_BBCODE_COLOR_RED","الأحمر");
define("FORM_BBCODE_COLOR_ORANGE","البرتقالي");
define("FORM_BBCODE_COLOR_YELLOW","الأصفر");
define("FORM_BBCODE_COLOR_LIME","الليموني");
define("FORM_BBCODE_COLOR_GREEN","الأخضر");
define("FORM_BBCODE_COLOR_CYAN","سماوي");
define("FORM_BBCODE_COLOR_BLUE","أزرق");
define("FORM_BBCODE_COLOR_INDIGO","نيلي");
define("FORM_BBCODE_COLOR_VIOLT","بنفجسي");
define("FORM_BBCODE_COLOR_MAGENTA","أرجواني");
define("LANG_YES","نعم");
define("LANG_NO","لا");
define("LANG_EDIT_UPLOAD_REPLACE_ATTACHMENT","استبدل المرفقات");
define("LANG_EDIT_UPLOAD_DELETE_ATTACHMENT","احذف الملف المرفق");
define("LANG_EDIT_UPLOAD_UPLOAD_NEW","ارفق ملفاً");
define("LANG_EDIT_UPLOAD_ADD_EXTRA","ارفق ملفات أضافية");
define("LANG_CONTROL_PANEL","لوحة التحكم");


define("ERROR_FILL_REQUIRED_FIELDS","<li>أملأ الحقول المطلوبة</li>");
define("ERROR_MAXIMUM_EXCEEDED","<li>النص تجاوز الحد المسموح به من الأحرف</li>");
define("ERROR_UPLOAD_NOT_ALLOWED_FILE","<li>الملف <b>%s</b> غير مسموح برفعه على هذا الموقع</li>");
define("ERROR_UPLOAD_ALLOWED_EXTENSIONS","<li>اللواحق المسموحة برفعها هي<b>%s</b></li>");
define("ERROR_UPLOAD_SEREVER_MAX_SIZE","<li>إعدادات الخادم لا تسمح بحجم أكبر من %s للملف المرفق</li>");
define("ERROR_UPLOAD_FILE_MAX_SIZE","<li>مجموع حجم الملفات المرفوعة لا يمكن أن تتجاوز %s KB</li>");
define("ERROR_UPLOAD_IMAGE_MAX_WIDTH","<li>عرض الصورة <b>%s</b> يجب أن لا يتجاوز %s بكسل</li>");
define("ERROR_UPLOAD_IMAGE_MAX_HEIGHT","<li>ارتفاع الصورة <b>%s</b> يجب أن لا يتجاوز %s بكسل</li>");

define("LANG_ERROR_URL", "هناك خطأ في المعرف %s");
define("LANG_INFO_POST_APPROVED", "تم نشر المشاركة");
define("LANG_INFO_POST_PENDING", "شكراً للنشر. سوف تنشر المشاركة بعد الموافقة عليها من قبل مدير الموقع");
$common = array('من', 'الى', 'عن', 'على', 'أو', 'او', 'عليه', 'اليه', 'منه' );

?>
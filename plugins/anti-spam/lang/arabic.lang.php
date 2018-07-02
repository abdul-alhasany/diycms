<?php
/*
+===============================================================================+
|      					DIY-CMS V1.1 Copyright © 2011   						|
|   	--------------------------------------------------------------   		|
|                    				BY                    						|
|              				ABDUL KAHHAR AL-HASANY            					|
|   																	   		|
|      					Web: http://www.diy-cms.com      						|
|   	--------------------------------------------------------------   		|
|	This file is part of DiY-CMS.												|
|   DiY-CMS is free software: you can redistribute it and/or modify				|
|   it under the terms of the GNU General Public License as published by		|
|   the Free Software Foundation, either version 3 of the License, or			|
|   (at your option) any later version.											|
|   DiY-CMS is distributed in the hope that it will be useful,					|
|   but WITHOUT ANY WARRANTY; without even the implied warranty of				|
|   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the				|
|   GNU General Public License for more details.								|
|   You should have received a copy of the GNU General Public License			|
|   along with DiY-CMS.  If not, see <http://www.gnu.org/licenses/>.			|
+===============================================================================+
*/


$admin_plugin_lang = array(
'title'  => "مانع السبام",
'version'  => "1.0",
'author'  => "Khr2003",
'desc'  => "يمنع السبام من خلال إضافة حقل لكافة النماذج في الموقع",

'INSTALL_PLUGIN' => "تنصيب إضافة مانع السبام 1.0",
'QUERY_ERROR' => "خطأ في قواعد البيانات: في الاستعلام رقم. بسبب:. ",
'QUERY_TEXT' => "الاستعلام",
'SETUP_DONE_ERROR' => "تم الانتهاء من التنصيب بنجاح. في حال واجهت مشكلة الرجاء التوجه إلى منتديات الدعم الفني.",
'SETUP_DONE' => "تم انهاء التنصيب بنجاح.",
'BACK_TO_MAIN' => "عد إلى صفحة الإضافات.",

'UNINSTALL_MOUDLE' => "حذف إضافة مانع السبام 1.0",
'UNINSTALL_CONFIRM' => "هل أنت متأكد من حذف هذا الإضافة؟ سوف يتم حذف جميع المعلومات المتعلقة به، كالمشاركات، والتعليقات، والبلوكات وأي شيء آخر.",
'UNINSTALL_DONE_ERROR' => "تم حذف الإضافة بنجاح. حصلت بعض الأخطاء. الرجاء مراجعة الدعم الفني لتفاديها.",
'UNINSTALL_DONE' => "تم حذف الإضافة بنجاح",

'GENERAL_SETTINGS' => "الإعدادات العامة",
'PERMISSIONS' => 'التصاريح',
'PROTECTION_TYPE' => "نوع الحماية",
'protection_type' => array ('calc' => 'عمليات حسابية', 'word' => 'الكلمة المفقودة'),
'SENTENCES' => "الجمل التي سوف تستعمل لخيار الكلمة المفقودة",
'CALCULATION_TYPES' => "أنواع العمليات الحسابية",
'calculation_types' => array('addition' => 'الجمع', 'subtraction' => 'الطرح', 'multiply' => 'الضرب','division' => 'القسمة'),
'NUMBER_RANGE' => "نطاق الأرقام<br>افصل بين الأرقام بعلامة '-'",
);


$antispam_lang = array( 
'ANTISPAM_CALCULATIONS_MULTIPLICATIONS' => "ما هو حاصل %d * %d ؟",
'ANTISPAM_CALCULATIONS_ADDITIONS' => "ما هو حاصل %d + %d ؟",
'ANTISPAM_CALCULATIONS_SUBTRACTION' => "ما هو حاصل %d - %d ?",
'ANTISPAM_CALCULATIONS_DIVISION' => "ما هو حاصل %d ÷ %d ?",
'ANTISPAM_FILL_BLANK_WORD' => "اكتب الكلمة المفقودة",
'ANTISPAM_CALC_NO_MATCH' => "نتيجة العملية الحسابية غير صحيحة.<br>الرجاء عد الى الخلف واكتب النتيجة الصحيحة",
'ANTISPAM_WORD_NO_MATCH' => "الكلمة المفقودة غير صحيحة <br>الرجاء عد إلى الخلف واكتب الكلمة الصحيحة",
);

 
?>
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
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR	|
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,		|
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE	|
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER		|
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING		|
* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS	|
* IN THE SOFTWARE.																|
+===============================================================================+
*/

$admin_lang = array(
'mod_title' => "الأخبار",
'mod_ver' => "1.0",
'mod_auth' => "Khr2003",
'mod_desc' => "يمكنّك هذا الموديل من إضافة أخبار لموقعك",
'mod_user' => "1,2,3,4,5",
'right_menu' => "0",
'left_menu' => "1",
'menuid'  => "1,2,3,4,5,6,7,8,9,10,11,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30",

'INSTALL_MOUDLE' => "تنصيب موديل الأخبار",
'QUERY_ERROR' => "خطأ في قواعد البيانات: في الاستعلام رقم. بسبب:. ",
'QUERY_TEXT' => "الاستعلام",
'SETUP_DONE_ERROR' => "تم الانتهاء من التنصيب بنجاح. في حال واجهت مشكلة الرجاء التوجه إلى منتديات الدعم الفني.",
'SETUP_DONE' => "تم انهاء التنصيب بنجاح.",
'BACK_TO_MAIN' => "عد إلى صفحة الموديلات.",
'UNINSTALL_MOUDLE' => "حذف موديل الأخبار",
'UNINSTALL_CONFIRM' => "هل أنت متأكد من حذف هذا الموديل؟ سوف يتم حذف جميع المعلومات المتعلقة به، كالمشاركات، والتعليقات، والبلوكات وأي شيء آخر.",
'UNINSTALL_DONE_ERROR' => "تم حذف الموديل بنجاح. حصلت بعض الأخطاء. الرجاء مراجعة الدعم الفني لتفاديها.",
'UNINSTALL_DONE' => "تم حذف الموديل بنجاح",
'GENERAL_SETTINGS' => "الإعدادات العامة",
'PERMISSIONS' => "التصاريح",


'POST_HEAD_LETTERS' => "عدد الحروف في رأس الخبر",
'LIST_TYPE' => "نوع العرض في التصانيف",
'list_type' =>  array(
'title' => "العنوان فقط",
'title_desc' => "العنوان والوصف"
),
'MAXIMUN_POST_LETTERS' => "الحد الأقصى للحروف في المشاركة",
'POSTS_PER_PAGE' => "عدد المواضيع المعروضة في التصنيف",
'COMMENTS_PER_PAGE' => "عدد التعليقات المعروضة في المشاركات",
'ALLOWED_FILES' => "اسمح لهذا النوع من الملفات بالرفع",
'MAXIMUM_UPLOAD_SIZE' => "الحجم الأقصى للملفات المرفوعة",
'CAT_PER_ROW' => "عدد التصانيف على المستوى الأفقي",
'ORDER_POSTS_BY' => "رتب المشاركات في التصنيف بحسب:",
'order_posts_by' => array(
				'last_added' => 'آخر إضافة',
				'last_added_comment' => 'آخر تعليق',
				'comments_number' => 'عدد التعليقات',
				'readers' => 'القراءات'
),
'SORT_POSTS_BY' => "رتب المشاركات في التصنيف",
'sort_posts_by' => array(
					'DESC' => 'تنازلياً',
					'ASC' => 'تصاعدياً'
),

'MANAGE_CAT' => "المجموعات التي تستطيع إضافة، تحرير أو حذف التصانيف",
'EDIT_ALL_POSTS' => "المجموعات التي تستطيع تحرير جميع المشاركات",
'ADD_POST' => "المجموعات التي تستطيع إضافة مشاركات",
'EDIT_OWN_POST' => "المجموعات التي تستطيع تحرير مشاركاتها",
'APPROVE_POSTS' => "المجموعات التي تستطيع اعتماد المشاركات في الانتظار",
'WAIT' => "المجموعات التي سوف تنتظر اعتماد مشاركاتها",
'SEARCH_POSTS' => 'المجموعات التي تستطيع البحث في الاخبار',
);


$lang = array( 
'LANG_ERROR_VALIDATE' => "الرجاء عد إلى الخلف واملأ الحقول المطلوبة",
'LANG_ERROR_ADD_DB' => "حصل خطأ عند ادخال المعلومات إلى قواعد البيانات.",
'LANG_ERROR_URL' => "ثمة خطأ في الرابط",
'LANG_MSG_NOT_VIEW_ATTACHMENTS' => "لا يمكنك رؤية الملفات المرفقة",
'CHECK_ALL' => "حدد الكل",
'UNCHECK_ALL' => "الغي تحديد الكل",
'DELETE' => "حذف",

// addpost.php
'ADDPOST_POST_HEAD' => "أضف مشاركة",
'ADDPOST_USERNAME' => "الاسم",
'ADDPOST_TITLE' => "العنوان",
'ADDPOST_SELECT_CAT' => "اختر تصنيفاً",
'ADDPOST_POST' => "المشاركة",
'ADDPOST_UPLOAD_FILE' => "ارفق ملفاً",
'ADDPOST_SUBSCRIBE' => "اشترك في هذا الموضوع",
'ADDPOST_POST_ADDED_SUCCESSFULLY' => "تم إضافة موضوعك بنجاح",
'ADDPOST_POST_NEED_APPROVAL' => "شكراً لإضافة المشاركة<br>سوف يتم نشر الموضوع بعد اعتماده من قبل الإدارة",

// viewpost.php
'VIEWPOST_ARTICLE_BY' => "بواسطة:",
'VIEWPOST_ARTICLE_DATEADDED' => "الإضافة:",
'VIEWPOST_READERS' => "القراءات:",
'VIEWPOST_COMMENTS' => "التعليقات:",

// editpost.php
'EDITPOST_EDIT_NOT_ALLOWED' => "لا يسمح لك بتحرير هذه المشاركة",
'EDITPOST_POST_HEAD' => "حرر المشاركة",
'EDITPOST_USERNAME' => "الاسم",
'EDITPOST_TITLE' => "العنوان",
'EDITPOST_SELECT_CAT' => "اختر تصنيفاً",
'EDITPOST_POST' => "المشاركة",
'EDITPOST_SUBSCRIBE' => "اشترك في هذا الموضوع",
'EDITPOST_POST_ADDED_SUCCESSFULLY' => "تم تحرير المشاركة بنجاح",
'EDITPOST_ALLOW_POST' => "اعتمد هذا الموضوع",
'EDITPOST_UPLOAD_FILE' => "ارفق ملفاً",
'EDITPOST_COMMENT_DELETED_SUCCESSFULLY' => "تم حذف المشاركة بنجاح",
'EDITPOST_NOT_ALLOWED' => "لا يسمح لك بالدخول إلى هذا القسم",

// addcomment.php
'ADDCOMMENT_COMMENT_HEAD' => "أضف تعليقاً",
'ADDCOMMENT_USERNAME' => "الاسم",
'ADDCOMMENT_TITLE' => "العنوان",
'ADDCOMMENT_COMMENT' => "التعليق",
'ADDCOMMENT_UPLOAD_FILE' => "ارفق ملفاً",
'ADDCOMMENT_SUBSCRIBE' => "اشترك في هذه المشاركة",
'ADDCOMMENT_POST_ADDED_SUCCESSFULLY' => "تم إضافة تعليق بنجاح",
'ADDCOMMENT_POST_NEED_APPROVAL' => "شكراً لإضافة التعليق يجب اعتماد تعليقك من قبل الإدارة قبل نشره",

// editcomment.php
'EDITCOMMENT_EDIT_NOT_ALLOWED' => "لا يسمح لك بتحرير هذا التعليق.",
'EDITCOMMENT_POST_HEAD' => "تحرير تعليق",
'EDITCOMMENT_USERNAME' => "الاسم",
'EDITCOMMENT_TITLE' => "العنوان",
'EDITCOMMENT_COMMENT' => "التعليق",
'EDITCOMMENT_POST_EDITED_SUCCESSFULLY' => "تم تحرير التعليق بنجاح",
'EDITCOMMENT_ALLOW_POST' => "اعتمد هذه المشاركة",
'EDITCOMMENT_UPLOAD_FILE' => "أضف مرفقاً",
'EDITCOMMENT_COMMENT_DELETED_SUCCESSFULLY' => "تم حذف التعليق بنجاح",
'EDITCOMMENT_NOT_ALLOWED' => "لا يسمح لك بالقيام بهذه العملية.",

// search.php language
'SEARCH_HEAD' => "البحث",
'SEARCH_KEYWORD' => "الكلمات المفتاحية",
'SEARCH_POSTS_PER_PAGE' => "عدد النتائج في الصفحة",
'SEARCH_ORDER_BY' => "رتب النتائج بحسب",
'SEARCH_SORT_BY' => "صنف النتائج بحسب",
'SEARCH_SEARCH_BUTTON' => "ابحث",
'SEARCH_FILL_ALL_REQUIRED_FIELDS' => "الرجاء ملأ كافة الحقول الاجبارية",

// misc .php langauge
'MISC_UNPIN_OR_OPEN_NOT_ABLE' => "لا يمكن رفع تثبيت هذا الموضوع أو فتحه لأنه غير مثبت أو مغلق.",
'MISC_PIN_OR_OPEN_NOT_ABLE' => "لا يمكن تثبيت أو فتح هذا الموضوع لأنه فعلاً مثبت أو مفتوح",
'MISC_UNPIN_OR_CLOSE_NOT_ABLE' => "لا يمكن رفع تثبيت أو غلق المشاركة لأنها بالأساس غير مثبتة أو مغلقة",
'MISC_PIN_OR_CLOSE_NOT_ABLE' => "لا يمكن تثبيت أو إغلاق هذه المشاركة لأنها بالأساس مثبتة أو مغلقة.",
'MISC_NO_ACTIONS_SELECTED' => "لم تقم باختيار أي عملية للقيام بها على هذه المشاركة. الرجاء العودة واختيار إحدى الاوامر لتنفيذها على المشاركة.",
'MISC_ACTIONS_PERFORMED_SUCCESSFLY' => "تم تنفيذ العملية بنجاح.",

// Includes folder langauge //
// functions.php
'INCLUDES_FUNCTIONS_ADMIN_MENU' => "قائمة المدير:",
'INCLUDES_FUNCTIONS_ADMIN_MENU_CHOOSE' => "اختر أحد الخيارات التالية:",
'INCLUDES_FUNCTIONS_ADMIN_MENU_EDIT' => "حرر المشاركة",
'INCLUDES_FUNCTIONS_ADMIN_MENU_PIN' => "ثبت المشاركة",
'INCLUDES_FUNCTIONS_ADMIN_MENU_UNPIN' => "الغ تثبيت المشاركة",
'INCLUDES_FUNCTIONS_ADMIN_MENU_CLOSE' => "أغلق المشاركة",
'INCLUDES_FUNCTIONS_ADMIN_MENU_UNCLOSE' => "افتح المشاركة",
'INCLUDES_FUNCTIONS_ATTACHMENT' => "المرفقات",
'INCLUDES_FUNCTIONS_ATTACHMENT_SIZE' => "الحجم",
'INCLUDES_FUNCTIONS_ATTACHMENT_NAME' => "اسم الملف المرفق",
'INCLUDES_FUNCTIONS_ATTACHMENT_CLICKS' => "عدد الضغطات",

// blocks folder langauge //
// news.block.php 
'BLOCKS_CONTROL_NEWS' => "لوحة تحكم الأخبار",
'BLOCKS_ADDCAT' => "أضف تصنيفاً جديداً",
'BLOCKS_VIEW_EDIT' => "استعرض أو حرر التصانيف",
'BLOCKS_UNAPPROVED_POSTS' => "الاخبار في الانتظار",
'BLOCKS_UNAPPROVED_COMMENTS' => "تعليقات في الانتظار",

// control folder langauge //
// index.php 
'CONTROL_NEWS' => "لوحة التحكم",


// Addcat.php language
'CONTROL_ADDCAT' => "أضف تصنيفاً",
'CONTROL_ADDCAT_TITLE' => "العنوان",
'CONTROL_ADDCAT_ORDER' => "الترتيب",
'CONTROL_ADDCAT_PARENT_CAT' => "التصنيف الرئيسي",
'CONTROL_ADDCAT_DESC' => "الوصف",
'CONTROL_ADDCAT_CAT_EMAIL' => "البريد الالكتروني للتبليغ بالمشاركات الجديدة",
'CONTROL_ADDCAT_CAT_IMAGE' => "صورة التصنيف",
'CONTROL_ADDCAT_ALLOW_VIEW' => "المجموعات التي تستطيع رؤية هذه التصنيف",
'CONTROL_ADDCAT_ALLOW_POST' => "المجموعات التي تستطيع إضافة مشاركات لهذا التصنيف",
'CONTROL_ADDCAT_CLOSED' => "أغلق التصنيف؟ للأرشيف فقط",
'CONTROL_ADDCAT_SUCCESSFUL' => "تم إضافة التصنيف بنجاح",
'CONTROL_ADDCAT_WRONG_EMAIL' => "البريد الالكتروني الذي ادخلته غير صحيح<br>الرجاء ادخال بريد الكتروني صحيح",

// edit.php language
'CONTROL_EDITCAT' => "حرر تصنيفاً",
'CONTROL_EDITCAT_TITLE' => "العنوان",
'CONTROL_EDITCAT_ORDER' => "الترتيب",
'CONTROL_EDITCAT_PARENT_CAT' => "التصنيف الرئيسي",
'CONTROL_EDITCAT_DESC' => "الوصف",
'CONTROL_EDITCAT_CAT_EMAIL' => "البريد الالكتروني للابلاغ بالجديد من المشاركات",
'CONTROL_EDITCAT_CAT_IMAGE' => "صورة التصنيف",
'CONTROL_EDITCAT_ALLOW_VIEW' => "المجموعات التي يسمح لها رؤية التصنيف",
'CONTROL_EDITCAT_ALLOW_POST' => "المجموعات التي يسمح لها بإضافة مشاركات للتصنيف",
'CONTROL_EDITCAT_CLOSED' => "أغلق التصنيف؟ (أجعله للأرشيف فقط)",
'CONTROL_EDITCAT_SUCCESSFUL' => "تم تحرير التصنيف بنجاح",
'CONTROL_EDITCAT_WRONG_EMAIL' => "البريد الالكتروني الذي ادخلته غير صحيح. الرجاء ادخال بريد الكتروني صحيح",
'CONTROL_EDITCAT_CAT_CURRENT_IMAGE' => "الصورة الحالية للتصنيف",
'CONTROL_EDITCAT_CAT_REPLACE_IMAGE' => "أضف أو استبدل الصورة",

// viewcat.php langauge
'CONTROL_VIEWCAT' => "استعرض التصانيف",
'CONTROL_VIEWCAT_TITLE' => "العنوان",
'CONTROL_VIEWCAT_OPTIONS' => "الخيارات",

// misc.php lanauge
'MISC_DELETE_CAT_IMAGE_UNSUCCESSFUL' => "تم حذف الصورة",
'MISC_DELETE_CAT_IMAGE_SUCCESSFUL' => "تم حذف الصورة بنجاح",
'MISC_DELETE_CAT_CHOOSE' => "اختر احد الخيارات التالية:",
'MISC_DELETE_CAT_DELETE_ALL' => "احذف جميع المدونات المرتبطة بهذا التصنيف والتعليقات المتعلقة بهم",
'MISC_DELETE_CAT_MOVE_DELETE' => "احذف التصنيف ولكن انقل المدونات المرتبطة بها إلى هذا التصنيف:",
'MISC_DELETE_CAT_CHOOSE_CAT' => "اختر التصنيف الجديد",
'MISC_DELETE_CAT' => "احذف التصنيف",
'MISC_DELETE_CAT_SUCCESSFUL' => "تم حذف التصنيف بنجاح.",
'MISC_DELETE_CAT_UNSUCCESSFUL' => "لم يكن بالإمكان حذف التصنيف.",
'MISC_DELETE_POST_SUCCESSFUL' => "تم حذف التدوينة بنجاح",
'MISC_DELETE_POST_NOT_ALLOWED' => "لا يمكنك حذف المشاركات",
'MISC_DELETE_CAT_CONTAIN_SUBCAT' => "لا يمكنك حذف هذا التصنيف لانه يحتوي على تصانيف فرعية.<br>قم بحذف التصانيف الفرعية ومن ثم احذف هذا التصنيف",

// approve_posts.php
'APPROVE_POSTS_UNAPPROVED_POSTS' => "المشاركات في الانتظار",
'APPROVE_POSTS_TOPIC' => "العنوان",
'APPROVE_POSTS_AUTHOR' => "الاسم",
'APPROVE_POSTS_OPTIONS' => "الخيارات",
'APPROVE_POSTS_POSTS_LIST' => "قائمة المشاركات في الانتظار",
'APPROVE_POSTS_SELECT_ALL' => "اختر الكل",
'APPROVE_POSTS_DESELECT_ALL' => "الغ اختيار الكل",
'APPROVE_POSTS_DELETE_SELECTED' => "احذف المشاركات المختارة",
'APPROVE_POSTS_CONFIRM_DELETE' => "هل أنت متأكد من حذف المشاركات المختارة؟",
'APPROVE_POSTS_APPROVE_SELECTED' => "اعتمد المشاركات المختارة",
'APPROVE_POSTS_CHOOSE_CAT' => "اختر تصنيفاً",
'APPROVE_POSTS_MOVE' => "انقل",
'APPROVE_POSTS_MOVE_TO' => "انقل إلى:",
'APPROVE_POSTS_SELECTED_POSTS_APPROVED' => "تم اعتماد المشاركات المختارة",
'APPROVE_POSTS_NO_POSTS_SELECTED' => "لم تقم باختيار أي مشاركة الرجاء العودة إلى الخلف واختيارمشاركة  واحدة  على الأقل",
'APPROVE_POSTS_SELECTED_POSTS_DELETED' => "تم حذف المشاركات المختارة",
'APPROVE_POSTS_SELECTED_POSTS_MOVED' => "تم نقل المشاركات المختارة",

// approve_comments.php
'APPROVE_COMMENTS_UNAPPROVED_COMMENTS' => "التعليقات في الانتظار",
'APPROVE_COMMENTS_TOPIC' => "الموضوع",
'APPROVE_COMMENTS_AUTHOR' => "الكاتب",
'APPROVE_COMMENTS_OPTIONS' => "الخيارات",
'APPROVE_COMMENTS_COMMENTS_LIST' => "قائمة التعليقات في الانتظار",
'APPROVE_COMMENTS_SELECT_ALL' => "اختر الكل",
'APPROVE_COMMENTS_DESELECT_ALL' => "الغ اختيار الكل",
'APPROVE_COMMENTS_DELETE_SELECTED' => "احذف المشاركات المختارة",
'APPROVE_COMMENTS_CONFIRM_DELETE' => "هل أنت متأكد من أنك تريد حذف التعليقات المختارة؟",
'APPROVE_COMMENTS_APPROVE_SELECTED' => "فعل التعليقات المختارة",
'APPROVE_COMMENTS_CHOOSE_CAT' => "اختر تصنيفاً",
'APPROVE_COMMENTS_SELECTED_POSTS_APPROVED' => "تم تفعيل التعليقات المختارة",
'APPROVE_COMMENTS_NO_POSTS_SELECTED' => "لم تقم باختيار أي تعليق الرجاء عد إلى الخلف وقم باختيار تعليق واحد على الأقل.",
'APPROVE_COMMENTS_SELECTED_POSTS_DELETED' => "تم حذف التعليقات المختارة",



'LIST_TITLE' => "العنوان",
'LIST_AUTHOR' => "الكاتب",
'LIST_DATE_ADDED' => "التاريخ",
'LIST_READERS' => "القراءات",
'LIST_COMMENTS' => "التعليقات",

'CONTROL_CATEGORIES' => 'أقسام الأخبار',
'CONTROL_ADD_NEW_CAT' => 'أضف تصنيفاً جديداً',
'CONTROL_EDIT_VIEW_CAT' => 'عرض/تحرير التصانيف',
'CONTROL_PENDING_POSTS' => 'المشاركات في الانتظار',
'CONTROL_PENDING_COMMENTS' => 'التعليقات في الانتظار',

'ADD_COMMENT' => 'أضف تعليقاً',
'ADD_POST' => 'أضف مشاركة',
'COMMENTS_COUNT' => 'عدد التعليقات',
'POSTS_COUNT' => 'عدد المشاركات',
'EDIT_COMMENT' => 'حرر التعليق'


);
 
?>
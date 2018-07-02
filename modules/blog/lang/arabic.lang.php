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
'mod_title'  => "المدونة",
'mod_ver'  => "1.0",
'mod_auth'  => "Khr2003",
'mod_desc'  => "يمكنك إنشاء مدونة في موقعك من خلال هذا الموديل",
'mod_user'  => "1,2,3,4,5",
'right_menu'  => "0",
'left_menu'  => "1",
'menuid'  => "1,2,3,4,5,6,7,8,9,10,11,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30",

'BLOG_CONTROL' => "تحكم المدونة",
'BLOG_CATEGORIES' => "أقسام المدونة",
'BLOG_TAGS_CLOUD' => "سحابة الأوسمة",
'BLOG_ARCHIVE' => "أرشيف المدونة",

'INSTALL_MOUDLE' => "تنصيب موديل المدونة للمجلة السهلة 1.0",
'QUERY_ERROR' => "خطأ في قواعد البيانات: في الاستعلام رقم. بسبب:. ",
'QUERY_TEXT' => "الاستعلام",
'SETUP_DONE_ERROR' => "تم الانتهاء من التنصيب بنجاح. في حال واجهت مشكلة الرجاء التوجه إلى منتديات الدعم الفني.",
'SETUP_DONE' => "تم انهاء التنصيب بنجاح.",
'BACK_TO_MAIN' => "عد إلى صفحة الموديلات.",
'UNINSTALL_MOUDLE' => "حذف موديل المدونة",
'UNINSTALL_CONFIRM' => "هل أنت متأكد من حذف هذا الموديل؟ سوف يتم حذف جميع المعلومات المتعلقة به، كالمشاركات، والتعليقات، والبلوكات وأي شيء آخر.",
'UNINSTALL_DONE_ERROR' => "تم حذف الموديل بنجاح. حصلت بعض الأخطاء. الرجاء مراجعة الدعم الفني لتفاديها.",
'UNINSTALL_DONE' => "تم حذف الموديل بنجاح",

'GENERAL_SETTINGS' => "الإعدادات العامة",
'PERMISSIONS' => 'التصاريح',
'POST_HEAD_LETTERS' => "عدد حروف رأس المدونة<br>يمكنك اختيار -1 لعدد لا محدود",
'POSTS_PER_PAGE' => "عدد المدونات المعروضة في التصنيف",
'COMMENTS_PER_PAGE' => "عدد التعليقات المعروضة في المدونة",
'EMAIL_NOTIFICATION' => "إرسال إعلام بتعليقات جديدة إلى هذا البريد الالكتروني<br>دعه فارغاً إذا لم ترغب باستلام اعلام بريدي",
'CAT_PER_ROW' => "عدد الأعمدة لعرض التصانيف",
'ORDER_POSTS_BY' => "رتب التدوينات بحسب",
'order_posts_by' => array('last_added' => 'آخر تدوينة',
						'last_added_comment' => 'آخر تعليق',
						'comments_number' => 'عدد التعليقات',
						'readers' => 'القراءات'),
'SORT_POSTS_BY' => "رتب التدوينات",
'sort_posts_by' => array('DESC' => 'تنازلياً',
						'ASC' => 'تصاعدياً'),
						
						
'MANAGE_CAT' => "المجموعات التي تستطيع إضافة، تحرير أو حذف الأقسام",
'EDIT_ALL_POSTS' => "المجموعات التي تستطيع تحرير جميع المشاركات",
'ADD_POST' => "المجموعات التي تستطيع إضافة تدوينة",
'ADD_COMMENT' => "المجموعات التي تستطيع إضافة تعليق",
'EDIT_OWN_POST' => "المجموعات التي تستطيع تحرير التعليق الخاص بها",
'APPROVE_POSTS' => "المجموعات التي تفعل المشاركات",
'WAIT' => "المجموعات التي سوف تنتظر تفعيل مشاركاتها",

);


$lang = array( 
'BLOG' => "المدونة",
'LANG_ERROR_VALIDATE' => "الرجاء عد إلى الخلف واملأ الحقول المطلوبة",
'LANG_ERROR_ADD_DB' => "حصل خطأ عند ادخال المعلومات إلى قواعد البيانات.",
'LANG_ERROR_URL' => "ثمة خطأ في الرابط",
'LANG_MSG_NOT_VIEW_ATTACHMENTS' => "لا يمكنك رؤية الملفات المرفقة",
'CHECK_ALL' => "حدد الكل",
'UNCHECK_ALL' => "الغي تحديد الكل",
'DELETE' => "حذف",

//archive.php
'ARCHIVE_NO_MONTH_SPECIFIED' => "لم يتم تعيين التاريخ",
'ARCHIVE_NO_YEAR_SPECIFIED' => "لم يتم تعيين السنة",

// addpost.php
'ADDPOST_POST_HEAD' => "أضف مشاركة",
'ADDPOST_USERNAME' => "الاسم",
'ADDPOST_TITLE' => "العنوان",
'ADDPOST_SELECT_CAT' => "اختر تصنيفاً",
'ADDPOST_POST' => "المشاركة",
'ADDPOST_UPLOAD_FILE' => "ارفق ملفاً",
'ADDPOST_SUBSCRIBE' => "اشترك في هذا الموضوع",
'ADDPOST_TAGS' => "الأوسمة<br>افصلها بفاصلة '،'",
'ADDPOST_ALLOW_COMMENTS' => "اسمح بالتعليقات على هذه التدوينة",
'ADDPOST_SAVE_DRAFT' => "احفظها كمسودة",
'ADDPOST_SUBSCRIBE' => "اشترك بهذا التدوينة",
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
'EDITPOST_SAVE_DRAFT' => "احفظها كمسودة",
'EDITPOST_TAGS' => "الأوسمة<br>افصلها بفاصلة '،'",
'EDITPOST_POST_EDITED_SUCCESSFULLY' => 'تم تحرير المدونة بنجاح',

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
// control.block.php 
'BLOCKS_CONTROL_BLOG' => "تحكم المدونة",
'BLOCKS_ADDCAT' => "أضف تصنيفاً جديداً",
'BLOCKS_VIEW_EDIT' => "استعرض أو حرر التصانيف",
'BLOCKS_UNAPPROVED_POSTS' => "الاخبار في الانتظار",
'BLOCKS_UNAPPROVED_COMMENTS' => "تعليقات في الانتظار",

// control folder langauge //
// index.php 
'CONTROL_BLOG' => "لوحة التحكم",


// Addcat.php language
'CONTROL_ADDCAT' => "أضف تصنيفاً",
'CONTROL_ADDCAT_TITLE' => "العنوان",
'CONTROL_ADDCAT_ORDER' => "الترتيب",
'CONTROL_ADDCAT_SUCCESSFUL' => "تم إضافة التصنيف بنجاح",

// edit.php language
'CONTROL_EDITCAT' => "حرر تصنيفاً",
'CONTROL_EDITCAT_TITLE' => "العنوان",
'CONTROL_EDITCAT_ORDER' => "الترتيب",
'CONTROL_EDITCAT_SUCCESSFUL' => "تم تحرير التصنيف بنجاح",

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
'MISC_DELETE_POST_SUCCESSFUL' => "تم حذف المشاركة بنجاح",
'MISC_DELETE_POST_NOT_ALLOWED' => "لا يمكنك حذف المشاركات",
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

'CONTROL_CATEGORIES' => 'أقسام المدونة',
'CONTROL_ADD_NEW_CAT' => 'أضف تصنيفاً جديداً',
'CONTROL_EDIT_VIEW_CAT' => 'عرض/تحرير التصانيف',
'CONTROL_PENDING_POSTS' => 'المشاركات في الانتظار',
'CONTROL_PENDING_COMMENTS' => 'التعليقات في الانتظار',
);

 
?>
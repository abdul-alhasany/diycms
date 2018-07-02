<?php
// get category details
$cat_result = $diy_db->query("SELECT * FROM diy_news_cat ORDER BY cat_order ASC");
while ($cat_row = $diy_db->dbarray($cat_result)) {
    extract($cat_row);
    $cat_array[$catid] = $cat_title;
}


// settings array
$array = array(
    'الإعدادات العامة' => array(
		'theme_color' => array(
            'type' => 'drop_down',
            'title' => 'لون الثيم',
			'default' => 'default',
			'options' => array(
'default' => 'الافتراضي',
'blue' => 'الأزرق',
'red' => 'الأحمر',
'green' => 'الأخضر'
)
        ),
        'index_cateogries' => array(
            'type' => 'checkbox',
            'title' => array(
                'short' => 'سوف يتم عرض الأخبار في الصفحة الرئيسية فقط من الأقسام التي ستختارها',
                'normal' => 'عرض الأقسام في الرئيسية'
            ),
            'options' => $cat_array
        ),
		'index_cateogries_no' => array(
            'type' => 'drop_down_numbers',
            'title' => array(
                'short' => 'عدد الأخبار التي سوف يتم عرضها لكل قسم في الصفحة الرئيسية',
                'normal' => 'عدد الأخبار لكل قسم'
            ),
            'max_value' => '20',
			'default' => 5
        )
    ),
	'إعدادات السلايد الإخباري' => array(
		'show_rotator' => array(
            'type' => 'radio',
            'title' => 'أظهر السلايد الإخباري؟',
			'default' => '1'
        ),
		'rotator_desc_no' => array(
            'type' => 'input',
            'title' => 'عدد أحرف الوصف لكل خبر',
			'default' => '450',
			'length' => '10'
        ),
		'rotator_time_interval' => array(
            'type' => 'input',
            'title' => array('normal' => 'فترة الانتظار بين عرض كل خبر', 'short' => 'ضع العدد بالثواني'),
			'default' => '5',
			'length' => '10'
        ),
		'rotator_cateogries' => array(
            'type' => 'checkbox',
            'title' => array(
                'short' => 'سوف يتم عرض الأخبار في السلايد من الأقسام التي ستختارها',
                'normal' => 'عرض الأقسام في السلايد الإخباري'
            ),
            'options' => $cat_array
        ),
    ),
	'إعدادات البلوك الإخباري' => array(
		'show_block' => array(
            'type' => 'radio',
            'title' => 'أظهر البلوك الإخباري؟',
			'default' => '1'
        ),
		'block_news_no' => array(
            'type' => 'input',
            'title' => 'عدد الأخبار المعروضة',
			'default' => '10',
			'length' => '10'
        ),
		'news_block_periods' => array(
            'type' => 'checkbox',
            'title' => 'عرض الأخبار في هذه الفترات',
            'options' => array('day' => 'اليوم', 'week' => 'الأسبوع', 'month' => 'الشهر')
        )
    )
);
register_theme_settings($array);
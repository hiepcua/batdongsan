CREATE VIEW `view_cate` AS (select `admin_thc`.`tbl_category`.`cat_id` AS `cat_id`,`admin_thc`.`tbl_category`.`par_id` AS `par_id`,`admin_thc`.`tbl_category`.`isactive` AS `isactive`,`admin_thc`.`tbl_category_text`.`img` AS `img`,`admin_thc`.`tbl_category_text`.`name` AS `name`,`admin_thc`.`tbl_category_text`.`meta_title` AS `meta_title`,`admin_thc`.`tbl_category_text`.`meta_key` AS `meta_key`,`admin_thc`.`tbl_category_text`.`meta_desc` AS `meta_desc`,`admin_thc`.`tbl_category_text`.`lag_id` AS `lag_id`,`admin_thc`.`tbl_category_text`.`alias` AS `alias` from (`tbl_category_text` join `tbl_category` on((`admin_thc`.`tbl_category_text`.`cat_id` = `admin_thc`.`tbl_category`.`cat_id`)))) ;

CREATE VIEW `view_content` AS (select `admin_thc`.`tbl_content`.`con_id` AS `con_id`,`admin_thc`.`tbl_content`.`code` AS `code`,`admin_thc`.`tbl_content`.`cat_id` AS `cat_id`,`admin_thc`.`tbl_content`.`list_tagid` AS `list_tagid`,`admin_thc`.`tbl_content`.`list_conid` AS `list_conid`,`admin_thc`.`tbl_content`.`thumb_img` AS `thumb_img`,`admin_thc`.`tbl_content`.`creatdate` AS `creatdate`,`admin_thc`.`tbl_content`.`modifydate` AS `modifydate`,`admin_thc`.`tbl_content`.`gmem_id` AS `gmem_id`,`admin_thc`.`tbl_content`.`visited` AS `visited`,`admin_thc`.`tbl_content`.`order` AS `order`,`admin_thc`.`tbl_content`.`isHot` AS `isHot`,`admin_thc`.`tbl_content`.`type` AS `type`,`admin_thc`.`tbl_content`.`isactive` AS `isactive`,`admin_thc`.`tbl_content_text`.`intro` AS `intro`,`admin_thc`.`tbl_content_text`.`title` AS `title`,`admin_thc`.`tbl_content_text`.`fulltext` AS `fulltext`,`admin_thc`.`tbl_content_text`.`duration` AS `duration`,`admin_thc`.`tbl_content_text`.`destination` AS `destination`,`admin_thc`.`tbl_content_text`.`author` AS `author`,`admin_thc`.`tbl_content_text`.`meta_title` AS `meta_title`,`admin_thc`.`tbl_content_text`.`meta_key` AS `meta_key`,`admin_thc`.`tbl_content_text`.`meta_desc` AS `meta_desc`,`admin_thc`.`tbl_content_text`.`lag_id` AS `lag_id` from (`tbl_content` join `tbl_content_text` on((`admin_thc`.`tbl_content`.`con_id` = `admin_thc`.`tbl_content_text`.`con_id`)))) ;

CREATE VIEW `view_menu` AS (select `admin_thc`.`tbl_menus`.`mnu_id` AS `mnu_id`,`admin_thc`.`tbl_menus`.`code` AS `code`,`admin_thc`.`tbl_menus`.`desc` AS `desc`,`admin_thc`.`tbl_menus`.`isactive` AS `isactive`,`admin_thc`.`tbl_menus_text`.`name` AS `name`,`admin_thc`.`tbl_menus_text`.`lag_id` AS `lag_id` from (`tbl_menus` join `tbl_menus_text` on((`admin_thc`.`tbl_menus`.`mnu_id` = `admin_thc`.`tbl_menus_text`.`mnu_id`)))) ;

CREATE VIEW `view_menuitem` AS (select `admin_thc`.`tbl_mnuitem`.`mnuitem_id` AS `mnuitem_id`,`admin_thc`.`tbl_mnuitem`.`par_id` AS `par_id`,`admin_thc`.`tbl_mnuitem`.`code` AS `code`,`admin_thc`.`tbl_mnuitem`.`mnu_id` AS `mnu_id`,`admin_thc`.`tbl_mnuitem`.`viewtype` AS `viewtype`,`admin_thc`.`tbl_mnuitem`.`cat_id` AS `cat_id`,`admin_thc`.`tbl_mnuitem`.`cata_id` AS `cata_id`,`admin_thc`.`tbl_mnuitem`.`con_id` AS `con_id`,`admin_thc`.`tbl_mnuitem`.`link` AS `link`,`admin_thc`.`tbl_mnuitem`.`class` AS `class`,`admin_thc`.`tbl_mnuitem`.`order` AS `order`,`admin_thc`.`tbl_mnuitem`.`isactive` AS `isactive`,`admin_thc`.`tbl_mnuitem_text`.`name` AS `name`,`admin_thc`.`tbl_mnuitem_text`.`intro` AS `intro`,`admin_thc`.`tbl_mnuitem_text`.`lag_id` AS `lag_id` from (`tbl_mnuitem` join `tbl_mnuitem_text` on((`admin_thc`.`tbl_mnuitem`.`mnuitem_id` = `admin_thc`.`tbl_mnuitem_text`.`mnuitem_id`)))) ;

CREATE VIEW `view_module` AS (select `admin_thc`.`tbl_modules`.`mod_id` AS `mod_id`,`admin_thc`.`tbl_modules`.`type` AS `type`,`admin_thc`.`tbl_modules`.`viewtitle` AS `viewtitle`,`admin_thc`.`tbl_modules`.`mnu_id` AS `mnu_id`,`admin_thc`.`tbl_modules`.`cat_id` AS `cat_id`,`admin_thc`.`tbl_modules`.`theme` AS `theme`,`admin_thc`.`tbl_modules`.`position` AS `position`,`admin_thc`.`tbl_modules`.`mnuids` AS `mnuids`,`admin_thc`.`tbl_modules`.`class` AS `class`,`admin_thc`.`tbl_modules`.`order` AS `order`,`admin_thc`.`tbl_modules`.`isactive` AS `isactive`,`admin_thc`.`tbl_modules_text`.`title` AS `title`,`admin_thc`.`tbl_modules_text`.`content` AS `content`,`admin_thc`.`tbl_modules_text`.`lag_id` AS `lag_id` from (`tbl_modules_text` join `tbl_modules` on((`admin_thc`.`tbl_modules_text`.`mod_id` = `admin_thc`.`tbl_modules`.`mod_id`)))) ;
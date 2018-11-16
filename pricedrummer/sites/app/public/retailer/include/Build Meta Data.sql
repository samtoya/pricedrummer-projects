SELECT DISTINCT(compare_product_id) FROM `compare_details`

SELECT * FROM `compare_products` where id IN(SELECT DISTINCT(compare_product_id) FROM `compare_details`)


UPDATE `compare_products`  SET `meta_data` = GROUP_CONCAT(select detail_value d from `compare_details` where d.`compare_product_id` = `compare_products`.id ) WHERE `compare_products`.`id` = 1;



UPDATE `compare_products` r 
	SET 
	`meta_data` = (select group_concat(detail_value) from `compare_details` where `compare_details`.`compare_product_id` = r.id and detail_value <>"" ) 
	WHERE `compare_products`.`id`IN(SELECT DISTINCT(compare_product_id) FROM `compare_details`);






SELECT r.*, (select group_concat(detail_value) from `compare_details` where `compare_details`.`compare_product_id` = r.id and detail_value <>"" )as meta_d from `compare_products` r





SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
SET group_concat_max_len=40000;
UPDATE `compare_products` r 
	SET 
	`meta_data` = (select group_concat(detail_value) from `compare_details` where `compare_details`.`compare_product_id` = r.id and detail_value <>"" ) 
	WHERE r.`id`IN(SELECT DISTINCT(compare_product_id) FROM `compare_details`);

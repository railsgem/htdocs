ALTER TABLE `os_postage` ADD COLUMN `postage_free` int DEFAULT '1' COMMENT '1: free , 0 not free' AFTER `update_time`;


SELECT * FROM `os_order_product` t1 WHERE t1.order_id=53;

SELECT t2.os_product_id, t2.`stock_id`, t2.`stock_entry_num`, t2.`stock_despatch_num`, t2.`stock_present_num` 
  FROM `os_stock_entry` t2 where t2.os_product_id in (SELECT t1.os_product_id FROM `os_order_product` t1 WHERE t1.order_id=53)
 order by t2.expire_date, t2.purchase_time
 ;



SELECT t1.order_id, t1.quantity, t1.os_product_id, t2.`stock_id`, t2.`stock_entry_num`, t2.`stock_despatch_num`, t2.`stock_present_num` FROM `os_order_product` t1 left join os_stock_entry t2 on t1.os_product_id = t2.os_product_id
WHERE t1.order_id=53 
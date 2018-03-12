CREATE TABLE `med_sds` (
  `sds_id` int(11) NOT NULL AUTO_INCREMENT,
  `sds_title` varchar(45) NOT NULL,
  `sds_manufacturer` varchar(45) NOT NULL,
  `sds_item_msds_num` varchar(10) NOT NULL,
  `sds_file_name` varchar(150) DEFAULT NULL,
  `sds_file_path` varchar(200) DEFAULT NULL,
  `sds_created_at` datetime NOT NULL,
  `sds_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sds_id`),
  KEY `idx_title_desc` (`sds_title`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

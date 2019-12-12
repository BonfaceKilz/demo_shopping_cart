CREATE TABLE `products` (
`id` int(8) NOT NULL AUTO_INCREMENT,
`product_name` varchar(255) NOT NULL,
`code` varchar(6) NOT NULL,
`image` text NOT NULL,
`price` decimal(9,2) NOT NULL,
`date_created` datetime DEFAULT NULL,
`date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY unique_code (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

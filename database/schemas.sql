CREATE TABLE `products` (
`id` int(8) NOT NULL AUTO_INCREMENT,
`code` varchar(8) NOT NULL,
`product_name` varchar(255) NOT NULL,
`description` varchar(500) NOT NULL,
`quantity` varchar(6) NOT NULL,
`image` text NOT NULL,
`price` decimal(9,2) NOT NULL,
`date_created` timestamp NULL,
`date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY unique_code (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Add some dummy data
INSERT INTO `products` (`product_name`, `code`, `description`, `quantity`, `image`, `price`)
VALUES
('XBee 6.3mW Wire Antenna - Series 2C', 'cKPCh9jT', 'This is the XBee XBP24CZ7WIT-004-revC module from Digi. The new Series 2C improves upon the power output and data protocol of the Series2. Series 2C modules allow you to create complex mesh networks based on the XBee ZB ZigBee mesh firmware. These modules allow a very reliable and simple communication between microcontrollers, computers, systems, really anything with a serial port! Point to point and multi-point networks are supported.', 10, 'xbee_wire_antenna.jpg', 3500),
('Bluetooth Module HCO5', 'Cobl9b8X', 'HC-05 is a class-2 bluetooth module with Serial Port Profile , which can configure as either Master or slave. a Drop-in replacement for wired serial connections, transparent usage. You can use it simply for a serial port replacement to establish connection between MCU, PC to your embedded project and etc.', 5, 'HC06.jpg', 600),
('Flex Sensor', 'gs69f6Qc', 'A simple flex sensor 4.5" in length. As the sensor is flexed, the resistance across the sensor increases. Patented technology by Spectra Symbol - they claim these sensors were used in the original Nintendo Power Glove.', 10, 'flex_sensor.jpg', 2500),
('RGB Matrix Shield For Arduino', '86runOwh', 'If you have got an Arduino-compatible board, with an ATmega328p chip  this shield will make usage a snap! A little light soldering to attach the headers, connector and terminal block and you are ready to rock. Plug it onto your microcontroller board, and you will be able to attach any RGB matrix with ease.', 10, 'RGB_matrix_shield.jpg', 1000),
('Raspberry Pi 3 Model B', 'WREaBEya', 'The stunning new Raspberry Pi 3 Model B has landed. This third generation model maintains the same popular board format as the Raspberry Pi 2 and Raspberry Pi B+, but boasts a faster 1.2GHz 64Bit SoC, and on board WiFi and Bluetooth!', 10, 'raspberry_pi.jpg', 5500);

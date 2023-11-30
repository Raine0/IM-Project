-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 04:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_sales_with_total_revenue` (IN `sales_id` INT, IN `new_quantity_sold` INT)   BEGIN
    DECLARE new_total_revenue DECIMAL(10, 2);
    DECLARE product_price DECIMAL(10, 2);
    DECLARE product_cost DECIMAL(10, 2);
    
    -- Retrieve the product price and cost
    SELECT price, cost INTO product_price, product_cost
    FROM products
    WHERE product_ID = (SELECT product_ID FROM sales WHERE sales_ID = sales_id LIMIT 1);
    
    -- Calculate the new total revenue
    SET new_total_revenue = (product_price - product_cost) * new_quantity_sold;

    -- Update the sales table with the new total revenue
    UPDATE sales
    SET total_revenue = new_total_revenue
    WHERE sales_ID = sales_id;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calculate_total_revenue` (`product_id_param` INT, `quantity_sold_param` INT) RETURNS DECIMAL(10,2)  BEGIN
    DECLARE product_price DECIMAL(10,2);
    DECLARE product_cost DECIMAL(10,2);

    SELECT price INTO product_price FROM products WHERE product_id = product_id_param;
    SELECT cost INTO product_cost FROM products WHERE product_id = product_id_param;

    RETURN (product_price - product_cost) * quantity_sold_param;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` varchar(7) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `address` varchar(30) DEFAULT NULL,
  `phone_number` varchar(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `address`, `phone_number`, `email`) VALUES
('CUS-001', 'Russel Osias', 'Baluan Park, General Santos Ci', '09568592822', 'russelosias@gmail.com'),
('CUS-002', 'Julius Talipan', 'Talisay Street, Lagao, General', '09639920823', 'brojul@gmail.com'),
('CUS-003', 'Raffy Simon', 'Apitong Street, Lagao, General', '09712107919', 'raffysimon@gmail.com'),
('CUS-004', 'Aubrey Joy Escuadra', 'Polomolok, South Cotabato', '09690182728', 'obriijoi@gmail.com');

--
-- Triggers `customers`
--
DELIMITER $$
CREATE TRIGGER `tg_table3_insert` BEFORE INSERT ON `customers` FOR EACH ROW BEGIN
  INSERT INTO customers_seq VALUES (NULL);
  SET NEW.customer_id = CONCAT('CUS-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customers_seq`
--

CREATE TABLE `customers_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers_seq`
--

INSERT INTO `customers_seq` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_id` varchar(7) NOT NULL DEFAULT '0',
  `Name` varchar(30) DEFAULT NULL,
  `Category` varchar(30) DEFAULT NULL,
  `Brand` varchar(30) DEFAULT NULL,
  `Cost` decimal(10,2) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Quantity` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_id`, `Name`, `Category`, `Brand`, `Cost`, `Price`, `Quantity`) VALUES
('PRO-001', 'PALIT GTX1050ti', 'Graphics Card', 'PALIT', 4000.00, 5000.00, 22),
('PRO-002', 'Ryzen 3 3300x', 'CPU', 'Ryzen', 4500.00, 6250.00, 40),
('PRO-003', 'Asus TUF B450M-Pro II Motherbo', 'Motherboard', 'ASUS', 0.00, 0.00, 5),
('PRO-004', 'Kingston Hyper X Fury RGB 16GB', 'RAM', 'Kingston', 2500.00, 3450.00, 10),
('PRO-005', 'Avision 24inch 165Hz 1920×1080', 'Monitor', 'Avision', 6999.00, 8949.00, 5),
('PRO-011', 'PALIT GTX1050ti', 'Graphics Card', 'PALIT', 4000.00, 5000.00, 10),
('PRO-013', 'Asus TUF B450M-Pro II Motherbo', 'Motherboard', 'ASUS', 3000.00, 4500.00, 20),
('PRO-043', 'Razer Viper Mini', 'Mouse', 'Razer', 700.00, 1000.00, 10),
('PRO-048', 'Logitech g102', 'Mouse', 'Logitech', 800.00, 1200.00, 12);

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `tg_table1_insert` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
  INSERT INTO Product_seq VALUES (NULL);
  SET NEW.Product_id = CONCAT('PRO-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_seq`
--

CREATE TABLE `product_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_seq`
--

INSERT INTO `product_seq` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_ID` varchar(7) NOT NULL DEFAULT '0',
  `product_ID` varchar(7) DEFAULT NULL,
  `supplier_ID` varchar(7) DEFAULT NULL,
  `date_of_purchase` datetime NOT NULL DEFAULT current_timestamp(),
  `date_of_arrival` datetime DEFAULT NULL,
  `quantity_purchased` int(7) NOT NULL,
  `cost_per_unit` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_ID`, `product_ID`, `supplier_ID`, `date_of_purchase`, `date_of_arrival`, `quantity_purchased`, `cost_per_unit`, `total_cost`) VALUES
('PUR-001', 'PRO-001', 'SUP-002', '2023-05-14 22:04:42', '2023-06-16 17:39:00', 15, 4000.00, 60000.00),
('PUR-002', 'PRO-004', 'SUP-001', '2023-05-14 22:04:42', '2023-05-29 16:18:00', 10, 2500.00, 25000.00),
('PUR-003', 'PRO-005', 'SUP-003', '2023-05-14 22:04:42', NULL, 20, 6999.00, 139980.00),
('PUR-015', 'PRO-043', 'SUP-002', '2023-06-14 18:37:06', NULL, 15, 700.00, 10500.00),
('PUR-017', 'PRO-013', 'SUP-002', '2023-06-14 00:00:00', NULL, 15, 3000.00, 45000.00),
('PUR-021', 'PRO-011', 'SUP-001', '2023-06-11 09:30:00', '2023-06-05 02:49:00', 10, 4000.00, 40000.00),
('PUR-022', 'PRO-043', 'SUP-002', '2023-06-01 18:40:00', '2023-06-15 02:18:00', 5, 700.00, 3500.00),
('PUR-026', 'PRO-043', 'SUP-001', '2023-06-02 10:14:00', '2023-06-15 02:14:00', 1, 700.00, 700.00),
('PUR-031', 'PRO-001', 'SUP-001', '2023-06-19 18:48:00', '2023-06-19 20:10:00', 10, 4000.00, 40000.00),
('PUR-033', 'PRO-048', 'SUP-001', '2023-10-10 15:30:00', '2023-10-22 15:30:00', 2, 800.00, 1600.00),
('PUR-034', 'PRO-001', 'SUP-003', '2023-11-30 23:10:00', NULL, 20, 4000.00, 80000.00);

--
-- Triggers `purchases`
--
DELIMITER $$
CREATE TRIGGER `calculate_purchase_total_cost` BEFORE INSERT ON `purchases` FOR EACH ROW BEGIN
  DECLARE product_cost DECIMAL(10,2);
  SELECT cost INTO product_cost FROM products WHERE product_id = NEW.product_id;
  SET NEW.total_cost = NEW.quantity_purchased * product_cost;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_product_cost` BEFORE INSERT ON `purchases` FOR EACH ROW BEGIN
  DECLARE product_cost DECIMAL(10,2);
  SELECT cost INTO product_cost FROM products WHERE product_id = NEW.product_id;
  SET NEW.cost_per_unit = product_cost;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `purchases_insert_trigger` AFTER INSERT ON `purchases` FOR EACH ROW BEGIN
    UPDATE products
    SET quantity = quantity + NEW.quantity_purchased
    WHERE product_ID = NEW.product_ID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_table4_insert` BEFORE INSERT ON `purchases` FOR EACH ROW BEGIN
  INSERT INTO Purchases_seq VALUES (NULL);
  SET NEW.Purchase_id = CONCAT('PUR-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_cost_per_unit_total_cost` BEFORE UPDATE ON `purchases` FOR EACH ROW BEGIN
  DECLARE product_cost DECIMAL(10, 2);
  
  IF NEW.Product_ID IS NOT NULL THEN
    SELECT cost INTO product_cost FROM products WHERE product_id = NEW.Product_ID;
    SET NEW.cost_per_unit = product_cost;
    SET NEW.total_cost = NEW.quantity_purchased * NEW.cost_per_unit;
  END IF;
  
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_quantity_from_purchases` AFTER UPDATE ON `purchases` FOR EACH ROW BEGIN
    -- Subtract the old quantity_purchased from the old product quantity
    UPDATE products
    SET quantity = quantity - OLD.quantity_purchased
    WHERE product_ID = OLD.product_ID;

    -- Add the new quantity_purchased to the new product quantity
    UPDATE products
    SET quantity = quantity + NEW.quantity_purchased
    WHERE product_ID = NEW.product_ID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total_cost` BEFORE UPDATE ON `purchases` FOR EACH ROW BEGIN
  DECLARE product_cost DECIMAL(10, 2);
  
  IF NEW.Product_ID IS NOT NULL THEN
    SELECT cost_per_unit INTO product_cost FROM purchases WHERE purchase_ID = NEW.purchase_ID;
    SET NEW.total_cost = NEW.quantity_purchased * product_cost;
  END IF;
  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `purchases_seq`
--

CREATE TABLE `purchases_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases_seq`
--

INSERT INTO `purchases_seq` (`id`) VALUES
(1),
(2),
(3),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_ID` varchar(7) NOT NULL DEFAULT '0',
  `product_ID` varchar(7) DEFAULT NULL,
  `customer_ID` varchar(7) DEFAULT NULL,
  `User_id` varchar(30) DEFAULT NULL,
  `date_of_sale` datetime NOT NULL DEFAULT current_timestamp(),
  `quantity_sold` int(7) NOT NULL,
  `price_per_unit` decimal(10,2) DEFAULT NULL,
  `total_revenue` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_ID`, `product_ID`, `customer_ID`, `User_id`, `date_of_sale`, `quantity_sold`, `price_per_unit`, `total_revenue`) VALUES
('SAL-001', 'PRO-001', 'CUS-001', 'USER-003', '2023-05-14 23:26:27', 2, 5000.00, 2000.00),
('SAL-002', 'PRO-003', 'CUS-002', 'USER-001', '2023-05-14 23:26:27', 1, 4500.00, 1500.00),
('SAL-003', 'PRO-005', 'CUS-003', 'USER-002', '2023-05-14 23:26:27', 1, 8949.00, 1950.00),
('SAL-004', 'PRO-001', 'CUS-001', 'USER-001', '2023-06-16 11:45:00', 1, 5000.00, 1000.00),
('SAL-007', 'PRO-001', 'CUS-002', 'USER-001', '2023-06-01 11:56:00', 1, 5000.00, 1000.00),
('SAL-009', 'PRO-004', 'CUS-002', 'USER-002', '2023-06-16 12:48:00', 5, 5000.00, 4750.00),
('SAL-010', 'PRO-002', 'CUS-001', 'USER-001', '2023-06-16 13:36:00', 2, 6250.00, 3500.00),
('SAL-013', 'PRO-001', 'CUS-001', 'USER-001', '2023-06-19 19:00:00', 10, 5000.00, 10000.00),
('SAL-014', 'PRO-002', 'CUS-001', 'USER-001', '2023-06-19 20:10:00', 5, 6250.00, 8750.00),
('SAL-016', 'PRO-002', 'CUS-001', 'USER-001', '2023-10-23 23:42:00', 5, 6250.00, 8750.00),
('SAL-017', 'PRO-002', 'CUS-001', 'USER-001', '2023-10-24 00:38:00', 5, 6250.00, 8750.00),
('SAL-018', 'PRO-001', 'CUS-001', 'USER-002', '2023-10-24 00:39:00', 4, 5000.00, 4000.00),
('SAL-019', 'PRO-003', 'CUS-001', 'USER-002', '2023-10-24 00:40:00', 5, 4500.00, 7500.00),
('SAL-020', 'PRO-004', 'CUS-002', 'USER-001', '2023-10-24 00:42:00', 10, 3450.00, 9500.00),
('SAL-021', 'PRO-005', 'CUS-001', 'USER-001', '2023-10-24 00:45:00', 3, 8949.00, 5850.00),
('SAL-022', 'PRO-002', 'CUS-001', 'USER-001', '2023-11-21 12:14:00', 5, 6250.00, 8750.00),
('SAL-023', 'PRO-001', 'CUS-001', 'USER-001', '2023-11-30 23:00:00', 1, 5000.00, 1000.00),
('SAL-024', 'PRO-001', 'CUS-001', 'USER-001', '2023-11-30 23:07:00', 1, 5000.00, 1000.00),
('SAL-025', 'PRO-001', 'CUS-001', 'USER-001', '2023-11-30 23:08:00', 1, 5000.00, 1000.00);

--
-- Triggers `sales`
--
DELIMITER $$
CREATE TRIGGER `calculate_revenue_total` BEFORE INSERT ON `sales` FOR EACH ROW BEGIN
  DECLARE product_price DECIMAL(10,2);
  DECLARE product_cost DECIMAL(10,2);
  SELECT price INTO product_price FROM products WHERE product_id = NEW.product_id;
  SELECT cost INTO product_cost FROM products WHERE  product_id = NEW.product_id;
  SET NEW.total_revenue = (product_price - product_cost) * NEW.quantity_sold;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_product_price` BEFORE INSERT ON `sales` FOR EACH ROW BEGIN
  DECLARE product_price DECIMAL(10,2);
  SELECT price INTO product_price FROM products WHERE product_id = NEW.product_id;
  SET NEW.price_per_unit = product_price;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reduce_product_quantity` AFTER INSERT ON `sales` FOR EACH ROW BEGIN
  UPDATE products SET quantity = quantity - NEW.quantity_sold WHERE product_id = NEW.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sales_update_trigger` BEFORE UPDATE ON `sales` FOR EACH ROW BEGIN
    -- Get the old and new values of quantity_sold
    SET @old_quantity_sold = OLD.quantity_sold;
    SET @new_quantity_sold = NEW.quantity_sold;

    -- Get the current quantity from the products table
    SELECT quantity INTO @product_quantity
    FROM products
    WHERE product_ID = NEW.product_ID;

    -- Update the quantity in the products table
    SET @product_quantity = @product_quantity + @old_quantity_sold - @new_quantity_sold;

    -- Update the products table with the new quantity
    UPDATE products
    SET quantity = @product_quantity
    WHERE product_ID = NEW.product_ID;

    -- Calculate the new total revenue
    SET @product_cost = (
        SELECT cost
        FROM products
        WHERE product_ID = NEW.product_ID
    );

    SET @product_price = (
        SELECT price
        FROM products
        WHERE product_ID = NEW.product_ID
    );

    SET @total_revenue = (@product_price - @product_cost) * @new_quantity_sold;

    -- Update the total_revenue column in the sales table
    SET NEW.total_revenue = @total_revenue;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_table5_insert` BEFORE INSERT ON `sales` FOR EACH ROW BEGIN
  INSERT INTO Sales_seq VALUES (NULL);
  SET NEW.sales_id = CONCAT('SAL-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_quantity_trigger` BEFORE UPDATE ON `sales` FOR EACH ROW BEGIN
    DECLARE old_quantity_sold INT;
    DECLARE new_quantity_sold INT;

    IF NEW.product_ID <> OLD.product_ID THEN
        -- Store the old and new quantity_sold values
        SET old_quantity_sold = OLD.quantity_sold;
        SET new_quantity_sold = NEW.quantity_sold;

        -- Update the quantity of the old product_ID
        UPDATE products
        SET quantity = quantity + old_quantity_sold
        WHERE product_ID = OLD.product_ID;

        -- Update the quantity of the new product_ID
        UPDATE products
        SET quantity = quantity - new_quantity_sold
        WHERE product_ID = NEW.product_ID;
    END IF;

    -- Update the price_per_unit of the updated product_id
    SET NEW.price_per_unit = (SELECT price FROM products WHERE product_id = NEW.product_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_seq`
--

CREATE TABLE `sales_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_seq`
--

INSERT INTO `sales_seq` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(7),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` varchar(7) NOT NULL DEFAULT '0',
  `supplier_of` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(30) DEFAULT NULL,
  `phone_number` varchar(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_of`, `name`, `address`, `phone_number`, `email`) VALUES
('SUP-001', 'Graphics Cards', 'Fryon Amboy', 'Londres Subdivision, Canery Si', '09123456789', 'fryon_totaleye69@gmail.com'),
('SUP-002', 'ASUS Products', 'Michael John Santos', 'VS Homes, San-isidro, General ', '09658912349', 'michael_j@gmail.com'),
('SUP-003', 'Monitors', 'Kaye Marie Valencia', 'South Osmena, General Santos C', '09324840648', 'k.mari@gmail.com'),
('SUP-006', 'Mouse', 'Aubrey Joy Escuadra', 'Polomolok, South Cotabato', '09690182728', 'obriijoi@gmail.com');

--
-- Triggers `suppliers`
--
DELIMITER $$
CREATE TRIGGER `tg_table2_insert` BEFORE INSERT ON `suppliers` FOR EACH ROW BEGIN
  INSERT INTO suppliers_seq VALUES (NULL);
  SET NEW.supplier_id = CONCAT('SUP-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_seq`
--

CREATE TABLE `suppliers_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers_seq`
--

INSERT INTO `suppliers_seq` (`id`) VALUES
(1),
(2),
(3),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_id` varchar(30) NOT NULL DEFAULT '0',
  `Name` varchar(30) DEFAULT NULL,
  `Contact_number` varchar(30) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_id`, `Name`, `Contact_number`, `Email`, `username`, `password`) VALUES
('USER-001', 'Ryan Philip Cataag', '09690182728', 'cataagryanphilip@gmail.com', 'ryancataag', 'ryancataag'),
('USER-002', 'Fryon', '09796200861', 'fryongil@gmail.com', 'f.totaleye69', NULL),
('USER-003', 'Michael', '09018296601', 'john_michael@gmail.com', 'michael.j', NULL),
('USER-005', 'Aubrey Joy Escuadra', '09690182728', 'obriijoi@gmail.com', 'aubreyjoy', NULL);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `tg_table6_insert` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
  INSERT INTO User_seq VALUES (NULL);
  SET NEW.User_id = CONCAT('USER-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_seq`
--

CREATE TABLE `user_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_seq`
--

INSERT INTO `user_seq` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customers_seq`
--
ALTER TABLE `customers_seq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `product_seq`
--
ALTER TABLE `product_seq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_ID`),
  ADD KEY `product_ID` (`product_ID`),
  ADD KEY `supplier_ID` (`supplier_ID`);

--
-- Indexes for table `purchases_seq`
--
ALTER TABLE `purchases_seq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_ID`),
  ADD KEY `product_ID` (`product_ID`),
  ADD KEY `customer_ID` (`customer_ID`);

--
-- Indexes for table `sales_seq`
--
ALTER TABLE `sales_seq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `suppliers_seq`
--
ALTER TABLE `suppliers_seq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `user_seq`
--
ALTER TABLE `user_seq`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers_seq`
--
ALTER TABLE `customers_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_seq`
--
ALTER TABLE `product_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `purchases_seq`
--
ALTER TABLE `purchases_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sales_seq`
--
ALTER TABLE `sales_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `suppliers_seq`
--
ALTER TABLE `suppliers_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_seq`
--
ALTER TABLE `user_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `products` (`Product_id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`supplier_ID`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `products` (`Product_id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

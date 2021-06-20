-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Чрв 20 2021 р., 13:55
-- Версія сервера: 8.0.19
-- Версія PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `test_shop`
--

-- --------------------------------------------------------

--
-- Структура таблиці `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin_role` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `customer`
--

INSERT INTO `customer` (`customer_id`, `last_name`, `first_name`, `telephone`, `email`, `city`, `password`, `admin_role`) VALUES
(1, 'Півкач', 'Михайло', '+380501111111', 'mykhailo.pivkach@transoftgroup.com', 'Мукачево', '58b4e38f66bcdb546380845d6af27187', 1),
(2, 'Антоненко', 'Дар\'я', '0930978647', 'denis92@virginiaintel.com', 'Мукачево', 'b5461e32b37ed3e99f090f2b645fbf30', 0),
(3, 'Дмитренко', 'Іван', '+380995557793', 'kramarenko.ulia@tahuisi.buzz', 'Ужгород', '9b48bed2e0eb03ee57adc8ed2fd54f3c', 0),
(4, 'Федорович', 'Юлія', '0938759070', 'larisa02@8yyyyy.com', 'Львів', 'a2ac67a7926dd348212c6dc83ffa57cd', 0),
(13, 'Великов', 'Анатолій', '+380564543', 'velikov@gmail.com', 'Ужгород', '0f8a4e60fe49c46fc2085ca4c7c01a08', 0),
(15, 'Протопенко', 'Лідія', '+380554654', 'prot@gmail.com', 'Львів', 'bad6d650bc2379b98d5066a2d23493cd', 0),
(16, 'Лагунцов', 'Ігорь', '+3808434343', 'lag@gmal.com', 'Київ', 'a2ac67a7926dd348212c6dc83ffa57cd', 0),
(23, 'Метільска', 'Ольга', '+3539534343', 'metilska@gmail.com', 'Чоп', '58b4e38f66bcdb546380845d6af27187', 0),
(25, 'Ларентій', 'Віктор', '+5435345345', 'larenti@gmail.com', 'Хуст', '58b4e38f66bcdb546380845d6af27187', 0),
(27, 'Орленко', 'Василь', '645645645', 'vasil@gmail.com', 'Lviv', '58b4e38f66bcdb546380845d6af27187', 0),
(28, 'Дмитренко', 'Ігорь', '3434353434', 'dmitrenko@gmail.com', 'Kyiv', '58b4e38f66bcdb546380845d6af27187', 0),
(32, 'Василенко', 'Валентин', '+3474574565', 'vasilenko@gmail.com', 'Сумми', '58b4e38f66bcdb546380845d6af27187', 0),
(34, 'sdgdfgdf', 'dfgdfgdf', 'dfgdfgdfg', 'aaabbb@mail.com', 'fsdfsdfs', '58b4e38f66bcdb546380845d6af27187', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `menu`
--

CREATE TABLE `menu` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `menu`
--

INSERT INTO `menu` (`id`, `name`, `path`, `active`, `sort_order`) VALUES
(1, 'Товари', '/product/list', 1, 1),
(2, 'Клієнти', '/customer/list', 1, 2),
(3, 'Тест', '/test/test', 1, 3),
(4, 'Експорт в Xml', '/product/unload', 1, 4);

-- --------------------------------------------------------

--
-- Структура таблиці `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `nameOrd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` bigint NOT NULL,
  `date_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `orders`
--

INSERT INTO `orders` (`id`, `nameOrd`, `email`, `telephone`, `date_at`) VALUES
(1, 'Михайло', 'mykhailo.pivkach@transoftgroup.com', 313137862, '2019-11-21 10:33:46'),
(3, 'aaabbb', 'aaabbb@gmail.com', 32143243, '2021-01-01 12:23:34');

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `sku` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `qty` decimal(12,3) NOT NULL DEFAULT '0.000',
  `description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `qty`, `description`) VALUES
(3, 't00003', 'Телефон 3', '6829.00', '26.000', 'afsajlkljkljkl'),
(4, 't00004', 'Телефон 4', '5886.00', '5.000', ' Телефон 4 '),
(6, 't00005', 'Телефон 5', '5881.00', '6.000', ''),
(7, 't00006', 'Телефон 6', '7400.00', '4.000', 'sdfsdf sdfsdf sdfsdf'),
(52, 't0007', 'Телефон 7', '54007.00', '25.000', 'dsdfsdf'),
(53, 't0008', 'Телефон 8', '21003.00', '5.000', 'вапвапвапва'),
(63, 't0013', 'Телефон 10', '2600.00', '20.000', 'sdfsdfsdf');

-- --------------------------------------------------------

--
-- Структура таблиці `sales_order`
--

CREATE TABLE `sales_order` (
  `order_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `sales_order`
--

INSERT INTO `sales_order` (`order_id`, `customer_id`, `datetime`) VALUES
(1, 1, '2019-10-24 15:29:59'),
(2, 1, '2019-10-24 15:31:17'),
(3, 1, '2019-10-24 15:44:08'),
(4, 1, '2019-10-24 15:44:10'),
(9, 32, '2021-04-21 15:20:59');

-- --------------------------------------------------------

--
-- Структура таблиці `sales_orderitem`
--

CREATE TABLE `sales_orderitem` (
  `orderitem_id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `qty` decimal(12,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `sales_orderitem`
--

INSERT INTO `sales_orderitem` (`orderitem_id`, `order_id`, `product_id`, `qty`) VALUES
(3, 2, 3, '1.000'),
(4, 2, 4, '2.000'),
(5, 9, 63, '2.000'),
(6, 9, 7, '1.000');

-- --------------------------------------------------------

--
-- Структура таблиці `shopping`
--

CREATE TABLE `shopping` (
  `orderitem_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `result` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shopping`
--

INSERT INTO `shopping` (`orderitem_id`, `customer_id`, `product_id`, `qty`, `datetime`, `result`) VALUES
(3, 1, 4, 1, '2019-11-21 10:53:59', 1),
(4, 32, 7, 1, '2021-01-01 12:23:34', 1),
(5, 32, 63, 2, '2021-01-01 12:23:34', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `test`
--

CREATE TABLE `test` (
  `id` int NOT NULL,
  `name` varchar(64) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `test`
--

INSERT INTO `test` (`id`, `name`, `date`) VALUES
(1, 'test', '2019-10-22 18:44:59');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Індекси таблиці `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_ORDER_CUSTOMER` (`customer_id`);

--
-- Індекси таблиці `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  ADD PRIMARY KEY (`orderitem_id`),
  ADD KEY `FK_ORDERITEM_ORDER` (`order_id`),
  ADD KEY `FK_ORDERITEM_PRODUCT` (`product_id`);

--
-- Індекси таблиці `shopping`
--
ALTER TABLE `shopping`
  ADD PRIMARY KEY (`orderitem_id`),
  ADD KEY `FK_ORDERITEM_ORDER` (`customer_id`),
  ADD KEY `FK_ORDERITEM_PRODUCT` (`product_id`);

--
-- Індекси таблиці `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблиці `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблиці `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT для таблиці `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблиці `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  MODIFY `orderitem_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `shopping`
--
ALTER TABLE `shopping`
  MODIFY `orderitem_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблиці `test`
--
ALTER TABLE `test`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `sales_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  ADD CONSTRAINT `sales_orderitem_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `sales_order` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_orderitem_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `shopping`
--
ALTER TABLE `shopping`
  ADD CONSTRAINT `shopping_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE `cart` (
  `UserID` int(10) NOT NULL,
  `ProductID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `CartID` int(10) NOT NULL
) 

CREATE TABLE `payment_option` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `pay_fullname` varchar(100) DEFAULT NULL,
  `pay_alias` varchar(20) DEFAULT NULL,
  `pay_type` enum('PayPal','CreditCard','DebitCard','AfterPay','COD','Other') DEFAULT 'Other',
  `email` varchar(100) DEFAULT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `card_ccv` varchar(5) DEFAULT NULL,
  `card_expiry` date DEFAULT NULL,
  `cod_id` varchar(30) DEFAULT NULL
)

CREATE TABLE `product` (
  `ProductID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `shipping_code` varchar(40) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp()
) 


CREATE TABLE `shop_order` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `total_cost` float(10,2) DEFAULT 0.00,
  `order_date` datetime DEFAULT current_timestamp()
) 

CREATE TABLE `user` (
  `UserID` int(10) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
)
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`);


ALTER TABLE `payment_option`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);


ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `shop_order`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`);


ALTER TABLE `cart`
  MODIFY `CartID` int(10) NOT NULL AUTO_INCREMENT;


ALTER TABLE `product`
  MODIFY `ProductID` int(10) NOT NULL AUTO_INCREMENT;


ALTER TABLE `user`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT;




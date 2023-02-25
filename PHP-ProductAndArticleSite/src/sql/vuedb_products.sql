-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 25 jan 2022 om 13:39
-- Serverversie: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP-versie: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vuedb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'bread'),
(3, 'vegetables');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `image`, `category_id`) VALUES
(1, 'Ciabatta', '2.50', 'Ciabatta (which translates to slipper!) is an Italian bread made with wheat flour, salt, yeast, and water. Though it\'s texture and crust vary slightly throughout Italy, the essential ingredients remain the same. Ciabatta is best for sandwiches and paninis, naturally.', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/957759184-1529703875.jpg?crop=1.00xw:0.645xh;0,0.104xh&resize=980:*', 1),
(2, 'Whole Wheat Bread', '2.00', 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/whole-wheat-bread-horizontal-1-jpg-1590195849.jpg?crop=0.735xw:0.735xh;0.187xw,0.128xh&resize=980:*', 1),
(3, 'Artichoke', '1.50', 'Artichokes contain an unusual organic acid called cynarin which affects taste and may be the reason why water appears to taste sweet after eating artichokes. The flavour of wine is similarly altered and many wine experts believe that wine shouldn’t accompany artichokes.', 'https://www.vegetables.co.nz/assets/vegetables/_resampled/FillWyI0MDAiLCIzMDAiXQ/artichokes-globe.png', 3),
(4, 'Asparagus ', '3.00', 'Asparagus originated in the Eastern Mediterranean and was a favourite of the Greeks and Romans who used it as a medicine. Varieties of asparagus grow wild in parts of Europe, Turkey, Africa, Middle East and Asia.', 'https://www.vegetables.co.nz/assets/vegetables/_resampled/FillWyI0MDAiLCIzMDAiXQ/asparagus.png', 3);
(5, 'Whole Wheat Bread', '2.00', 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/whole-wheat-bread-horizontal-1-jpg-1590195849.jpg?crop=0.735xw:0.735xh;0.187xw,0.128xh&resize=980:*', 1),
(6, 'Summer strawberries', '1.50', 'The strawberry (Fragaria ananassa) originated in Europe in the 18th century. It is a hybrid of two wild strawberry species from North America and Chile. Strawberries are bright red, juicy, and sweet. They’re an excellent source of vitamin C and manganese and also contain decent amounts of folate (vitamin B9) and potassium.', 'blue-strawberry.jpg', 3),
(7, 'Cooked brocolli', '1.00', '“I say it’s spinach and I say to hell with it.” That’s more or less what old man Vega said the first time he tasted broccoli. This was back in the early 70’s when broccoli was unknown in local Spanish markets. In our small garden plot, we were growing just two vegetables, broccoli in the winter and sweet corn in the summer.', 'broccoli.jpg', 2),
(8, 'Ciabatta', '4.55', 'Ciabatta (which translates to slipper!) is an Italian bread made with wheat flour, salt, yeast, and water. Though it\'s texture and crust vary slightly throughout Italy, the essential ingredients remain the same. Ciabatta is best for sandwiches and paninis, naturally.', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/957759184-1529703875.jpg?crop=1.00xw:0.645xh;0,0.104xh&resize=980:*', 1),
(9, 'New York Sandwich', '4.55', 'Bring the aroma of homemade bread to your kitchen by baking fresh loaves of these favorite recipes, including French bread, banana bread, cinnamon bread, garlic bread and more. If you’d like to learn how to bake bread, here’s a wonderful place to start. This easy white bread bakes up deliciously golden brown. There’s nothing like the homemade aroma wafting through my kitchen as it bakes. —Sandra Anderson, New York, New York. \r\n\r\nDirections\r\nIn a large bowl, dissolve yeast and 1/2 teaspoon sugar in warm water; let stand until bubbles form on surface. Whisk together remaining 3 tablespoons sugar, salt and 3 cups flour. Stir oil into yeast mixture; pour into flour mixture and beat until smooth. Stir in enough remaining flour, 1/2 cup at a time, to form a soft dough.\r\nTurn onto a floured surface; knead until smooth and elastic, 8-10 minutes. Place in a greased bowl, turning once to grease the top. Cover and let rise in a warm place until doubled, 1-1/2 to 2 hours.\r\nPunch dough down. Turn onto a lightly floured surface; divide dough in half. Shape each into a loaf. Place in 2 greased 9x5-in. loaf pans. Cover and let rise until doubled, 1 to 1-1/2 hours.\r\nBake at 375° until loaf is golden brown and sounds hollow when tapped or has reached an internal temperature of 200°, 30-35 minutes. Remove from pans to wire racks to cool.', 'https://divinelifestyle.com/wp-content/uploads/2019/04/Polska-finish-2.jpg?crop=1.00xw:0.645xh;0,0.104xh&resize=980:*', 2),
(10, 'Spaghetti Classic', '7.99', 'Pel de knoflook en ui, snipper de ui en snijd de knoflook fijn. Schil de wortel en snijd samen met de bleekselderij in kleine blokjes.Verhit de olijfolie in een koekenpan en bak het gehakt knapperig. Laat uitlekken op een stuk keukenpapier. Verhit nog een scheutje in een koekenpan en bak de ui, knoflook, wortel en bleekselderij. Blus af met rode wijn. Voeg zodra de rode wijn een beetje ingekookt is de blikken tomaat, het gehakt en de Verstegen Italian Blend voor Pasta toe. Laat voor ongeveer 10 minuten pruttelen.', 'spaghetti-classic.jpg', 2),
(11, 'Red strawberries', '5.00', 'The strawberry (Fragaria ananassa) originated in Europe in the 18th century. It is a hybrid of two wild strawberry species from North America and Chile. Strawberries are bright red, juicy, and sweet. They’re an excellent source of vitamin C and manganese and also contain decent amounts of folate (vitamin B9) and potassium.', 'strawberry.jpg', 3);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`category_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

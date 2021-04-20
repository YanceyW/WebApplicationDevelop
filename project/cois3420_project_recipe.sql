-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2021 at 06:16 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `claireli`
--

-- --------------------------------------------------------

--
-- Table structure for table `cois3420_project_recipe`
--

CREATE TABLE `cois3420_project_recipe` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `username` text NOT NULL,
  `private` text NOT NULL,
  `tags` text DEFAULT NULL,
  `rating` int(11) DEFAULT 0,
  `num_rating` int(11) NOT NULL DEFAULT 0,
  `image` text DEFAULT NULL,
  `serving` int(11) NOT NULL,
  `difficulty` text NOT NULL,
  `prep_hour` int(11) NOT NULL,
  `prep_min` int(11) NOT NULL,
  `cook_hour` int(11) NOT NULL,
  `cook_min` int(11) NOT NULL,
  `recipe_ingredients` text NOT NULL,
  `recipe_directions` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cois3420_project_recipe`
--

INSERT INTO `cois3420_project_recipe` (`ID`, `user_id`, `title`, `username`, `private`, `tags`, `rating`, `num_rating`, `image`, `serving`, `difficulty`, `prep_hour`, `prep_min`, `cook_hour`, `cook_min`, `recipe_ingredients`, `recipe_directions`, `create_date`) VALUES
(1, 6, 'title8', 'john', 'Y', 'aaaa', 0, 0, '', 2, 'medium', 30, 0, 0, 50, 'wwwww', 'qqqqqq', '0000-00-00 00:00:00'),
(2, 6, 'title', 'john', 'Y', 'tags', 0, 0, '181009235532_B0AFA082-9A4B-41B5-A96D-E7016C36FAE4.jpeg', 1, 'easy', 0, 20, 1, 30, 'Creating a recipe: The user should be able to create a new recipe , \r\nby entering at minimum: a title, an ingredients list, instructions, \r\na rating, a checkbox to indicate of the recipe should be private or\r\nnot, an optional image and at least 3 other fields of your choice\r\n(cook time, source, etc) .\r\ndatabase should, not entered by the user.', 'Creating a recipe: The user should be able to create a new recipe , by entering at minimum: a title, an ingredients list, instructions, a rating, a checkbox to indicate of the recipe should be private or not, an optional image and at least 3 other fields of your choice (cook time, source, etc) .\r\nThe database should also store the date the recipe was created, but that can be automated, not entered by the user.', '0000-00-00 00:00:00'),
(15, 12345, 'Recipe Title', 'clili', 'Y', '', 3, 4, 'image1.jpg', 3, 'medium', 0, 40, 1, 25, 'aaaa', 'bbbb', '0000-00-00 00:00:00'),
(16, 6, 'Recipe Title:', 'john', 'Y', '', 2, 1, 'image1.jpg', 1, 'easy', 0, 10, 0, 40, 'sssss', 'dddddd', '0000-00-00 00:00:00'),
(17, 6, 'Recipe Title:', 'john', 'Y', '', 3, 1, 'image1.jpg', 1, 'easy', 0, 10, 0, 40, 'sssss', 'dddddd', '0000-00-00 00:00:00'),
(18, 6, 'john favorite', 'john', 'N', 'asian', 0, 0, '', 4, '2', 0, 10, 0, 20, '4 small to medium tomatoes (about 500 g, 1 pound)\r\n1 scallion\r\n4 eggs\r\n3/4 tsp salt (divided, or to taste)\r\n1/4 tsp white pepper\r\n1/2 tsp sesame oil\r\n1 tsp shaoxing wine\r\n3 tbsp vegetable oil (divided)\r\n2 tsp sugar\r\n1/4-1/2 cup water', '    Start by cutting tomatoes into small wedges and finely chop the scallion.\r\n    Crack 4 eggs into a bowl and season with ¼ teaspoon salt, ¼ teaspoon white pepper, ½ teaspoon sesame oil, and 1 teaspoon Shaoxing wine. Beat eggs for a minute.\r\n    Preheat the wok over medium heat until it just starts to smoke. Then add 2 tablespoons of oil and immediately add the eggs. Scramble the eggs and remove from the wok immediately. Set aside.\r\n    Add 1 more tablespoon oil to the wok, turn up the heat to high, and add the tomatoes and scallions. Stir-fry for 1 minute, and then add 2 teaspoons sugar, ½ teaspoon salt, and ¼ cup water (if your stove gets very hot and liquid tends to cook off very quickly in your wok, add a little more water). Add the cooked eggs.\r\n    Mix everything together, cover the wok, and cook for 1-2 minutes, until the tomatoes are completely softened.\r\n    Uncover, and continue to stir-fry over high heat until the sauce thickens to your liking. Serve! ', '0000-00-00 00:00:00'),
(19, 6, 'sunrise', 'john', 'N', 'dinner', 0, 0, '', 1, '1', 0, 10, 0, 10, '4 patty LGCM Bacon and Cheddar Burger \r\n4 Hamburger Buns\r\n8 slice Tomatoes\r\n4 Fried Eggs\r\n4 slice Cheddar Cheese\r\n3 Tbsp Butter\r\nSea Salt\r\nBlack Pepper', 'Heat grill to high heat\r\n\r\nPlace patties on the grill and cook until preferred doneness approximately 4 minutes per side.\r\n\r\nA few minutes before the burgers are ready to take off the grill, brush buns with melted butter. Place buns on grill until a golden brown.\r\n\r\nWhile burgers are grilling, heat a skillet to medium & fry each egg, one at a time. Place fried eggs off to side.\r\n\r\nWhile burgers are still on the grill, add the tomatoes, then the fried egg, and top off with a slice of Cheddar Cheese (or Hot Pepper Cheese for a spicier burger).\r\n\r\nOnce the cheese is melted, remove the burger from the grill, place on top of the toasted bun and enjoy!', '0000-00-00 00:00:00'),
(20, 6, 'BBQ Rib', 'john', 'N', 'BBQ', 4, 1, '', 2, 'medium', 0, 30, 1, 0, '1/4 cup brown sugar\r\n\r\n2 tablespoons chili powder\r\n\r\nKosher salt and freshly ground black pepper\r\n\r\n1 teaspoon dried oregano\r\n\r\n1/2 teaspoon cayenne pepper\r\n\r\n1/2 teaspoon garlic powder\r\n\r\n1/2 teaspoon onion powder\r\n\r\n2 racks baby back ribs\r\n\r\n1 cup low-sodium chicken broth\r\n\r\n2 tablespoons apple cider vinegar\r\n\r\n1 cup barbecue sauce', 'Combine the brown sugar, chili powder, 1 tablespoon salt, 1 teaspoon black pepper, the oregano, cayenne, garlic powder and onion powder in a small bowl and rub the mixture on both sides of the ribs. Cover and refrigerate 1 hour or overnight. \r\n\r\nPreheat the oven to 250 degrees F. In a roasting pan, combine the broth and vinegar. Add the ribs to the pan. Cover with foil and tightly seal. Bake 2 hours. Remove the ribs from the pan and place them on a platter. Pour the liquid from the pan into a saucepan and bring to a boil. Lower the heat to a simmer and cook until reduced by half. Add the barbecue sauce. \r\n\r\nPreheat an outdoor grill to medium high. Put the ribs on the grill and cook about 5 minutes on each side, until browned and slightly charred. Cut the ribs between the bones and toss them in a large bowl with the sauce. Serve hot. ', '0000-00-00 00:00:00'),
(24, 6, 'title3', 'john', 'Y', 'xxxx', 0, 0, '', 1, 'easy', 0, 20, 1, 5, 'cccccc', 'ssssss', '0000-00-00 00:00:00'),
(25, 6, 'title8', 'john', 'Y', 'dinner', 4, 11, 'image1.jpg', 2, 'medium', 30, 0, 0, 50, 'qqqqq', 'qqqqqq', '0000-00-00 00:00:00'),
(26, 6, 'egg', 'john', 'Y', 'bca', 3, 2, '', 1, 'easy', 0, 5, 0, 15, 'vvvvv', 'wwwwww', '0000-00-00 00:00:00'),
(27, 6, 'title7', 'john', 'Y', 'abc', 0, 0, '', 2, 'easy', 0, 15, 0, 30, 'ffff', 'gggg', '0000-00-00 00:00:00'),
(29, 6, 'title00', 'john', 'Y', 'asd', 0, 0, 'image1.jpg', 5, 'hard', 1, 0, 3, 20, 'llllll', 'kkkkkk', '0000-00-00 00:00:00'),
(30, 6, 'title5', 'john', 'Y', 'cccc', 0, 0, '', 1, 'easy', 0, 20, 1, 0, 'hhhh', 'ggggg', '0000-00-00 00:00:00'),
(38, 6, '12345', 'john', 'N', '67890', 0, 0, '', 3, 'medium', 0, 40, 1, 0, '12345', '12456', '0000-00-00 00:00:00'),
(40, 6, 'new', 'john', 'N', 'test', 0, 0, '', 1, 'easy', 1, 20, 1, 10, 'a, b and c', '1, 2 and 3', '0000-00-00 00:00:00'),
(41, 6, 'Title 11', 'john', 'N', '666', 0, 0, '', 1, 'easy', 0, 15, 0, 15, 'kkk', 'ccc', '2021-04-18 14:12:34'),
(42, 6, 'title 12', 'john', 'N', 'vvv', 0, 0, '', 1, 'medium', 0, 30, 1, 0, 'cccc', 'vvvv', '2021-04-18 17:19:47'),
(43, 6, 'title 13', 'john', 'Y', 'qqq', 0, 0, '', 1, 'easy', 0, 15, 1, 0, 'dddd', 'ffff', '2021-04-18 18:00:53'),
(50, 6, 'apple', 'john', 'N', 'ddd', 0, 0, '', 1, 'easy', 0, 10, 0, 20, 'eee', 'www', '2021-04-19 21:03:30'),
(51, 6, 'Title 14', 'john', 'N', 'vvv', 0, 0, '', 3, 'hard', 1, 0, 2, 0, 'fff', 'ggg', '2021-04-19 21:05:07'),
(52, 19, 'My first recipes', 'abc', 'N', 'Franch', 4, 1, 'Lyonnaise Potatoes.jpg', 4, 'medium', 0, 10, 0, 35, '2 lb.russet potatoes, peeled and sliced into 1/4\" thick rounds\r\n3 tbsp.butter\r\n3 tbsp.vegetable oil\r\n2small onions, thinly sliced\r\n1/4 c.parsley, chopped\r\nKosher salt\r\n', 'Cover potatoes with 2” cold water. Bring to a boil and let simmer until crisp tender, about 4 minutes. Drain completely. \r\n\r\nHeat 1 tablespoon butter and 1 tablespoon oil in a large nonstick skillet until shimmering, add 1/2 potatoes and 1/2 of the onions. Let cook until potatoes are starting to crisp and the onions are golden, about 5 minutes. Add the rest of the butter, oil, potatoes, and onions and continue to cook, mixing until all onions are softened and browned, about 15 minutes.\r\n\r\nRemove from heat and stir in parsley. Season with salt and pepper before serving.', '2021-04-20 01:15:52'),
(53, 22, 'first recipe', 'bcd', 'Y', 'breakfast', 0, 0, 'image1.jpg', 2, 'medium', 0, 20, 1, 10, '4 patty LGCM Bacon and Cheddar Burger 4 Hamburger Buns 8 slice Tomatoes 4 Fried Eggs 4 slice Cheddar Cheese 3 Tbsp Butter Sea Salt Black Pepper', 'Heat grill to high heat Place patties on the grill and cook until preferred doneness approximately 4 minutes per side. A few minutes before the burgers are ready to take off the grill, brush buns with melted butter. Place buns on grill until a golden brown. While burgers are grilling, heat a skillet to medium & fry each egg, one at a time. Place fried eggs off to side. While burgers are still on the grill, add the tomatoes, then the fried egg, and top off with a slice of Cheddar Cheese (or Hot Pepper Cheese for a spicier burger). Once the cheese is melted, remove the burger from the grill, place on top of the toasted bun and enjoy!', '2021-04-20 01:46:02'),
(54, 6, 'My first recipes copy', 'abc', 'N', 'Franch', 4, 1, 'image1.jpg', 4, 'medium', 0, 10, 0, 35, '2 lb.russet potatoes, peeled and sliced into 1/4\" thick rounds\r\n3 tbsp.butter\r\n3 tbsp.vegetable oil\r\n2small onions, thinly sliced\r\n1/4 c.parsley, chopped\r\nKosher salt\r\n', 'Cover potatoes with 2” cold water. Bring to a boil and let simmer until crisp tender, about 4 minutes. Drain completely. \r\n\r\nHeat 1 tablespoon butter and 1 tablespoon oil in a large nonstick skillet until shimmering, add 1/2 potatoes and 1/2 of the onions. Let cook until potatoes are starting to crisp and the onions are golden, about 5 minutes. Add the rest of the butter, oil, potatoes, and onions and continue to cook, mixing until all onions are softened and browned, about 15 minutes.\r\n\r\nRemove from heat and stir in parsley. Season with salt and pepper before serving.', '2021-04-20 02:17:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cois3420_project_recipe`
--
ALTER TABLE `cois3420_project_recipe`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cois3420_project_recipe`
--
ALTER TABLE `cois3420_project_recipe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

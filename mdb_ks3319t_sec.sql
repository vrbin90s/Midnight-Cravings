-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 01:38 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdb_ks3319t_sec`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(25) DEFAULT NULL,
  `author_email` varchar(50) DEFAULT NULL,
  `password` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_email`, `password`) VALUES
(25, 'Kestutis Sebelskis', 'a_admin@admin.com', 'a0e391972d368aae67e5b7998cebccdc'),
(29, 'Boris Johnson', 'editor@editor.com', 'a0e391972d368aae67e5b7998cebccdc'),
(30, 'Gordon  Cooker', 's_admin@admin.com', 'a0e391972d368aae67e5b7998cebccdc'),
(31, 'Bruce Almighty', 'user@user.com', 'a0e391972d368aae67e5b7998cebccdc');

-- --------------------------------------------------------

--
-- Table structure for table `author_role`
--

CREATE TABLE `author_role` (
  `authorid` int(11) NOT NULL,
  `roleid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author_role`
--

INSERT INTO `author_role` (`authorid`, `roleid`) VALUES
(25, 'Account Administrator'),
(25, 'Content Editor'),
(25, 'Site Administrator'),
(29, 'Content Editor'),
(30, 'Content Editor'),
(30, 'Site Administrator'),
(31, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(3, 'Desserts'),
(6, 'Breakfast'),
(8, 'Pasta'),
(11, 'Soup'),
(12, 'Lunch');

-- --------------------------------------------------------

--
-- Table structure for table `cook_time`
--

CREATE TABLE `cook_time` (
  `cook_time_id` int(11) NOT NULL,
  `cook_time` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cook_time`
--

INSERT INTO `cook_time` (`cook_time_id`, `cook_time`) VALUES
(139, '5'),
(140, '20'),
(141, '60'),
(142, '1'),
(143, '20'),
(144, '35'),
(145, '10'),
(146, '99'),
(147, '77'),
(148, '87'),
(149, '20'),
(150, '15'),
(151, '20'),
(152, '60'),
(156, '99'),
(157, '2'),
(158, '23'),
(159, '21'),
(160, '45'),
(161, '12'),
(162, '21'),
(163, '12'),
(164, '22'),
(165, '12'),
(166, '23'),
(167, '23'),
(168, '21'),
(169, '12'),
(170, '12'),
(171, '12'),
(172, '21'),
(173, '99');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredient_id` int(11) NOT NULL,
  `ingredients` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ingredient_id`, `ingredients`) VALUES
(187, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>2 slices of any white bread.</li>\r\n<li>2 large eggs</li>\r\n<li>Some salt and ground black pepper to taste! Yuuumy!</li>\r\n</ul>'),
(188, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>2 cups of sifted flour.</li>\r\n<li>1 teaspoon of baking powder.</li>\r\n<li>1 teaspoon salt.</li>\r\n<li>4 large eggs.</li>\r\n<li>2 cups of buttermilk.</li>\r\n<li>1 cup of melted butter.</li>\r\n</ul>'),
(189, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>2 heads cauliflower.</li>\r\n<li>Separated into florets.</li>\r\n<li>3 cloves garlic, chopped.</li>\r\n<li>2 shallots, chopped.</li>\r\n<li>1 tablespoon olive oil.</li>\r\n<li>3 cups chicken broth.</li>\r\n<li>1 cup water.</li>\r\n<li>1 bay leaf.</li>\r\n<li>Salt and pepper to taste.</li>\r\n</ul>'),
(190, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>2 cans of tomato sauce.</li>\r\n<li>2 cups of king prawns.</li>\r\n<li>Sea vegetables and a turtle shell.</li>\r\n</ul>'),
(191, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>2 cans of chicken broth,</li>\r\n<li>2 coconuts.</li>\r\n<li>Some salt and a lot of pepper.</li>\r\n</ul>'),
(192, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>&frac34; cup scalded milk.</li>\r\n<li>⅓ cup granulated sugar.</li>\r\n<li>&frac14; teaspoon salt.</li>\r\n<li>1 (.25 ounce) envelope active dry yeast.</li>\r\n<li>&frac14; cup warm water.</li>\r\n<li>4 cups sifted all-purpose flour.</li>\r\n<li>2 eggs, beaten.</li>\r\n<li>Oil for deep frying.</li>\r\n</ul>'),
(193, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>4 eggs, lightly beaten.</li>\r\n<li>1&thinsp;⅓ cups milk.</li>\r\n<li>2 tablespoons butter, melted.</li>\r\n<li>1 cup all-purpose flour.</li>\r\n<li>2 tablespoons white sugar.</li>\r\n<li>1 teaspoon salt.</li>\r\n</ul>'),
(197, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>2&thinsp;&frac14; cups shell pasta.</li>\r\n<li>2 cups broccoli florets</li>\r\n<li>1 (10.75 ounce) can reduced-fat</li>\r\n<li>Condensed broccoli</li>\r\n<li>Cheese soup</li>\r\n<li>1 cup milk 1 (4.5 ounce)</li>\r\n<li>1 can mushrooms &frac14; cup</li>\r\n<li>Chopped onion</li>\r\n<li>1 tablespoon spicy</li>\r\n<li>Brown mustard</li>\r\n<li>Salt and ground black pepper to taste</li>\r\n<li>1&thinsp;&frac12; cups diced cooked ham</li>\r\n</ul>'),
(198, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>&frac12; (1 ounce) packet Hidden Valley&reg; Original Ranch&reg; Salad Dressing &amp; Seasoning</li>\r\n<li>&frac12; cup milk.</li>\r\n<li>&frac12; cup mayonnaise.</li>\r\n<li>3 tablespoons olive oil or vegetable oil</li>\r\n<li>2 zucchini, cut into 1/4-inch slices</li>\r\n<li>1 cup frozen broccoli florets.</li>\r\n<li>1 red bell pepper or green bell pepper, cut into small chunks</li>\r\n<li>1 cup cherry tomatoes,</li>\r\n<li>Halved 4 medium radish'),
(199, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>&frac12; (16 ounce) package linguine pasta.</li>\r\n<li>4 tablespoons butter.</li>\r\n<li>2 cloves garlic, minced.</li>\r\n<li>1 pound jumbo shrimp, peeled and deveined.</li>\r\n<li>2 tablespoons Pinot Grigio wine.</li>\r\n<li>2 teaspoons lemon juice, or to taste &frac12; cup half-and-half &frac14; cup finely shredded Parmesan cheese.</li>\r\n<li>2 tablespoons chopped fresh parsley, or to taste Bucket of oysters</li>\r\n</ul>'),
(200, '<p><strong>You will need the following:</strong></p>\r\n<ul>\r\n<li>2 cups white sugar</li>\r\n<li>1&thinsp;&frac34; cups all-purpose flour</li>\r\n<li>&frac34; cup unsweetened cocoa powder</li>\r\n<li>1&thinsp;&frac12; teaspoons baking powder</li>\r\n<li>1&thinsp;&frac12; teaspoons baking soda</li>\r\n<li>1 teaspoon salt</li>\r\n<li>2 eggs</li>\r\n<li>1 cup milk</li>\r\n<li>&frac12; cup vegetable oil</li>\r\n<li>2 teaspoons vanilla extract</li>\r\n<li>1 cup boiling water</li>\r\n</ul>'),
(230, '<p>sasa</p>'),
(231, '<p>sasasa</p>'),
(232, '<p>as</p>'),
(233, '<p>12</p>'),
(234, '<p>as</p>'),
(235, '<p>Yes</p>');

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `instructions_id` int(11) NOT NULL,
  `recipe_instructions` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`instructions_id`, `recipe_instructions`) VALUES
(51, '<ol>\r\n<li>Cut a hole with your soldier knife from the center of the bread slice; lay in the hot skillet.</li>\r\n<li>When the side facing down is lightly toasted, about 2 minutes, flip and crack the egg into the hole; season with salt and pepper.</li>\r\n<li>Continue to cook until the egg is cooked and mostly firm.</li>\r\n<li>Flip again and cook 1 minute more to assure doneness on both sides. Yhaaaamy!</li>\r\n</ol>'),
(52, '<ol>\r\n<li>Preheat a waffle iron until it starts to make funny noises.</li>\r\n<li>Spray waffle iron with non-stick cooking spray or just rub in a brick of butter.</li>\r\n<li>Whisk flour, baking powder, baking soda, and salt together in a bowl.</li>\r\n<li>Dance with the bowl a little and then pour everything into the preheated waffle iron. Yaaaammmy before you know it!</li>\r\n</ol>'),
(53, '<ol>\r\n<li>Preheat the oven to 425 degrees F (220 degrees C).</li>\r\n<li>In a large bowl, toss cauliflower pieces with olive oil, garlic and shallots.</li>\r\n<li>Spread out in a roasting pan or baking sheet with sides.</li>\r\n<li>When the cauliflower is done, transfer to a soup pot and pour in the chicken broth and water.</li>\r\n<li>Season with thyme and the bay leaf and bring to a boil. Cook over medium heat for 30 minutes.</li>\r\n<li>Remove and discard the bay leaf. Puree the soup i</li>\r\n</ol>'),
(54, '<p>Preheat oven until it starts to make funny noises than pour everything in the bowl and leave it in the oven for the 45 minutes.</p>'),
(55, '<ol>\r\n<li>Put the bowl on the open fire.</li>\r\n<li>Cook it for about 20 minutes.</li>\r\n<li>Once it\'s done grab the bawl with the leaves - don\'t burn your hands! and leave it in the sea to cool it down.</li>\r\n</ol>\r\n<p>P.S. If after five minutes you still find your soup you will have a fantastic lunch!</p>'),
(56, '<ol>\r\n<li><strong>Prepare the dough.</strong>&nbsp;The dough comes together with a mixer. You can also make the dough by hand, but it requires a bit of arm muscle. After the dough comes together in the mixing bowl, knead it for 2 minutes.</li>\r\n<li><strong>Let the dough rise.&nbsp;</strong>In a relatively warm environment, the dough rises in about 90 minutes.</li>\r\n<li><strong>Punch down the dough to release the air.</strong></li>\r\n<li><strong>Roll &amp; cut into doughnuts.</strong>&nbsp;Roll th'),
(57, '<ol>\r\n<li>In large bowl, whisk together eggs, milk, melted butter, flour sugar and salt until smooth.</li>\r\n<li>Heat a medium-sized skillet or crepe pan over medium heat.</li>\r\n<li>Grease pan with a small amount of butter or oil applied with a brush or paper towel.</li>\r\n<li>Using a serving spoon or small ladle, spoon about 3 tablespoons crepe batter into hot pan, tilting the pan so that bottom surface is evenly coated.</li>\r\n<li>Cook over medium heat, 1 to 2 minutes on a side, or until golden b'),
(61, '<ol>\r\n<li>Bring a large pot of lightly salted water to a boil; add shell pasta and cook, stirring occasionally, until tender yet firm to the bite, about 9 minutes; drain.</li>\r\n<li>Combine broccoli florets, broccoli soup, milk, mushrooms with liquid, onion, mustard, salt, and pepper together in a large skillet; bring to a boil.</li>\r\n<li>Reduce heat to low and cook, stirring occasionally, until broccoli is tender, about 5 minutes.</li>\r\n<li>Stir pasta and ham into broccoli mixture and cook, stir'),
(62, '<ol>\r\n<li>Cook pasta according to package directions.</li>\r\n<li>Rinse with cool water and drain.</li>\r\n<li>Combine Hidden Valley&reg; Original Ranch Salad&reg; Dressing &amp; Seasoning Mix with milk and mayonnaise in a bowl, creating 1 cup dressing. In a small bowl, whisk the dressing together with the oil until emulsified.</li>\r\n<li>In a large bowl, add the pasta and the remaining ingredients. Add the dressing and toss until well coated. Chill covered for 1 hour before serving.</li>\r\n</ol>'),
(63, '<ol>\r\n<li>Bring a large pot of lightly salted water to a boil.</li>\r\n<li>Cook linguine at a boil until tender yet firm to the bite, about 8 minutes.</li>\r\n<li>While pasta cooks, melt 2 tablespoons butter in a skillet over medium heat.</li>\r\n<li>Add garlic and cook until fragrant and lightly browned, about 1 minute.</li>\r\n<li>Add shrimp and cook until tails start curling in, about 2 minutes per side.</li>\r\n<li>Add remaining butter, Pinot Grigio, lemon juice, half-and-half, and Parmesan cheese.</l'),
(64, '<ol>\r\n<li>Preheat oven to 350 degrees F (175 degrees C).</li>\r\n<li>Grease and flour two nine inch round pans.</li>\r\n<li>In a large bowl, stir together the sugar, flour, cocoa, baking powder, baking soda and salt.</li>\r\n<li>Add the eggs, milk, oil and vanilla, mix for 2 minutes on medium speed of mixer.</li>\r\n<li>Stir in the boiling water last. Batter will be thin.</li>\r\n<li>Pour evenly into the prepared pans. Bake 30 to 35 minutes in the preheated oven, until the cake tests done with a toothpick'),
(94, '<p>sasa</p>'),
(95, '<p>sa</p>'),
(96, '<p>as</p>'),
(97, '<p>12</p>'),
(98, '<p>as</p>'),
(99, '<p>Ommm</p>');

-- --------------------------------------------------------

--
-- Table structure for table `prep_time`
--

CREATE TABLE `prep_time` (
  `prep_time_id` int(11) NOT NULL,
  `prep_time` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prep_time`
--

INSERT INTO `prep_time` (`prep_time_id`, `prep_time`) VALUES
(154, '8'),
(155, '20'),
(156, '30'),
(157, '15'),
(158, '20'),
(159, '10'),
(160, '99'),
(161, '77'),
(162, '99'),
(163, '15'),
(164, '40'),
(165, '15'),
(166, '30'),
(167, '23'),
(170, '99'),
(171, '2'),
(172, '23'),
(173, '2'),
(174, '45'),
(175, '21'),
(176, '21'),
(177, '12'),
(178, '22'),
(179, '21'),
(180, '23'),
(181, '23'),
(182, '21'),
(183, '12'),
(184, '12'),
(185, '12'),
(186, '21'),
(187, '99');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(41, 'sa', '16b05cddf58fe3fb', '$2y$10$2f.RdWIpsOoiZ.6PmLTuteYBNY9jCCRQ3x26daQJpLyvZ9nzbhOkW', '1615315820');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` varchar(25) DEFAULT NULL,
  `recipe_description` varchar(250) DEFAULT NULL,
  `recipe_upload_date` date DEFAULT NULL,
  `recipe_image` varchar(150) DEFAULT NULL,
  `recipe_author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `recipe_name`, `recipe_description`, `recipe_upload_date`, `recipe_image`, `recipe_author_id`) VALUES
(204, 'Egg in the Hole', '<p>Egg in the Hole! Start your morning like a champion by throwing those eggs \"down in the hole\". A brilliant and simple morning booster recipe that you can make it in no time. All you need is just those big dam eggs!</p>', '2021-03-23', 'mae-mu-WzheIfs9V-U-unsplash.jpg', 29),
(205, 'Horrible Buttermilk Waffl', '<p>Those were the days then we only eat these horrible buttermilk waffles - happy days! It will certainly take you down the memory line and remind you of those good days than the only food you knew was waffles.</p>', '2021-03-23', 'waffles.jpg', 30),
(206, 'Dream Soup', '<p>This is one of my most favourite soups! Happy to share it with you guys! Enjoy!</p>', '2021-03-23', 'ella-olsson-fxJTl_gDh28-unsplash.jpg', 31),
(207, 'Sea Weed', '<p>It\'s not the soup - it\'s an atomic Bomb! Perfect dish for soup lovers!</p>', '2021-03-23', 'brooke-lark-tWkA48kabZE-unsplash.jpg', 29),
(208, 'Pirate Soup', '<p>Back in the days than I used to be a pirate, this was my favourite soup and I\'m happy to share this recipe with you all mates. Yaaaarrr!</p>', '2021-03-23', 'chuttersnap--ps36yg89Lg-unsplash.jpg', 31),
(209, 'Doughnuts', '<p>Doughnuts that my mom made for you! Enjoy the recipe, guys!</p>', '2021-03-23', 'anastasiia-chepinska-qZ6uvJHLHFc-unsplash.jpg', 25),
(210, 'Tasty Crepes', '<p>Traditional crepe recipe. Happy to share with you lot!</p>', '2021-03-23', 'joyful-vT5xrj3z1OE-unsplash.jpg', 31),
(214, 'Ham & Cheese Pasta ', '<p>This is a simple quick and easy pasta recipe for those who don\'t like to spend too much time in their kitchen.</p>', '2021-03-23', 'pixzolo-photography-aeESmmFKH0M-unsplash.jpg', 25),
(215, 'Pasta Salad', '<p>For people who live a healthy lifestyle, abut also can say no to pasta. This recipe will make your day brighter than ever.</p>', '2021-03-23', 'carissa-gan-KSXvrqKUxnc-unsplash.jpg', 30),
(216, 'Seafood Pasta', '<p>Perfect pasta for the seafood lover. Good for any time of the day and takes only a couple minutes to make it.</p>', '2021-03-23', 'adolfo-felix-l728d7AJnXM-unsplash.jpg', 30),
(217, 'Chocolate Cake', '<p>This is a rich and moist chocolate cake that my grandmother used to cook for me. Very tasty, you must try one of these!</p>', '2021-03-23', 'max-panama-AWFYboL6BE4-unsplash.jpg', 25);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_categories`
--

CREATE TABLE `recipe_categories` (
  `recipeid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_categories`
--

INSERT INTO `recipe_categories` (`recipeid`, `categoryid`) VALUES
(204, 6),
(205, 6),
(206, 6),
(206, 8),
(206, 11),
(206, 12),
(207, 11),
(207, 12),
(208, 11),
(208, 12),
(209, 3),
(209, 6),
(210, 3),
(214, 8),
(215, 8),
(215, 12),
(216, 6),
(216, 8),
(216, 12),
(217, 3);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `recipeid` int(11) NOT NULL,
  `ingredientid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`recipeid`, `ingredientid`) VALUES
(204, 187),
(205, 188),
(206, 189),
(207, 190),
(208, 191),
(209, 192),
(210, 193),
(214, 197),
(215, 198),
(216, 199),
(217, 200);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_instructions`
--

CREATE TABLE `recipe_instructions` (
  `recipeid` int(11) NOT NULL,
  `instructionsid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_instructions`
--

INSERT INTO `recipe_instructions` (`recipeid`, `instructionsid`) VALUES
(204, 51),
(205, 52),
(206, 53),
(207, 54),
(208, 55),
(209, 56),
(210, 57),
(214, 61),
(215, 62),
(216, 63),
(217, 64);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_serves`
--

CREATE TABLE `recipe_serves` (
  `recipeid` int(11) NOT NULL,
  `servesid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_serves`
--

INSERT INTO `recipe_serves` (`recipeid`, `servesid`) VALUES
(204, 95),
(205, 96),
(206, 97),
(207, 98),
(208, 99),
(209, 100),
(210, 101),
(214, 105),
(215, 106),
(216, 107),
(217, 108);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_times`
--

CREATE TABLE `recipe_times` (
  `recipeid` int(11) NOT NULL,
  `preptimeid` int(11) NOT NULL,
  `cooktimeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_times`
--

INSERT INTO `recipe_times` (`recipeid`, `preptimeid`, `cooktimeid`) VALUES
(205, 154, 140),
(206, 155, 141),
(207, 156, 142),
(208, 157, 143),
(209, 158, 144),
(210, 159, 145),
(214, 163, 149),
(215, 164, 150),
(216, 165, 151),
(217, 166, 152);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
('Account Administrator', 'Add, remove, and edit authors'),
('Content Editor', 'Add, remove, and edit recipes'),
('Site Administrator', 'Add, remove, and edit categories'),
('User', 'Member of public');

-- --------------------------------------------------------

--
-- Table structure for table `serves`
--

CREATE TABLE `serves` (
  `serves_id` int(11) NOT NULL,
  `serves` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serves`
--

INSERT INTO `serves` (`serves_id`, `serves`) VALUES
(92, '8'),
(93, '2'),
(94, '12'),
(95, '2'),
(96, '8'),
(97, '6'),
(98, '4'),
(99, '1'),
(100, '21'),
(101, '8'),
(102, '99'),
(103, '77'),
(104, '45'),
(105, '4'),
(106, '1'),
(107, '2'),
(108, '24'),
(109, '12'),
(110, '21'),
(111, '23'),
(112, '12'),
(113, '21'),
(114, '23'),
(115, '34'),
(116, '12'),
(117, '23'),
(118, '56'),
(119, '23'),
(120, '2'),
(121, '43'),
(122, '43'),
(123, '23'),
(126, '99'),
(127, '2'),
(128, '23'),
(129, '21'),
(130, '45'),
(131, '21'),
(132, '21'),
(133, '12'),
(134, '22'),
(135, '12'),
(136, '23'),
(137, '23'),
(138, '21'),
(139, '21'),
(140, '12'),
(141, '12'),
(142, '21'),
(143, '99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`),
  ADD UNIQUE KEY `author_email` (`author_email`);

--
-- Indexes for table `author_role`
--
ALTER TABLE `author_role`
  ADD PRIMARY KEY (`authorid`,`roleid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cook_time`
--
ALTER TABLE `cook_time`
  ADD PRIMARY KEY (`cook_time_id`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`instructions_id`);

--
-- Indexes for table `prep_time`
--
ALTER TABLE `prep_time`
  ADD PRIMARY KEY (`prep_time_id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `recipe_author_id` (`recipe_author_id`);

--
-- Indexes for table `recipe_categories`
--
ALTER TABLE `recipe_categories`
  ADD PRIMARY KEY (`recipeid`,`categoryid`),
  ADD KEY `recipeid` (`recipeid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`recipeid`,`ingredientid`),
  ADD KEY `recipeid` (`recipeid`),
  ADD KEY `ingredientid` (`ingredientid`);

--
-- Indexes for table `recipe_instructions`
--
ALTER TABLE `recipe_instructions`
  ADD PRIMARY KEY (`recipeid`,`instructionsid`),
  ADD KEY `recipeid` (`recipeid`),
  ADD KEY `instructionsid` (`instructionsid`);

--
-- Indexes for table `recipe_serves`
--
ALTER TABLE `recipe_serves`
  ADD PRIMARY KEY (`recipeid`,`servesid`),
  ADD KEY `recipeid` (`recipeid`),
  ADD KEY `servesid` (`servesid`);

--
-- Indexes for table `recipe_times`
--
ALTER TABLE `recipe_times`
  ADD PRIMARY KEY (`recipeid`,`preptimeid`,`cooktimeid`),
  ADD KEY `cooktimeid` (`cooktimeid`),
  ADD KEY `preptimeid` (`preptimeid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serves`
--
ALTER TABLE `serves`
  ADD PRIMARY KEY (`serves_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=755;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cook_time`
--
ALTER TABLE `cook_time`
  MODIFY `cook_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `instructions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `prep_time`
--
ALTER TABLE `prep_time`
  MODIFY `prep_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `serves`
--
ALTER TABLE `serves`
  MODIFY `serves_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`recipe_author_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_categories`
--
ALTER TABLE `recipe_categories`
  ADD CONSTRAINT `fk_category_rec` FOREIGN KEY (`categoryid`) REFERENCES `category` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recipe_cat` FOREIGN KEY (`recipeid`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `fk_ingredient` FOREIGN KEY (`ingredientid`) REFERENCES `ingredient` (`ingredient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recipe_ingredient` FOREIGN KEY (`recipeid`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_instructions`
--
ALTER TABLE `recipe_instructions`
  ADD CONSTRAINT `fk_instructions` FOREIGN KEY (`instructionsid`) REFERENCES `instructions` (`instructions_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recipe_instructions` FOREIGN KEY (`recipeid`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_serves`
--
ALTER TABLE `recipe_serves`
  ADD CONSTRAINT `fk_recipe_serves` FOREIGN KEY (`recipeid`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_serves` FOREIGN KEY (`servesid`) REFERENCES `serves` (`serves_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_times`
--
ALTER TABLE `recipe_times`
  ADD CONSTRAINT `recipe_id` FOREIGN KEY (`recipeid`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipe_times_ibfk_1` FOREIGN KEY (`cooktimeid`) REFERENCES `cook_time` (`cook_time_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipe_times_ibfk_2` FOREIGN KEY (`preptimeid`) REFERENCES `prep_time` (`prep_time_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

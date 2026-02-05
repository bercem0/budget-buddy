-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 nov 2025 om 09:01
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `parent_budget_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `budgets`
--

INSERT INTO `budgets` (`id`, `user_id`, `category_id`, `parent_budget_id`, `amount`) VALUES
(5, 7, 8, NULL, 1300.00),
(6, 7, 7, NULL, 500.00),
(8, 6, 11, NULL, 50.00),
(9, 6, 12, NULL, 115.00),
(10, 8, 13, NULL, 1200.00),
(12, 8, 16, NULL, 15.00);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `type`, `created_at`) VALUES
(6, 1, 'Winkelen', 'expense', '2025-11-06 20:45:38'),
(7, 1, 'Studiefinanciering', 'income', '2025-11-06 20:45:49'),
(8, 1, 'Telefoon kopen', 'expense', '2025-11-06 20:46:05'),
(9, 1, 'Eten', 'expense', '2025-11-06 20:46:31'),
(11, 1, 'Make-up', 'expense', '2025-11-06 20:50:07'),
(12, 1, 'Verzekering', 'income', '2025-11-06 20:50:26'),
(13, 1, 'Salaris (Kruidvat)', 'income', '2025-11-06 20:51:28'),
(14, 1, 'Vervoer', 'expense', '2025-11-06 20:56:53'),
(16, 1, 'Abonnementen', 'expense', '2025-11-06 20:59:03');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(11, 'Bercem', 'bercemyildirim@gmail.com', 'Vraag over budget', 'Hallo, ik heb een vraag over mijn budget.', '2025-11-06 21:24:57'),
(12, 'Bercem', 'bercemyildirim@gmail.com', 'Hulp nodig', 'Kun je me helpen met het aanpassen van categorieën?', '2025-11-06 21:25:32'),
(13, 'Tugche', 'tugchesezer@gmail.com', 'Feedback', 'Hallo, ik vind de app erg handig!', '2025-11-06 21:26:02'),
(14, 'Tugche', 'tugchesezer@gmail.com', 'Vraag over inkomsten', 'Hoe voeg ik salaris toe aan een categorie?', '2025-11-06 21:26:22'),
(15, 'Ayad', 'ayad@gmail.com', 'Probleem melden', 'Mijn transacties worden niet correct weergegeven.', '2025-11-06 21:26:56'),
(16, 'Ayad', 'ayad@gmail.com', 'Hulp bij registratie', 'Ik kan me niet registreren, wat moet ik doen?', '2025-11-06 21:27:16');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20251016171707', '2025-10-16 17:17:25', 1319),
('DoctrineMigrations\\Version20251016174824', '2025-10-16 17:48:32', 43),
('DoctrineMigrations\\Version20251019152927', '2025-10-19 15:29:44', 39);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `budget_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `note` longtext NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `category_id`, `budget_id`, `amount`, `date`, `note`, `created_at`, `type`) VALUES
(6, 7, 8, 5, '1300', '2025-10-05 00:00:00', 'Nieuwe iPhone 17 gekocht.', '2025-11-06 21:06:29', 'expense'),
(7, 7, 7, 6, '500', '2025-10-06 00:00:00', 'Maandelijkse studiefinanciering ontvangen.', '2025-11-06 21:07:25', 'income'),
(9, 6, 11, 8, '50', '2025-10-08 00:00:00', 'Foundation en lipstick bij Sephora.', '2025-11-06 21:10:54', 'expense'),
(10, 6, 12, 9, '115', '2025-10-09 00:00:00', 'Gezondverzekering kwartaalbetaling.', '2025-11-06 21:12:19', 'income'),
(11, 8, 13, 10, '1200', '2025-11-01 00:00:00', 'Maandelijkse salaris Kruidvat', '2025-11-06 21:13:25', 'income'),
(13, 8, 16, 12, '15', '2025-11-06 00:00:00', 'Netflix abonnement.', '2025-11-06 21:16:57', 'expense');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `created_at`) VALUES
(6, 'Bercem', 'bercem@gmail.com', '2025-10-24 17:34:09'),
(7, 'Tugche', 'tugchesezer@gmail.com', '2025-11-06 06:34:01'),
(8, 'Ayad', 'ayad@gmail.com', '2025-11-06 20:53:37');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DCAA9548A76ED395` (`user_id`),
  ADD KEY `IDX_DCAA954812469DE2` (`category_id`),
  ADD KEY `IDX_DCAA9548C7E08956` (`parent_budget_id`);

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EAA81A4CA76ED395` (`user_id`),
  ADD KEY `IDX_EAA81A4C12469DE2` (`category_id`),
  ADD KEY `IDX_EAA81A4C36ABA6B8` (`budget_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `FK_DCAA954812469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_DCAA9548A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_DCAA9548C7E08956` FOREIGN KEY (`parent_budget_id`) REFERENCES `budgets` (`id`);

--
-- Beperkingen voor tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `FK_EAA81A4C12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_EAA81A4C36ABA6B8` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`),
  ADD CONSTRAINT `FK_EAA81A4CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

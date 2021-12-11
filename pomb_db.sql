CREATE TABLE `ranks` (
  `id` int(10) NOT NULL,
  `player_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sport_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_usd` double DEFAULT NULL,
  `on_usd` double DEFAULT NULL,
  `off_usd` double DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ranks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

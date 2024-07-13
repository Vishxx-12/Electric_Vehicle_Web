--
-- Database: `ev`
--
-- Table structure for table `electric_bikes`
--

CREATE TABLE `electric_bikes` (
  `slno` smallint(2),
  `model_name` text,
  `battery_cap` float,
  `real_range` int(3),
  `charging_time` time,
  `ex_showroom_price` int(8),
  `website` text
)

--
-- Dumping data for table `electric_bikes`


INSERT INTO `electric_bikes` (`slno`, `model_name`, `battery_cap`, `real_range`, `charging_time`, `ex_showroom_price`, `website`) VALUES
(1, 'Hero OptimaCX', 1.5, 55, '04:45:00', 67190, 'https://heroelectric.in/bike/optima-cx-dual-battery/'),
(2, 'Epluto 7G', 2.5, 90, '04:00:00', 86999, 'https://pureev.in/epluto/'),
(3, 'Bounce E1', 1.9, 65, '04:00:00', 96799, 'https://bounceinfinity.com/infinity_e1'),
(4, 'Praise Pro', 2, 65, '03:00:00', 99645, 'https://okinawascooters.com/'),
(5, 'TVS Iqube', 3.04, 100, '07:00:00', 99999, 'https://www.tvsmotor.com/iqube'),
(6, 'Ola S1', 3, 105, '05:00:00', 109999, 'https://olaelectric.com/s1'),
(7, 'Bajaj Chetak', 2.94, 90, '04:00:00', 122000, 'https://www.chetak.com/'),
(8, 'Ola S1 Pro', 4, 135, '05:45:00', 129999, 'https://book.olaelectric.com/'),
(9, 'Ather 450x', 3.66, 105, '05:30:00', 142000, 'https://www.atherenergy.com/'),
(10, 'Vida V1 Pro', 3.94, 95, '07:00:00', 146880, 'https://www.vidaworld.com');

ALTER TABLE `electric_bikes`
  ADD PRIMARY KEY (`slno`);

-- AUTO_INCREMENT for table `electric_bikes`
--
ALTER TABLE `electric_bikes`
  MODIFY `slno` smallint(2) AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;
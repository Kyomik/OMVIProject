-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 08:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_tokoo
-- ------------------------------------------------------
-- Server version 10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun` (
  `id_akun` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `hak_access` int(1) NOT NULL,
  `negara` varchar(25) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_akun`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun`
--

LOCK TABLES `akun` WRITE;
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
INSERT INTO `akun` VALUES (1,'ardi dongo sekali masih d','081234567890',0,'indo',NULL),(9,'amar','123',0,NULL,NULL),(14,'amar2','1',0,NULL,NULL),(15,'amar2','09090',0,NULL,NULL),(16,'ilham','08999999',1,'kjkj','1711447584WIN_20231231_21_08_12_Pro.jpg'),(17,'ilham2','089999',0,'indo','1711454605WIN_20231231_21_07_45_Pro.jpg'),(18,'kyoo','123',0,NULL,NULL);
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id_customer` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `negara` varchar(12) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--


--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id_transaksi` int(10) NOT NULL,
  `id_item` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `tgl` date DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  KEY `id_transaksi` (`id_transaksi`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--


--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `id_akun` int(10) NOT NULL,
  KEY `id_akun` (`id_akun`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('amar','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',14),('amar2','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',15),('ilham','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',16),('ilham3','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',17),('kyoo','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',18);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toko`
--

DROP TABLE IF EXISTS `toko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toko`
--



--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `tgl_input` date NOT NULL,
  `tgl_priode` date NOT NULL,
  `id_akun` int(10) NOT NULL,
  `total_harga` int(25) NOT NULL,
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(10) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_akun` (`id_akun`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`),
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


test_for_fastvps
================

Тестовое задание для FastVPS 

Задача - файл test.jpg

Инструкция по развертывания

1. В домашнем каталоге WEB-сервера создаем папку test (<home_dir>/test/)
2. Размещаем в нее все файлы, соблюдая структура каталогов
3. Создаем таблицу БД Mysql

CREATE TABLE IF NOT EXISTS `testtesttest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` varchar(10) NOT NULL,
  `vname` varchar(4) NOT NULL,
  `nominal` int(11) NOT NULL,
  `vprice` float NOT NULL,
  `lupdate` datetime NOT NULL,
  `desc` varchar(256) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  KEY `id` (`id`),
  KEY `vname` (`vname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

4. В фале конфигурации (<home_dir>/test/config.php) меняем параметры подключения к БД
5. Откройте ресурс из браузера по адресу http://<domain_name>/test/
6. При первом запуске нажмите - "Скачать/Обновить валюты"
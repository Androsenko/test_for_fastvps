test_for_fastvps
================

�������� ������� ��� FastVPS 

������ - ���� test.jpg

���������� �� �������������

1. � �������� �������� WEB-������� ������� ����� test (<home_dir>/test/)
2. ��������� � ��� ��� �����, �������� ��������� ���������
3. ������� ������� �� Mysql

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

4. � ���� ������������ (<home_dir>/test/config.php) ������ ��������� ����������� � ��
5. �������� ������ �� �������� �� ������ http://<domain_name>/test/
6. ��� ������ ������� ������� - "�������/�������� ������"
/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : website

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 09/10/2018 20:27:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kategori_status` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kategori_tersimpan` date NULL DEFAULT NULL,
  PRIMARY KEY (`kategori_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'berita', '1', '2018-10-05');
INSERT INTO `kategori` VALUES (2, 'slide', '1', '2018-10-05');
INSERT INTO `kategori` VALUES (3, 'download', '1', '2018-10-05');
INSERT INTO `kategori` VALUES (4, 'agenda', '1', '2018-10-05');
INSERT INTO `kategori` VALUES (5, 'kontak', '1', '2018-10-05');
INSERT INTO `kategori` VALUES (10, 'portofolio', '1', '2018-10-06');

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media`  (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_nama` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `media_path` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `media_tersimpan` date NULL DEFAULT NULL,
  PRIMARY KEY (`media_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of media
-- ----------------------------
INSERT INTO `media` VALUES (1, 'kegiatan ukm hmj', 'd74b974ac863b29cb749336ea3933c5f.png', '2018-10-05');
INSERT INTO `media` VALUES (4, 'palet warna', '124c56f2c21ea50116adea9dbe2d5e6f.jpg', '2018-10-06');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_ikon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_is_mainmenu` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_akses_level` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_urutan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_status` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_kategori` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'dashboard', 'fa fa-dashboard', '0', 'dashboard/admin', '1', '1', '1', '1');
INSERT INTO `menu` VALUES (2, 'berita', 'fa fa-tags', '0', 'berita/admin', '1', '4', '1', '1');
INSERT INTO `menu` VALUES (3, 'kategori', 'fa fa-circle-o', '2', 'kategori/admin', '1', '1', '1', '1');
INSERT INTO `menu` VALUES (4, 'berita', 'fa fa-circle-o', '2', 'berita/admin', '1', '2', '1', '1');
INSERT INTO `menu` VALUES (5, 'media', 'fa fa-image', '0', 'media/admin', '1', '2', '1', '1');
INSERT INTO `menu` VALUES (6, 'slide', 'fa fa-file-image-o', '0', 'slide/admin', '1', '3', '1', '1');
INSERT INTO `menu` VALUES (7, 'user', 'fa fa-user', '0', 'user/admin', '1', '5', '1', '1');
INSERT INTO `menu` VALUES (8, 'berita', 'fa fa-tags', '0', 'berita/user', '0', '3', '1', '1');
INSERT INTO `menu` VALUES (9, 'media', 'fa fa-image', '0', 'media/user', '0', '2', '1', '1');
INSERT INTO `menu` VALUES (10, 'dashboard', 'fa fa-dashboard', '0', 'dashboard/user', '0', '1', '1', '1');

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post`  (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_idkategori` int(11) NULL DEFAULT NULL,
  `post_judul` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `post_post` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `post_featuredimage` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `post_status` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `post_tersimpan` date NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES (15, 1, 'Hello worlds', '<p>Lorem ipsum dolor sit amet, et viris invenire duo. Paulo viris labores nam id, mel ea quod semper quodsi. Per id postea virtute appellantur, persius tibique theophrastus cu nam. Dictas ponderum cu qui, choro antiopam periculis mel ad, ius cu accumsan appetere. Prodesset dissentiet cu eum, cu has iisque latine dolorum.</p>\r\n\r\n<p>Suas aliquid postulant cu nec, vim tation ignota vivendo ut. Agam atqui saepe nec ei, an per malorum epicurei, at stet voluptatibus nec. In eum maiestatis constituam. Ex nec illud maiorum deterruisset, ius cu tritani voluptua, ubique apeirian ullamcorper eu vix. Dicit scaevola ponderum et vis.</p>\r\n\r\n<p>In maiorum intellegebat his, esse nominavi quo eu. Pri te omnesque pertinax repudiare. Iudico suavitate mel et. Pri scaevola efficiendi no, eum ne option liberavisse. Aperiri dissentiunt at per, diam democritum ei mea. No simul graeci nusquam mel. Ei his wisi aliquip labitur.</p>\r\n\r\n<p>His no esse feugiat salutandi, eos te habeo ornatus. Graeco voluptua sed ea, ei falli posidonium mei. Sit te amet voluptaria. Exerci impedit salutandi in has, quo ut vero temporibus. Nibh feugiat eruditi eos at, malis elaboraret pro in.</p>\r\n\r\n<p>Utinam accumsan pri ex, albucius explicari philosophia sea ea. Ius ei erat aperiam elaboraret, lorem populo instructior ex vim. Nec nulla menandri moderatius id, ei ius mollis aeterno percipit, in vix alii justo melius. Ad ius dicta vocibus interpretaris, at duo feugiat oporteat mandamus. Homero iudicabit imperdiet et per, mutat adipiscing id vel.</p>\r\n\r\n<p>Eruditi postulant corrumpit usu eu. Pro ei paulo lobortis facilisis. Agam exerci id mei. Labore quaestio eam te, sit eruditi nonumes convenire eu. Ex usu commodo aeterno aperiam. Doctus saperet usu no.</p>\r\n\r\n<p>Quidam doctus laoreet an duo, cum quem decore dolorem ad. Quod noluisse mea cu, est eu nisl decore voluptatibus. At cum ancillae molestie, novum aliquam deterruisset in cum. Vis ridens detraxit complectitur no. Solet fuisset ut mea, vix in delectus referrentur, per doming mandamus perpetua eu.</p>\r\n\r\n<p>Euismod delicatissimi at ius, cum no augue oportere. No vel eius tation vidisse, omnis decore aperiri eu eam, ea mei unum philosophia. Ex inimicus sapientem interesset per. Ad homero officiis nominati qui. Ad nam insolens sensibus interesset, ad tollit euripidis ius.</p>\r\n\r\n<p>Altera saperet vituperata ne vim, pri cu wisi movet nonumy. Inani corrumpit sit cu. Ea partem atomorum gloriatur est. An nam veniam neglegentur. Te vim causae blandit adipisci, at sit dicit delicata comprehensam. Mea in mazim albucius maluisset, ei nemore sapientem splendide ius.</p>\r\n\r\n<p>Ut duo maiestatis voluptaria reprimique, at simul expetenda neglegentur sed, in vix nobis urbanitas reprimique. Te pri audire civibus persecuti, no probo idque sed. Et lucilius persequeris nec, omnis dictas laboramus vel an. Deleniti detraxit duo ea, mel modo conceptam definitiones id. Id pri reque noster diceret, scripta senserit ne vel, te mucius vocibus sed. Pro admodum principes id.</p>\r\n', 'b244b9b6ae14cbf53392a32bfa3eb9cb.png', '1', '2018-10-06');
INSERT INTO `post` VALUES (20, 1, 'Berita Seputar Bantul', '<p>Lorem ipsum dolor sit amet, et viris invenire duo. Paulo viris labores nam id, mel ea quod semper quodsi. Per id postea virtute appellantur, persius tibique theophrastus cu nam. Dictas ponderum cu qui, choro antiopam periculis mel ad, ius cu accumsan appetere. Prodesset dissentiet cu eum, cu has iisque latine dolorum.</p>\r\n\r\n<p>Suas aliquid postulant cu nec, vim tation ignota vivendo ut. Agam atqui saepe nec ei, an per malorum epicurei, at stet voluptatibus nec. In eum maiestatis constituam. Ex nec illud maiorum deterruisset, ius cu tritani voluptua, ubique apeirian ullamcorper eu vix. Dicit scaevola ponderum et vis.</p>\r\n\r\n<p>In maiorum intellegebat his, esse nominavi quo eu. Pri te omnesque pertinax repudiare. Iudico suavitate mel et. Pri scaevola efficiendi no, eum ne option liberavisse. Aperiri dissentiunt at per, diam democritum ei mea. No simul graeci nusquam mel. Ei his wisi aliquip labitur.</p>\r\n\r\n<p>His no esse feugiat salutandi, eos te habeo ornatus. Graeco voluptua sed ea, ei falli posidonium mei. Sit te amet voluptaria. Exerci impedit salutandi in has, quo ut vero temporibus. Nibh feugiat eruditi eos at, malis elaboraret pro in.</p>\r\n\r\n<p>Utinam accumsan pri ex, albucius explicari philosophia sea ea. Ius ei erat aperiam elaboraret, lorem populo instructior ex vim. Nec nulla menandri moderatius id, ei ius mollis aeterno percipit, in vix alii justo melius. Ad ius dicta vocibus interpretaris, at duo feugiat oporteat mandamus. Homero iudicabit imperdiet et per, mutat adipiscing id vel.</p>\r\n\r\n<p>Eruditi postulant corrumpit usu eu. Pro ei paulo lobortis facilisis. Agam exerci id mei. Labore quaestio eam te, sit eruditi nonumes convenire eu. Ex usu commodo aeterno aperiam. Doctus saperet usu no.</p>\r\n\r\n<p>Quidam doctus laoreet an duo, cum quem decore dolorem ad. Quod noluisse mea cu, est eu nisl decore voluptatibus. At cum ancillae molestie, novum aliquam deterruisset in cum. Vis ridens detraxit complectitur no. Solet fuisset ut mea, vix in delectus referrentur, per doming mandamus perpetua eu.</p>\r\n\r\n<p>Euismod delicatissimi at ius, cum no augue oportere. No vel eius tation vidisse, omnis decore aperiri eu eam, ea mei unum philosophia. Ex inimicus sapientem interesset per. Ad homero officiis nominati qui. Ad nam insolens sensibus interesset, ad tollit euripidis ius.</p>\r\n\r\n<p>Altera saperet vituperata ne vim, pri cu wisi movet nonumy. Inani corrumpit sit cu. Ea partem atomorum gloriatur est. An nam veniam neglegentur. Te vim causae blandit adipisci, at sit dicit delicata comprehensam. Mea in mazim albucius maluisset, ei nemore sapientem splendide ius.</p>\r\n\r\n<p>Ut duo maiestatis voluptaria reprimique, at simul expetenda neglegentur sed, in vix nobis urbanitas reprimique. Te pri audire civibus persecuti, no probo idque sed. Et lucilius persequeris nec, omnis dictas laboramus vel an. Deleniti detraxit duo ea, mel modo conceptam definitiones id. Id pri reque noster diceret, scripta senserit ne vel, te mucius vocibus sed. Pro admodum principes id.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '39f51a3d3b814fd5b9a4c9f75e801798.png', '1', '2018-10-06');
INSERT INTO `post` VALUES (21, 1, 'Berita Seputar Olahraga', '<p>Lorem ipsum dolor sit amet, et viris invenire duo. Paulo viris labores nam id, mel ea quod semper quodsi. Per id postea virtute appellantur, persius tibique theophrastus cu nam. Dictas ponderum cu qui, choro antiopam periculis mel ad, ius cu accumsan appetere. Prodesset dissentiet cu eum, cu has iisque latine dolorum.</p>\r\n\r\n<p>Suas aliquid postulant cu nec, vim tation ignota vivendo ut. Agam atqui saepe nec ei, an per malorum epicurei, at stet voluptatibus nec. In eum maiestatis constituam. Ex nec illud maiorum deterruisset, ius cu tritani voluptua, ubique apeirian ullamcorper eu vix. Dicit scaevola ponderum et vis.</p>\r\n\r\n<p>In maiorum intellegebat his, esse nominavi quo eu. Pri te omnesque pertinax repudiare. Iudico suavitate mel et. Pri scaevola efficiendi no, eum ne option liberavisse. Aperiri dissentiunt at per, diam democritum ei mea. No simul graeci nusquam mel. Ei his wisi aliquip labitur.</p>\r\n\r\n<p>His no esse feugiat salutandi, eos te habeo ornatus. Graeco voluptua sed ea, ei falli posidonium mei. Sit te amet voluptaria. Exerci impedit salutandi in has, quo ut vero temporibus. Nibh feugiat eruditi eos at, malis elaboraret pro in.</p>\r\n\r\n<p>Utinam accumsan pri ex, albucius explicari philosophia sea ea. Ius ei erat aperiam elaboraret, lorem populo instructior ex vim. Nec nulla menandri moderatius id, ei ius mollis aeterno percipit, in vix alii justo melius. Ad ius dicta vocibus interpretaris, at duo feugiat oporteat mandamus. Homero iudicabit imperdiet et per, mutat adipiscing id vel.</p>\r\n\r\n<p>Eruditi postulant corrumpit usu eu. Pro ei paulo lobortis facilisis. Agam exerci id mei. Labore quaestio eam te, sit eruditi nonumes convenire eu. Ex usu commodo aeterno aperiam. Doctus saperet usu no.</p>\r\n\r\n<p>Quidam doctus laoreet an duo, cum quem decore dolorem ad. Quod noluisse mea cu, est eu nisl decore voluptatibus. At cum ancillae molestie, novum aliquam deterruisset in cum. Vis ridens detraxit complectitur no. Solet fuisset ut mea, vix in delectus referrentur, per doming mandamus perpetua eu.</p>\r\n\r\n<p>Euismod delicatissimi at ius, cum no augue oportere. No vel eius tation vidisse, omnis decore aperiri eu eam, ea mei unum philosophia. Ex inimicus sapientem interesset per. Ad homero officiis nominati qui. Ad nam insolens sensibus interesset, ad tollit euripidis ius.</p>\r\n\r\n<p>Altera saperet vituperata ne vim, pri cu wisi movet nonumy. Inani corrumpit sit cu. Ea partem atomorum gloriatur est. An nam veniam neglegentur. Te vim causae blandit adipisci, at sit dicit delicata comprehensam. Mea in mazim albucius maluisset, ei nemore sapientem splendide ius.</p>\r\n\r\n<p>Ut duo maiestatis voluptaria reprimique, at simul expetenda neglegentur sed, in vix nobis urbanitas reprimique. Te pri audire civibus persecuti, no probo idque sed. Et lucilius persequeris nec, omnis dictas laboramus vel an. Deleniti detraxit duo ea, mel modo conceptam definitiones id. Id pri reque noster diceret, scripta senserit ne vel, te mucius vocibus sed. Pro admodum principes id.</p>\r\n', '7f50c041cad82eb1df8b128f8e92c475.JPG', '1', '2018-10-06');
INSERT INTO `post` VALUES (23, 1, 'hello a', '<p>wadawdawd<img alt=\"\" src=\"/website/upload/files/slide/d7c6f0fb0e0b7cd802d19cfdd36283f5.png\" style=\"float:left; height:252px; width:365px\" /></p>\r\n', NULL, '1', '2018-10-09');

-- ----------------------------
-- Table structure for slide
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide`  (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_idkategori` int(255) NULL DEFAULT NULL,
  `slide_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slide_path` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `slide_tersimpan` date NULL DEFAULT NULL,
  PRIMARY KEY (`slide_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of slide
-- ----------------------------
INSERT INTO `slide` VALUES (10, 1, 'slide beasiswa', 'd7c6f0fb0e0b7cd802d19cfdd36283f5.png', '2018-10-05');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_username` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `user_password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `user_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_terdaftar` date NULL DEFAULT NULL,
  `user_level` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_status` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'duwi', 'admin', 'admin', 'haryanto.duwi@gmail.com', '2018-10-05', '1', '1');
INSERT INTO `user` VALUES (4, 'Mark ', 'user', 'user', 'mark@gmail.com', '2018-10-06', '0', '1');

SET FOREIGN_KEY_CHECKS = 1;

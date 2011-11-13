-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

--
-- Table `tl_modules`
--

CREATE TABLE `tl_module` (
  `gtranslate_mainlang` varchar(10) NOT NULL default '',
  `gtranslate_template` varchar(64) NOT NULL default '',
  `gtranslate_method` varchar(24) NOT NULL default '',
  `gtranslate_new_window` char(1) NOT NULL default '',
  `gtranslate_flag_size` varchar(2) NOT NULL default '',
  `gtranslate_pro` char(1) NOT NULL default '',
  `gtranslate_en` char(1) NOT NULL default '',
  `gtranslate_ar` char(1) NOT NULL default '',
  `gtranslate_bg` char(1) NOT NULL default '',
  `gtranslate_zhCN` char(1) NOT NULL default '',
  `gtranslate_zhTW` char(1) NOT NULL default '',
  `gtranslate_hr` char(1) NOT NULL default '',
  `gtranslate_cs` char(1) NOT NULL default '',
  `gtranslate_da` char(1) NOT NULL default '',
  `gtranslate_nl` char(1) NOT NULL default '',
  `gtranslate_fi` char(1) NOT NULL default '',
  `gtranslate_fr` char(1) NOT NULL default '',
  `gtranslate_de` char(1) NOT NULL default '',
  `gtranslate_el` char(1) NOT NULL default '',
  `gtranslate_hi` char(1) NOT NULL default '',
  `gtranslate_it` char(1) NOT NULL default '',
  `gtranslate_ja` char(1) NOT NULL default '',
  `gtranslate_ko` char(1) NOT NULL default '',
  `gtranslate_no` char(1) NOT NULL default '',
  `gtranslate_pl` char(1) NOT NULL default '',
  `gtranslate_pt` char(1) NOT NULL default '',
  `gtranslate_ro` char(1) NOT NULL default '',
  `gtranslate_ru` char(1) NOT NULL default '',
  `gtranslate_es` char(1) NOT NULL default '',
  `gtranslate_sv` char(1) NOT NULL default '',
  `gtranslate_ca` char(1) NOT NULL default '',
  `gtranslate_tl` char(1) NOT NULL default '',
  `gtranslate_iw` char(1) NOT NULL default '',
  `gtranslate_id` char(1) NOT NULL default '',
  `gtranslate_lv` char(1) NOT NULL default '',
  `gtranslate_lt` char(1) NOT NULL default '',
  `gtranslate_sr` char(1) NOT NULL default '',
  `gtranslate_sk` char(1) NOT NULL default '',
  `gtranslate_sl` char(1) NOT NULL default '',
  `gtranslate_uk` char(1) NOT NULL default '',
  `gtranslate_vi` char(1) NOT NULL default '',
  `gtranslate_sq` char(1) NOT NULL default '',
  `gtranslate_et` char(1) NOT NULL default '',
  `gtranslate_gl` char(1) NOT NULL default '',
  `gtranslate_hu` char(1) NOT NULL default '',
  `gtranslate_mt` char(1) NOT NULL default '',
  `gtranslate_th` char(1) NOT NULL default '',
  `gtranslate_tr` char(1) NOT NULL default '',
  `gtranslate_fa` char(1) NOT NULL default '',
  `gtranslate_af` char(1) NOT NULL default '',
  `gtranslate_ms` char(1) NOT NULL default '',
  `gtranslate_sw` char(1) NOT NULL default '',
  `gtranslate_ga` char(1) NOT NULL default '',
  `gtranslate_cy` char(1) NOT NULL default '',
  `gtranslate_be` char(1) NOT NULL default '',
  `gtranslate_is` char(1) NOT NULL default '',
  `gtranslate_mk` char(1) NOT NULL default '',
  `gtranslate_yi` char(1) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
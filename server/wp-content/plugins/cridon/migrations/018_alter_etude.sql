ALTER TABLE `cri_etude` ADD COLUMN `tel` VARCHAR(80) NULL AFTER `office_email_adress_3`, ADD COLUMN `fax` VARCHAR(80) NULL AFTER `tel`;
ALTER TABLE `cri_notaire` CHANGE `id_wp_user` `id_wp_user` BIGINT(20) UNSIGNED DEFAULT 0 NOT NULL;
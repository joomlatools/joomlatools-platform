-- --------------------------------------------------------
-- Remove the debug plugin
-- Issue : https://github.com/joomlatools/joomlatools-platform/issues/261
DELETE FROM `extensions` WHERE `extensions`.`name` = 'plg_system_debug'

-- --------------------------------------------------------
-- Add Elysio administrator template
-- Issue : https://github.com/joomlatools/joomlatools-platform/issues/260
INSERT INTO `extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(508, 'elysio', 'template', 'elysio', '', 1, 1, 1, 0, '{}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);

INSERT INTO `templates` (`id`, `template`, `client_id`, `home`, `title`, `params`) VALUES
(9, 'elysio', 1, '1', 'elysio - Default', '{"logo":"templates/elysio/images/joomla-logo"}');
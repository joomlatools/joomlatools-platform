-- --------------------------------------------------------
-- Remove the debug plugin
-- Issue : https://github.com/joomlatools/joomla-platform/issues/261
DELETE FROM `extensions` WHERE `extensions`.`name` = 'plg_system_debug'
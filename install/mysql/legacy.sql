-- --------------------------------------------------------

--
-- Create a views for legacy tables
--

CREATE VIEW `associations` AS SELECT * FROM `languages_associations`;
CREATE VIEW `template_styles` AS SELECT * FROM `templates`;
CREATE VIEW `viewlevels` AS SELECT * FROM `users_roles`;
CREATE VIEW `user_usergroup_map` AS SELECT * FROM `users_groups_users`;
CREATE VIEW `user_profiles` AS SELECT * FROM `users_profiles`;
CREATE VIEW `user_keys` AS SELECT * FROM `users_keys`;
CREATE VIEW `usergroups` AS SELECT * FROM `users_groups`;
CREATE VIEW `session` AS SELECT * FROM `users_sessions`;
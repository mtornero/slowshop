INSERT INTO `role` (`role_id`, `role_code`) VALUES
(2, 'admin'),
(3, 'client'),
(1, 'superadmin');

INSERT INTO `slowshop`.`resource` (
`resource_id` ,
`resource_type` ,
`social_views` ,
`social_likes` ,
`social_dislikes` ,
`social_comments` ,
`social_favourites` ,
`social_recommendations`
)
VALUES (
NULL , 'user', '0', '0', '0', '0', '0', '0'
);

INSERT INTO `user` (`user_id`, `resource_id`, `user_name`, `user_surname`, `user_login`, `user_pass`, `user_pass_is_temp`, `remember_token`, `user_email`, `user_phone`, `user_address`, `role_id`, `user_is_active`, `user_pic`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, '$2y$10$3g/tCaWvXFnhgQt0gEwfzuiYUIBqF5QJsh0X4QyzZvuTTT0zXUsbW', NULL, NULL, 'admin@ecolojico.com', NULL, NULL, 3, 0, NULL, '2016-02-14 11:09:22', '2016-02-14 11:09:22');


INSERT INTO `config_category` (`config_category_id`, `config_category_is_visible`) VALUES
(1, 0);

INSERT INTO `config` (`config_id`, `config_category_id`, `config_key`, `config_value`, `config_format`, `version`) VALUES
(1, 1, 'login_field', 'user_email', 'string', 0),
(2, 1, 'register_required_fields', '["user_name"]', 'array', 0),
(3, 1, 'register_must_be_validated', '1', 'boolean', 0),
(4, 1, 'register_is_allowed', '0', 'boolean', 0);



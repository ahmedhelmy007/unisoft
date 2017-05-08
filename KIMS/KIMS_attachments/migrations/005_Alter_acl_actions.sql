UPDATE `acl_actions` SET `action` = 'doors_edit' WHERE `id`=3;
UPDATE `acl_actions` SET `action` = 'doors_delete' WHERE `id`=4;
UPDATE `acl_actions` SET `action` = 'activities' WHERE `id`=5;
UPDATE `acl_actions` SET `action` = 'activities_create' WHERE `id`=6;



INSERT INTO `acl_actions` (`id`, `action`) VALUES
(7, 'activities_edit'),
(8, 'activities_delete');

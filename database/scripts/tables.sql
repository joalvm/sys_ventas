CREATE TABLE `persons` (
  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `gender` enum('MALE', 'FEMALE', 'OTHERS') NOT NULL,
  `phone` varchar(80) NULL,
  `avatar_url` varchar(150) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL
) ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4
DEFAULT COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `person_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(160) NOT NULL,
  `salt` varchar(16) NOT NULL,
  `recovery_token` varchar(160) NOT NULL,
  `verification_token` varchar(160) NOT NULL,
  `verified_at` datetime NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  UNIQUE KEY (`person_id`)
) ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4
DEFAULT COLLATE=utf8mb4_general_ci;

CREATE TABLE `user_sessions` (
  `id` varchar UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `token` text NOT NULL,
  `expire` datetime NOT NULL,
  `ip_address` varchar(45) NULL,
  `platform` varchar(25) NULL,
  `browser` varchar(25) NULL,
  `browser_version` varchar(25) NULL,
  `user_agent` text NULL,
  `payload` text NOT NULL,
  `last_activity` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed_at` datetime NULL
) ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4
DEFAULT COLLATE=utf8mb4_general_ci;

CREATE TABLE `document_types` (
  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `operation` enum('PERSONS', 'DOCUMENTS') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL
) ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4
DEFAULT COLLATE=utf8mb4_general_ci;

CREATE TABLE `companies` (
  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `registered_name` varchar(120) NOT NULL,
  `document_type_id` int(11) UNSIGNED NOT NULL,
  `document_number`varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(80) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL
) ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4
DEFAULT COLLATE=utf8mb4_general_ci;

CREATE TABLE `branch_office` (
  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `company_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `registered_name` varchar(120) NOT NULL,
  `document_type_id` int(11) UNSIGNED NOT NULL,
  `document_number`varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(80) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL
) ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4
DEFAULT COLLATE=utf8mb4_general_ci;

CREATE TABLE `collaborators` (
  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `person_id` int(11) UNSIGNED NOT NULL,
  `status` enum('PENDING', 'ACCEPTED', 'REJECTED') NOT NULL DEFAULT 'PENDING',
  `resolved_at` datetime NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL
) ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4
DEFAULT COLLATE=utf8mb4_general_ci;


ALTER TABLE `users` ADD CONSTRAINT `fk_users_persons_1` FOREIGN KEY (`person_id`) REFERENCES `persons`(`id`);
ALTER TABLE `user_sessions` ADD CONSTRAINT `fk_users_sessions_users_1` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

ALTER TABLE `companies` ADD CONSTRAINT `fk_companies_users_1` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `companies` ADD CONSTRAINT `fk_companies_document_types_1` FOREIGN KEY (`document_type_id`) REFERENCES `document_types`(`id`);

ALTER TABLE `branch_office` ADD CONSTRAINT `fk_branch_office_companies_1` FOREIGN KEY (`company_id`) REFERENCES `companies`(`id`);
ALTER TABLE `branch_office` ADD CONSTRAINT `fk_branch_office_document_types_1` FOREIGN KEY (`document_type_id`) REFERENCES `document_types`(`id`);

ALTER TABLE `collaborators` ADD CONSTRAINT `fk_collaborators_users_1` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `collaborators` ADD CONSTRAINT `fk_collaborators_persons_1` FOREIGN KEY (`person_id`) REFERENCES `persons`(`id`);

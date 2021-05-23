CREATE TABLE `global` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `nombre_impuesto` varchar(5) NOT NULL,
  `porcentaje_impuesto` decimal(5,2) NOT NULL,
  `simbolo_moneda` varchar(5) NOT NULL,
  `logo` varchar(50) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_empresa_idx` (`empresa`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `tipo_documento` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `operacion` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_nombre_idx` (`nombre`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `unidad_medida` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `prefijo` varchar(5) NOT NULL,
  `estado` char(1) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `categoria` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `articulo` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `categoria_id` int(11) UNSIGNED NOT NULL,
  `idunidad_medida` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NULL,
  `imagen` varchar(150) NULL,
  `estado` char(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `sucursal` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `razon_social` varchar(150) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(70) NULL,
  `representante` varchar(150) NULL,
  `logo` varchar(50) NULL,
  `estado` char(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `persona` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_persona` varchar(20) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion_departamento` varchar(45) NULL,
  `direccion_provincia` varchar(45) NULL,
  `direccion_distrito` varchar(45) NULL,
  `direccion_calle` varchar(70) NULL,
  `telefono` varchar(20) NULL,
  `email` varchar(50) NULL,
  `numero_cuenta` varchar(32) NULL,
  `estado` char(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `empleado` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(100) NULL,
  `telefono` varchar(20) NULL,
  `email` varchar(70) NULL,
  `fecha_nacimiento` date NULL,
  `foto` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `clave` varchar(32) NOT NULL,
  `estado` char(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `usuario` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `sucursal_id` int(11) UNSIGNED NOT NULL,
  `empleado_id` int(11) UNSIGNED NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `fecha_registro` date NOT NULL,
  `mnu_almacen` bit(1) NOT NULL,
  `mnu_compras` bit(1) NOT NULL,
  `mnu_ventas` bit(1) NOT NULL,
  `mnu_mantenimiento` bit(1) NOT NULL,
  `mnu_seguridad` bit(1) NOT NULL,
  `mnu_consulta_compras` bit(1) NOT NULL,
  `mnu_consulta_ventas` bit(1) NOT NULL,
  `mnu_admin` bit(1) NOT NULL,
  `estado` char(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `ingreso` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `usuario_id` int(11) UNSIGNED NOT NULL,
  `sucursal_id` int(11) UNSIGNED NOT NULL,
  `persona_id` int(11) UNSIGNED NOT NULL COMMENT 'Persona proveedor',
  `tipo_comprobante` varchar(20) NOT NULL,
  `serie_comprobante` varchar(7) NOT NULL,
  `num_comprobante` varchar(10) NOT NULL,
  `fecha` date NOT NULL,
  `impuesto` decimal(8, 2) NOT NULL,
  `total` decimal(8, 2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `pedido` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `persona_id` int(11) UNSIGNED NOT NULL COMMENT 'Persona Cliente',
  `usuario_id` int(11) UNSIGNED NOT NULL,
  `sucursal_id` int(11) UNSIGNED NOT NULL,
  `tipo_pedido` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `numero` int(11) NULL,
  `estado` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `detalle_documento_sucursal` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `sucursal_id` int(11) UNSIGNED NOT NULL,
  `tipo_documento_id` int(11) UNSIGNED NOT NULL,
  `ultima_serie` varchar(7) NOT NULL,
  `ultimo_numero` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `detalle_ingreso` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `ingreso_id` int(11) UNSIGNED NOT NULL,
  `articulo_id` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `serie` varchar(50) NULL,
  `descripcion` varchar(1024) NULL,
  `stock_ingreso` int(11) NOT NULL,
  `stock_actual` int(11) NOT NULL,
  `precio_compra` decimal(8, 2) NOT NULL,
  `precio_ventadistribuidor` decimal(8, 2) NOT NULL,
  `precio_ventapublico` decimal(8, 2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `detalle_pedido` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `pedido_id` int(11) UNSIGNED NOT NULL,
  `detalle_ingreso_id` int(11) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(8, 2) NOT NULL,
  `descuento` decimal(8, 2) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `venta` (
  `id` int(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `pedido_id` int(11) UNSIGNED NOT NULL,
  `usuario_id` int(11) UNSIGNED NOT NULL,
  `tipo_venta` varchar(20) NOT NULL,
  `tipo_comprobante` varchar(20) NOT NULL,
  `serie_comprobante` varchar(7) NOT NULL,
  `num_comprobante` varchar(10) NOT NULL,
  `fecha` date NOT NULL,
  `impuesto` decimal(8, 2) NOT NULL,
  `total` decimal(8, 2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

CREATE TABLE `credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) UNSIGNED NOT NULL,
  `fecha_pago` date NOT NULL,
  `total_pago` decimal(8,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
;

ALTER TABLE `articulo`
  ADD CONSTRAINT `fk_articulo_categoria_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `fk_articulo_unidad_medida_1` FOREIGN KEY (`idunidad_medida`) REFERENCES `unidad_medida` (`id`);

ALTER TABLE `credito`
  ADD CONSTRAINT `fk_credito_venta_1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`);

ALTER TABLE `detalle_documento_sucursal`
  ADD CONSTRAINT `fk_detalle_documento_sucursal_sucursal_1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`),
  ADD CONSTRAINT `fk_detalle_documento_sucursal_tipo_documento_1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`);

ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_ingreso_articulo_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulo` (`id`),
  ADD CONSTRAINT `fk_detalle_ingreso_ingreso_1` FOREIGN KEY (`ingreso_id`) REFERENCES `ingreso` (`id`);

ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `fk_detalle_pedido_pedido_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `fk_detalle_pedido_detalle_ingreso_1` FOREIGN KEY (`detalle_ingreso_id`) REFERENCES `detalle_ingreso` (`id`);

ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_persona_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `fk_ingreso_sucursal_1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`),
  ADD CONSTRAINT `fk_ingreso_usuario_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_persona_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `fk_pedido_sucursal_1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`),
  ADD CONSTRAINT `fk_pedido_usuario_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_empleado_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `fk_usuario_sucursal_1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`);

ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_pedido_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `fk_venta_usuario_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

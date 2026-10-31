-- 2026_10_30_suscriptores.sql - v1.0 (30/10/2026)
-- Crea la tabla de suscriptores del boletin. Equivale a la migracion
-- 2026_10_30_220000_create_suscriptores_table.php (el usuario de la aplicacion no tiene permiso CREATE).
-- Uso en el servidor:  sudo mysql "$DB" < /var/www/repositorio/database/sql/2026_10_30_suscriptores.sql
CREATE TABLE IF NOT EXISTS suscriptores (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR(190) NOT NULL,
  token CHAR(64) NOT NULL,
  aceptado_en TIMESTAMP NULL DEFAULT NULL,
  confirmado_en TIMESTAMP NULL DEFAULT NULL,
  baja_en TIMESTAMP NULL DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY suscriptores_email_unique (email),
  UNIQUE KEY suscriptores_token_unique (token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

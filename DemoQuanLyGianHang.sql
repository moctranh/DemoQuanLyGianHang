/*
 Navicat Premium Data Transfer

 Source Server         : Local PostgreSQL
 Source Server Type    : PostgreSQL
 Source Server Version : 110016
 Source Host           : localhost:5432
 Source Catalog        : DemoQuanLyGianHang
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 110016
 File Encoding         : 65001

 Date: 06/06/2023 08:50:57
*/


-- ----------------------------
-- Sequence structure for category_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."category_id_seq";
CREATE SEQUENCE "public"."category_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for decentralization_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."decentralization_id_seq";
CREATE SEQUENCE "public"."decentralization_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for failed_jobs_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."failed_jobs_id_seq";
CREATE SEQUENCE "public"."failed_jobs_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for history_order_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."history_order_id_seq";
CREATE SEQUENCE "public"."history_order_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for list_item_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."list_item_id_seq";
CREATE SEQUENCE "public"."list_item_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for migrations_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."migrations_id_seq";
CREATE SEQUENCE "public"."migrations_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for order_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."order_id_seq";
CREATE SEQUENCE "public"."order_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for permission_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."permission_id_seq";
CREATE SEQUENCE "public"."permission_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for personal_access_tokens_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."personal_access_tokens_id_seq";
CREATE SEQUENCE "public"."personal_access_tokens_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for product_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."product_id_seq";
CREATE SEQUENCE "public"."product_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_id_seq";
CREATE SEQUENCE "public"."users_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS "public"."category";
CREATE TABLE "public"."category" (
  "id" int8 NOT NULL DEFAULT nextval('category_id_seq'::regclass),
  "category" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "description" text COLLATE "pg_catalog"."default" DEFAULT 'Chưa có mô tả...'::text,
  "quantity" int4 DEFAULT 0,
  "turnover" int8 DEFAULT '0'::bigint,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO "public"."category" VALUES (2, 'Laptop', 'Thiết bị thông minh', 0, 0, '2023-06-06 01:00:27', '2023-06-06 01:00:27');
INSERT INTO "public"."category" VALUES (1, 'Sách Giáo Khoa', 'sách giáo khoa', 0, 400000, '2023-06-05 01:41:11', '2023-06-06 01:33:30');

-- ----------------------------
-- Table structure for decentralization
-- ----------------------------
DROP TABLE IF EXISTS "public"."decentralization";
CREATE TABLE "public"."decentralization" (
  "id" int8 NOT NULL DEFAULT nextval('decentralization_id_seq'::regclass),
  "user_id" int8 NOT NULL,
  "permission_id" int8 NOT NULL
)
;

-- ----------------------------
-- Records of decentralization
-- ----------------------------
INSERT INTO "public"."decentralization" VALUES (1, 1, 2);
INSERT INTO "public"."decentralization" VALUES (2, 2, 3);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS "public"."failed_jobs";
CREATE TABLE "public"."failed_jobs" (
  "id" int8 NOT NULL DEFAULT nextval('failed_jobs_id_seq'::regclass),
  "uuid" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "connection" text COLLATE "pg_catalog"."default" NOT NULL,
  "queue" text COLLATE "pg_catalog"."default" NOT NULL,
  "payload" text COLLATE "pg_catalog"."default" NOT NULL,
  "exception" text COLLATE "pg_catalog"."default" NOT NULL,
  "failed_at" timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for history_order
-- ----------------------------
DROP TABLE IF EXISTS "public"."history_order";
CREATE TABLE "public"."history_order" (
  "id" int8 NOT NULL DEFAULT nextval('history_order_id_seq'::regclass),
  "order_id" int8 NOT NULL,
  "product_id" int8 NOT NULL,
  "quantity" int4 NOT NULL,
  "product" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "image" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "description" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0) NOT NULL,
  "updated_at" timestamp(0),
  "price" int8 NOT NULL,
  "confirm" int2 NOT NULL DEFAULT 0,
  "paid" int2 NOT NULL DEFAULT 0,
  "cancel" int2 NOT NULL DEFAULT 0
)
;

-- ----------------------------
-- Records of history_order
-- ----------------------------
INSERT INTO "public"."history_order" VALUES (1, 1, 1, 3, 'Thiên Tài Bên Trái Kẻ Điên Bên Phải', '2751685933581.jpg', 'hehe', '2023-06-05 22:00:57', '2023-06-06 01:00:41', 100000, 1, 1, 0);
INSERT INTO "public"."history_order" VALUES (2, 2, 1, 3, 'Thiên Tài Bên Trái Kẻ Điên Bên Phải', '2751685933581.jpg', 'hehe', '2023-06-06 01:22:18', '2023-06-06 01:22:29', 100000, 1, 1, 0);
INSERT INTO "public"."history_order" VALUES (3, 3, 1, 2, 'Thiên Tài Bên Trái Kẻ Điên Bên Phải', '2751685933581.jpg', 'hehe', '2023-06-06 01:23:55', '2023-06-06 01:32:45', 100000, 1, 1, 0);
INSERT INTO "public"."history_order" VALUES (4, 4, 1, 2, 'Thiên Tài Bên Trái Kẻ Điên Bên Phải', '2751685933581.jpg', 'hehe', '2023-06-06 01:30:29', '2023-06-06 01:33:30', 100000, 1, 1, 0);
INSERT INTO "public"."history_order" VALUES (5, 5, 1, 2, 'Thiên Tài Bên Trái Kẻ Điên Bên Phải', '2751685933581.jpg', 'hehe', '2023-06-06 01:45:40', '2023-06-06 01:45:40', 100000, 0, 0, 0);

-- ----------------------------
-- Table structure for list_item
-- ----------------------------
DROP TABLE IF EXISTS "public"."list_item";
CREATE TABLE "public"."list_item" (
  "id" int8 NOT NULL DEFAULT nextval('list_item_id_seq'::regclass),
  "order_id" int8 NOT NULL,
  "product_id" int8 NOT NULL,
  "quantity" int4 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of list_item
-- ----------------------------
INSERT INTO "public"."list_item" VALUES (1, 1, 1, 3, '2023-06-05 01:53:48', '2023-06-05 21:52:35');
INSERT INTO "public"."list_item" VALUES (3, 2, 1, 3, '2023-06-06 01:22:16', '2023-06-06 01:22:16');
INSERT INTO "public"."list_item" VALUES (4, 3, 1, 2, '2023-06-06 01:23:52', '2023-06-06 01:23:52');
INSERT INTO "public"."list_item" VALUES (5, 4, 1, 2, '2023-06-06 01:30:28', '2023-06-06 01:30:28');
INSERT INTO "public"."list_item" VALUES (6, 5, 1, 2, '2023-06-06 01:45:38', '2023-06-06 01:45:38');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS "public"."migrations";
CREATE TABLE "public"."migrations" (
  "id" int4 NOT NULL DEFAULT nextval('migrations_id_seq'::regclass),
  "migration" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "batch" int4 NOT NULL
)
;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO "public"."migrations" VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO "public"."migrations" VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO "public"."migrations" VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO "public"."migrations" VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO "public"."migrations" VALUES (5, '2022_05_11_015414_create_category_table', 1);
INSERT INTO "public"."migrations" VALUES (6, '2022_05_11_042105_create_product_table', 1);
INSERT INTO "public"."migrations" VALUES (7, '2022_05_11_095855_create_order_table', 1);
INSERT INTO "public"."migrations" VALUES (8, '2022_05_11_101819_create_list_item_table', 1);
INSERT INTO "public"."migrations" VALUES (10, '2022_05_12_013616_create_permission_table', 1);
INSERT INTO "public"."migrations" VALUES (11, '2022_05_12_013820_create_decentralization_table', 1);
INSERT INTO "public"."migrations" VALUES (12, '2022_05_23_012343_create_sessions_table', 2);

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS "public"."order";
CREATE TABLE "public"."order" (
  "id" int8 NOT NULL DEFAULT nextval('order_id_seq'::regclass),
  "customer_id" int8 NOT NULL,
  "customer_ordering" bool NOT NULL DEFAULT true,
  "waiting_confirm" bool NOT NULL DEFAULT true,
  "confirm" bool NOT NULL DEFAULT false,
  "paid" bool NOT NULL DEFAULT false,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO "public"."order" VALUES (1, 1, 'f', 't', 'f', 'f', '2023-06-05 01:53:48', '2023-06-05 22:00:57');
INSERT INTO "public"."order" VALUES (2, 2, 'f', 't', 'f', 'f', '2023-06-06 01:21:14', '2023-06-06 01:22:18');
INSERT INTO "public"."order" VALUES (3, 2, 'f', 't', 'f', 'f', '2023-06-06 01:23:52', '2023-06-06 01:23:55');
INSERT INTO "public"."order" VALUES (4, 2, 'f', 't', 'f', 'f', '2023-06-06 01:30:28', '2023-06-06 01:30:29');
INSERT INTO "public"."order" VALUES (5, 2, 'f', 't', 'f', 'f', '2023-06-06 01:45:38', '2023-06-06 01:45:40');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS "public"."password_resets";
CREATE TABLE "public"."password_resets" (
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "token" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0)
)
;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS "public"."permission";
CREATE TABLE "public"."permission" (
  "id" int8 NOT NULL DEFAULT nextval('permission_id_seq'::regclass),
  "description" varchar(255) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO "public"."permission" VALUES (1, 'Admin');
INSERT INTO "public"."permission" VALUES (2, 'Quản lý');
INSERT INTO "public"."permission" VALUES (3, 'Khách hàng');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS "public"."personal_access_tokens";
CREATE TABLE "public"."personal_access_tokens" (
  "id" int8 NOT NULL DEFAULT nextval('personal_access_tokens_id_seq'::regclass),
  "tokenable_type" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "tokenable_id" int8 NOT NULL,
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "token" varchar(64) COLLATE "pg_catalog"."default" NOT NULL,
  "abilities" text COLLATE "pg_catalog"."default",
  "last_used_at" timestamp(0),
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS "public"."product";
CREATE TABLE "public"."product" (
  "id" int8 NOT NULL DEFAULT nextval('product_id_seq'::regclass),
  "product" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "image" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "category_id" int8 NOT NULL,
  "description" text COLLATE "pg_catalog"."default" NOT NULL,
  "store" int4 NOT NULL,
  "sold" int4 NOT NULL DEFAULT 0,
  "price" int4 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO "public"."product" VALUES (1, 'Thiên Tài Bên Trái Kẻ Điên Bên Phải', '2751685933581.jpg', 1, 'hehe', 11, 4, 100000, '2023-06-05 01:44:07', '2023-06-06 01:45:40');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS "public"."sessions";
CREATE TABLE "public"."sessions" (
  "id" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "user_id" int8,
  "ip_address" varchar(45) COLLATE "pg_catalog"."default",
  "user_agent" text COLLATE "pg_catalog"."default",
  "payload" text COLLATE "pg_catalog"."default" NOT NULL,
  "last_activity" int4 NOT NULL
)
;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO "public"."sessions" VALUES ('hPccyGPKE1xn7AJaeXJIByiI7msmYto2N1hkCQ0w', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVFZENFdqYWx2WTJDdkI0dWloSWlYem5XVUIzYklianNNcThyWUs2VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1686015940);
INSERT INTO "public"."sessions" VALUES ('T42SPRibZdXuId6F4DabRSOu3ctDF2xJGdTVKywT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTHNmV3VRcXNIVlc2TnUxWjBMQm9yQ1o0NndRaEt6bFlsMG5ZNTkyNiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbWFuYWdlci9zdGF0aXN0aWNhbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNjg2MDEzMDQ4O319', 1686016004);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "id" int8 NOT NULL DEFAULT nextval('users_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email_verified_at" timestamp(0),
  "password" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "remember_token" varchar(100) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (1, 'moctranh', 'moctranh2210@gmail.com', NULL, '$2y$10$5xUE48G/RGUFCCM3ZOVUXurevrg9EXQCZR3cPnv8t06aMqntSvhF2', NULL, '2023-06-05 01:27:55', '2023-06-05 01:27:55');
INSERT INTO "public"."users" VALUES (2, 'test', 'ninhtuyet1802@gmail.com', NULL, '$2y$10$GvnTQqdY2pzlKDATk9ipO.VR45RRbAuFecLzITsGc3J4hJ7aRxQ.i', NULL, '2023-06-06 01:20:48', '2023-06-06 01:20:48');

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."category_id_seq"
OWNED BY "public"."category"."id";
SELECT setval('"public"."category_id_seq"', 2, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."decentralization_id_seq"
OWNED BY "public"."decentralization"."id";
SELECT setval('"public"."decentralization_id_seq"', 2, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."failed_jobs_id_seq"
OWNED BY "public"."failed_jobs"."id";
SELECT setval('"public"."failed_jobs_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."history_order_id_seq"
OWNED BY "public"."history_order"."id";
SELECT setval('"public"."history_order_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."list_item_id_seq"
OWNED BY "public"."list_item"."id";
SELECT setval('"public"."list_item_id_seq"', 6, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."migrations_id_seq"
OWNED BY "public"."migrations"."id";
SELECT setval('"public"."migrations_id_seq"', 12, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."order_id_seq"
OWNED BY "public"."order"."id";
SELECT setval('"public"."order_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."permission_id_seq"
OWNED BY "public"."permission"."id";
SELECT setval('"public"."permission_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."personal_access_tokens_id_seq"
OWNED BY "public"."personal_access_tokens"."id";
SELECT setval('"public"."personal_access_tokens_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."product_id_seq"
OWNED BY "public"."product"."id";
SELECT setval('"public"."product_id_seq"', 1, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_id_seq"
OWNED BY "public"."users"."id";
SELECT setval('"public"."users_id_seq"', 2, true);

-- ----------------------------
-- Primary Key structure for table category
-- ----------------------------
ALTER TABLE "public"."category" ADD CONSTRAINT "category_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table decentralization
-- ----------------------------
ALTER TABLE "public"."decentralization" ADD CONSTRAINT "decentralization_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table failed_jobs
-- ----------------------------
ALTER TABLE "public"."failed_jobs" ADD CONSTRAINT "failed_jobs_uuid_unique" UNIQUE ("uuid");

-- ----------------------------
-- Primary Key structure for table failed_jobs
-- ----------------------------
ALTER TABLE "public"."failed_jobs" ADD CONSTRAINT "failed_jobs_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table history_order
-- ----------------------------
ALTER TABLE "public"."history_order" ADD CONSTRAINT "history_order_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table list_item
-- ----------------------------
ALTER TABLE "public"."list_item" ADD CONSTRAINT "list_item_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table migrations
-- ----------------------------
ALTER TABLE "public"."migrations" ADD CONSTRAINT "migrations_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table order
-- ----------------------------
ALTER TABLE "public"."order" ADD CONSTRAINT "order_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table password_resets
-- ----------------------------
CREATE INDEX "password_resets_email_index" ON "public"."password_resets" USING btree (
  "email" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table permission
-- ----------------------------
ALTER TABLE "public"."permission" ADD CONSTRAINT "permission_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table personal_access_tokens
-- ----------------------------
CREATE INDEX "personal_access_tokens_tokenable_type_tokenable_id_index" ON "public"."personal_access_tokens" USING btree (
  "tokenable_type" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST,
  "tokenable_id" "pg_catalog"."int8_ops" ASC NULLS LAST
);

-- ----------------------------
-- Uniques structure for table personal_access_tokens
-- ----------------------------
ALTER TABLE "public"."personal_access_tokens" ADD CONSTRAINT "personal_access_tokens_token_unique" UNIQUE ("token");

-- ----------------------------
-- Primary Key structure for table personal_access_tokens
-- ----------------------------
ALTER TABLE "public"."personal_access_tokens" ADD CONSTRAINT "personal_access_tokens_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table product
-- ----------------------------
ALTER TABLE "public"."product" ADD CONSTRAINT "product_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table sessions
-- ----------------------------
CREATE INDEX "sessions_last_activity_index" ON "public"."sessions" USING btree (
  "last_activity" "pg_catalog"."int4_ops" ASC NULLS LAST
);
CREATE INDEX "sessions_user_id_index" ON "public"."sessions" USING btree (
  "user_id" "pg_catalog"."int8_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table sessions
-- ----------------------------
ALTER TABLE "public"."sessions" ADD CONSTRAINT "sessions_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_email_unique" UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Keys structure for table decentralization
-- ----------------------------
ALTER TABLE "public"."decentralization" ADD CONSTRAINT "decentralization_permission_id_foreign" FOREIGN KEY ("permission_id") REFERENCES "public"."permission" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."decentralization" ADD CONSTRAINT "decentralization_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "public"."users" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table history_order
-- ----------------------------
ALTER TABLE "public"."history_order" ADD CONSTRAINT "history_order_order_id_foreign" FOREIGN KEY ("order_id") REFERENCES "public"."order" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."history_order" ADD CONSTRAINT "history_order_product_id_foreign" FOREIGN KEY ("product_id") REFERENCES "public"."product" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table list_item
-- ----------------------------
ALTER TABLE "public"."list_item" ADD CONSTRAINT "list_item_order_id_foreign" FOREIGN KEY ("order_id") REFERENCES "public"."order" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."list_item" ADD CONSTRAINT "list_item_product_id_foreign" FOREIGN KEY ("product_id") REFERENCES "public"."product" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table order
-- ----------------------------
ALTER TABLE "public"."order" ADD CONSTRAINT "order_customer_id_foreign" FOREIGN KEY ("customer_id") REFERENCES "public"."users" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table product
-- ----------------------------
ALTER TABLE "public"."product" ADD CONSTRAINT "product_category_id_foreign" FOREIGN KEY ("category_id") REFERENCES "public"."category" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

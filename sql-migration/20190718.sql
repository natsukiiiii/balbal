UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '13' WHERE t.`sokyu_cate_cd` LIKE '10' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '3' WHERE t.`sokyu_cate_cd` LIKE '9' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '7' WHERE t.`sokyu_cate_cd` LIKE '6' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '14' WHERE t.`sokyu_cate_cd` LIKE '16' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '15' WHERE t.`sokyu_cate_cd` LIKE '21' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '11' WHERE t.`sokyu_cate_cd` LIKE '3' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '8' WHERE t.`sokyu_cate_cd` LIKE '11' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '6' WHERE t.`sokyu_cate_cd` LIKE '2' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '12' WHERE t.`sokyu_cate_cd` LIKE '7' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '1' WHERE t.`sokyu_cate_cd` LIKE '1' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '16' WHERE t.`sokyu_cate_cd` LIKE '4' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '17' WHERE t.`sokyu_cate_cd` LIKE '8' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '10' WHERE t.`sokyu_cate_cd` LIKE '20' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '18' WHERE t.`sokyu_cate_cd` LIKE '13' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '21' WHERE t.`sokyu_cate_cd` LIKE '12' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '19' WHERE t.`sokyu_cate_cd` LIKE '17' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '2' WHERE t.`sokyu_cate_cd` LIKE '5' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '20' WHERE t.`sokyu_cate_cd` LIKE '18' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '4' WHERE t.`sokyu_cate_cd` LIKE '14' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '5' WHERE t.`sokyu_cate_cd` LIKE '19' ESCAPE '#';
UPDATE `balbal_db`.`m411_sokyu_category_1` t SET t.`order_by` = '9' WHERE t.`sokyu_cate_cd` LIKE '15' ESCAPE '#';

alter table m400_genryo modify top_pic text null;
alter table m400_genryo modify hitokoto text null;
alter table m400_genryo modify item_gaiyo text null;
alter table m400_genryo modify item_nm text null;
alter table m400_genryo modify ippan_nm text null;
alter table m400_genryo modify ippan_nm_kana text null;
alter table m400_genryo modify hanbai_shutai text null;
alter table m400_genryo modify kigyo_cd text null;
alter table m400_genryo modify seibun_nm text null;
alter table m400_genryo modify sokyu_koka text null;
alter table m400_genryo modify shokuten text null;
alter table m400_genryo modify jokyo text null;
alter table m400_genryo modify sotei_hc text null;
alter table m400_genryo modify kanyo text null;
alter table m400_genryo modify kikaku text null;
alter table m400_genryo modify yoko_seibun_kana text null;
alter table m400_genryo modify genryo_ex text null;
alter table m400_genryo modify en_nm text null;
alter table m400_genryo modify naiyo text null;
alter table m400_genryo modify kyokyu text null;
alter table m400_genryo modify seizo_maker text null;
alter table m400_genryo modify shomi_kigen text null;
alter table m400_genryo modify warning text null;
alter table m400_genryo modify kubun text null;
alter table m400_genryo modify tenka_kijun text null;
alter table m400_genryo modify zaikei text null;
alter table m400_genryo modify chaina text null;
alter table m400_genryo modify kaigai text null;
alter table m400_genryo modify pet text null;
alter table m400_genryo modify tokkyo text null;
alter table m400_genryo modify shohyo_logo text null;
alter table m400_genryo modify seijo text null;
alter table m400_genryo modify suiyosei text null;
alter table m400_genryo modify yuyosei text null;
alter table m400_genryo modify allergie text null;
alter table m400_genryo modify gmo_info text null;
alter table m400_genryo modify genseiyaku_hi text null;
alter table m400_genryo modify sesshu text null;
alter table m400_genryo modify anzen_data text null;
alter table m400_genryo modify evidence text null;
alter table m400_genryo modify tokuho text null;
alter table m400_genryo modify sokyu_bui text null;
alter table m400_genryo modify yurai text null;
alter table m400_genryo modify siyo_bui text null;
alter table m400_genryo modify gensankoku text null;
alter table m400_genryo modify saishu_koku text null;
alter table m400_genryo modify link text null;
alter table m400_genryo modify link_nm text null;
alter table m400_genryo modify ninsho_nm text null;
alter table m400_genryo modify ninsho_logo text null;
alter table m400_genryo modify ninsho_logo_halal text null;
alter table m400_genryo modify path text null;
alter table m400_genryo modify up_contents text null comment '2019/07/09';
alter table m400_genryo modify rec_genryo text null comment '2019/07/09';
alter table m200_company modify kigyo_nm text null;
alter table m200_company modify address text null;
alter table m200_company modify tel text null;
alter table m200_company modify fax text null;
alter table m200_company modify kigyo_hp text null;
alter table m200_company modify tantosha text null;
alter table m200_company modify biko text null;
alter table m300_kinosei modify todokede_date text null;
alter table m300_kinosei modify todokede_nm text null;
alter table m300_kinosei modify item_nm text null;
alter table m300_kinosei modify shokuhin_kb text null;
alter table m300_kinosei modify henko_date text null;
alter table m300_kinosei modify tekkai_date text null;
alter table m300_kinosei modify hyoji_kinosei text null;
alter table m300_kinosei modify kanyo_seibun_nm text null;
alter table m300_kinosei modify taisho text null;
alter table m300_kinosei modify hyoka text null;
alter table m300_kinosei modify info text null;
alter table m300_kinosei modify hyoka_hoho text null;
alter table m300_kinosei modify henko_rireki text null;
alter table m300_kinosei modify tekkai_jiyu text null;
alter table m300_kinosei modify shohi_info text null;
alter table m300_kinosei modify meyasu text null;
alter table m300_kinosei modify kanyo_seibun text null;
alter table m300_kinosei modify genzairyo_nm text null;
alter table m300_kinosei modify pict text null;
alter table m300_kinosei modify hp text null;
alter table m300_kinosei modify meisho text null;
alter table m300_kinosei modify hanbai_yotei_date text null;
alter table m300_kinosei modify kinosei_shokuhin text null;
alter table m300_kinosei modify search_kanyo text null;
alter table m500_benchmark modify keisai_date text null;
alter table m500_benchmark modify top_pic text null;
alter table m500_benchmark modify hanbai_nm text null;
alter table m500_benchmark modify item_nm text null;
alter table m500_benchmark modify shokuhin_kb text null;
alter table m500_benchmark modify zaikei text null;
alter table m500_benchmark modify meyasu text null;
alter table m500_benchmark modify kn text null;
alter table m500_benchmark modify sale_kn text null;
alter table m500_benchmark modify day_kn text null;
alter table m500_benchmark modify shuseibun text null;
alter table m500_benchmark modify genzairyo_nm text null;
alter table m500_benchmark modify yukoseibun text null;
alter table m500_benchmark modify juryo text null;
alter table m500_benchmark modify naiyoryo text null;
alter table m500_benchmark modify shurui text null;
alter table m500_benchmark modify site text null;
alter table m500_benchmark modify tokucho text null;
alter table m005_code modify code_nm text null;
alter table m005_code modify code_rnm text null;
alter table m005_code modify sort_no text null;
alter table m005_code modify moji_1 text null;
alter table m005_code modify moji_2 text null;
alter table m005_code modify moji_3 text null;
alter table m005_code modify moji_4 text null;
alter table m005_code modify moji_5 text null;
alter table m010_user modify name text null;
alter table m010_user modify biko text null;
alter table m301_kinosei_category modify kinosei_category text null;alter table m301_kinosei_category modify biko text null;
alter table m302_kinosei_category_genryo modify kinosei_stg text null;
alter table m302_kinosei_category_genryo modify biko text null;
alter table m303_kinosei_supplier modify kinosei_cd text not null;
alter table m303_kinosei_supplier modify url text null;
alter table m303_kinosei_supplier modify genryo_mei text null;
alter table m401_genryo_sokyu modify biko text null;
alter table m402_genryo_yoto modify biko text null;
alter table m403_genryo_link modify url text null;
alter table m403_genryo_link modify link_mei text null;
alter table m411_sokyu_category_1 modify sokyu_cate_nm text null;
alter table m411_sokyu_category_1 modify biko text null;
alter table m412_sokyu_category_2 modify sokyu_cate2_nm text null;
alter table m412_sokyu_category_2 modify biko text null;
alter table m413_sokyu_category_3 modify sokyu_cate3_nm text null;
alter table m413_sokyu_category_3 modify biko text null;
alter table m421_yoto_category1 modify yoto_cate_nm text null;
alter table m421_yoto_category1 modify biko text null;
alter table m422_yoto_category2 modify yoto_cate2_nm text null;
alter table m422_yoto_category2 modify biko text null;
alter table m423_yoto_category3 modify yoto_cate3_nm text null;
alter table m423_yoto_category3 modify biko text null;
alter table m430_shokuten modify shokuten_nm text null;
alter table m430_shokuten modify biko text null;
alter table m440_sokyubui modify sokyu_bui_nm text null;
alter table m440_sokyubui modify biko text null;
alter table m450_gensan modify gensan_nm text null;
alter table m450_gensan modify gensan_kana text null;
alter table m450_gensan modify biko text null;
alter table m460_ninsho modify ninsho_nm text null;
alter table m460_ninsho modify biko text null;
alter table m470_seibun modify seibun_nm text null;
alter table m470_seibun modify seibun_header text null;
alter table m470_seibun modify biko text null;
alter table m501_benchmark_genryo modify seibun text null;
alter table m502_benchmark_supplier modify bench_cd text not null;
alter table m502_benchmark_supplier modify url text null;
alter table m502_benchmark_supplier modify genryo_mei text null;
alter table m503_mokuteki_cate_ch modify biko text null;
alter table m504_mokuteki_category_1 modify mokuteki_cate_nm text null;
alter table m504_mokuteki_category_1 modify biko text null;
alter table m505_mokuteki_category_2 modify mokuteki_cate2_nm text null;
alter table m505_mokuteki_category_2 modify biko text null;
alter table m506_mokuteki_category_3 modify mokuteki_cate3_nm text null;
alter table m506_mokuteki_category_3 modify biko text null;

create or replace view `#__rwnews` as
select `n`.`id`            AS `id`,
       `n`.`catID`         AS `catID`,
       `n`.`themeID`         AS `themeID`,
       `n`.`authorID`      AS `authorID`,
       `n`.`title`         AS `title`,
       `n`.`text`          AS `text`,
       `n`.`dat`           AS `dat`,
       `n`.`img_prev`      AS `img_prev`,
       `n`.`img_full`      AS `img_full`,
       `n`.`link_original` AS `link_original`,
       `n`.`link_group`    AS `link_group`,
       `n`.`published`     AS `published`,
       `c`.`title`         AS `category`,
       `t`.`title`         AS `theme`,
       `u`.`name`          AS `user`
from `#__rwnews_news` `n`
         left join `#__users` `u` FORCE INDEX (PRIMARY) on `n`.`authorID` = `u`.`id`
         left join `#__rwnews_categories` `c` FORCE INDEX (PRIMARY) on `c`.`id` = `n`.`catID`
         left join `#__rwnews_themes` t on n.themeID = t.id;

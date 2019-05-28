alter table `#__rwnews_news`
    add link_original text default null null after img_full;

alter table `#__rwnews_news`
    add link_group text default null null after link_original;

create or replace view `#__rwnews` as
select n.*,
       c.title as category,
       u.name as user
from `#__rwnews_news` n
         left join `#__users` u force key (`PRIMARY`) on n.authorID = u.id
         left join `#__rwnews_categories` c force key (`PRIMARY`) on c.id = n.catID;


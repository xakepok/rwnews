alter table `#__rwnews_news`
    add date_start timestamp default null null comment 'Начало публикации' after dat;

alter table `#__rwnews_news`
    add date_end timestamp default null null comment 'Окончание публикации' after date_start;

drop index `#__rwnews_news_published_index` on `#__rwnews_news`;

create index `#__rwnews_news_published_date_start_date_end_index`
    on `#__rwnews_news` (published, date_start, date_end);


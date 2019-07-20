create table `#__rwnews_themes`
(
    id int unsigned auto_increment,
    title text not null comment 'Название темы',
    authorID int not null,
    published bool default 1 not null,
    constraint `#__rwnews_themes_pk`
        primary key (id),
    constraint `#__rwnews_themes_#__users_id_fk`
        foreign key (authorID) references `#__users` (id)
)
    comment 'Темы';

create index `#__rwnews_themes_published_index`
    on `#__rwnews_themes` (published);

alter table `#__rwnews_news`
    add themeID int unsigned default null null after authorID;

alter table `#__rwnews_news`
    add constraint `#__rwnews_news_#__rwnews_themes_id_fk`
        foreign key (themeID) references `#__rwnews_themes` (id);


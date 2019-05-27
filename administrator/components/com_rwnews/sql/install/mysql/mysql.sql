create table `#__rwnews_categories`
(
    id int auto_increment,
    title text not null,
    published boolean default 1 not null,
    constraint `#__rwnews_categories_pk`
        primary key (id)
)
    comment 'Категории';

create index `#__rwnews_categories_published_index`
    on `#__rwnews_categories` (published);


create table `#__rwnews_news`
(
    id int auto_increment,
    catID int not null,
    authorID int not null,
    title text not null,
    text text default null null,
    dat timestamp default current_timestamp not null,
    published boolean default 1 null,
    constraint `#__rwnews_news_pk`
        primary key (id),
    constraint `#__rwnews_news_#__rwnews_categories_id_fk`
        foreign key (catID) references `#__rwnews_categories` (id),
    constraint `#__rwnews_news_#__users_id_fk`
        foreign key (authorID) references `#__users` (id)
)
    comment 'Новости';

create index `#__rwnews_news_dat_index`
    on `#__rwnews_news` (dat);

create index `#__rwnews_news_published_index`
    on `#__rwnews_news` (published);

create table `#__rwnews_stations`
(
    id int auto_increment,
    newsID int not null,
    stationID int not null,
    constraint `#__rwnews_stations_pk`
        primary key (id),
    constraint `#__rwnews_stations_#__rw_stations_id_fk`
        foreign key (stationID) references `#__rw_stations` (id),
    constraint `#__rwnews_stations_#__rwnews_news_id_fk`
        foreign key (newsID) references `#__rwnews_news` (id)
            on update cascade on delete cascade
)
    comment 'Привязка новостей к станциям';


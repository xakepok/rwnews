create table `#__rwnews_directions`
(
    id int auto_increment,
    newsID int not null,
    directionID int not null,
    constraint `#__rwnews_directions_pk`
        primary key (id),
    constraint `#__rwnews_directions_#__rw_directions_id_fk`
        foreign key (directionID) references `#__rw_directions` (id)
            on update cascade on delete cascade,
    constraint `#__rwnews_directions_#__rwnews_news_id_fk`
        foreign key (newsID) references `#__rwnews_news` (id)
            on update cascade on delete cascade
)
    comment 'Привязки новостей к направлениям';

create unique index `#__rwnews_directions_newsID_directionID_uindex`
    on `#__rwnews_directions` (newsID, directionID);


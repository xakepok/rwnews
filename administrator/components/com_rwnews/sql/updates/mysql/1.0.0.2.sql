create unique index `#__rwnews_stations_newsID_stationID_uindex`
    on `#__rwnews_stations` (newsID, stationID);

alter table `#__rwnews_news`
    add img_prev text default null null after dat;

alter table `#__rwnews_news`
    add img_full text default null null after img_prev;


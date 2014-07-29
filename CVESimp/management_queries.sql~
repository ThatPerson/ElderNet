select articles.name articles.url articles.simplified articles.date_ from articles, users, tags, t_connections where tags.tag = '' and tags.id = t_connections.tid and t_connections.orig = 1 and articles.tid = t_connections.uid_ order by articles.date_p desc limit 15;

select tags.tag from tags, t_connections, users where users.uid_ = t_connection.uid_ and tags.id = t_connections.tid and t_connections.orig = 0;



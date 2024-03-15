Create database Url_shortner;

use url_shortner;

CREATE table url (
	id int primary key auto_increment,
    long_url text(255),
    short_url text(255) 
	);
    
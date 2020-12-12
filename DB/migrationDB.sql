CREATE TABLE store
(
    ID int not null auto_increment,
    CITY varchar(500) not null,
    PRIMARY KEY (ID)
);

INSERT INTO store (CITY) VALUES ('Калининград'),('Черняховск'), ('Советск');

CREATE TABLE books_store
(
	BOOK_ID int not null,
	STORE_ID int not null,
	PRICE DECIMAL(10, 2),
	QUANTITY int unsigned not null default 0,
	PRIMARY KEY (BOOK_ID, STORE_ID),
	INDEX IX_STORE (STORE_ID),
	FOREIGN KEY FK_BOOKS_STORE_BOOK (BOOK_ID) references book(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_BOOKS_STORE_STORE (STORE_ID) references store(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

INSERT INTO books_store (BOOK_ID, STORE_ID, PRICE, QUANTITY)
SELECT book.ID,
       (select store.ID from store where store.CITY = 'Калининград'),
       book.PRICE,
       book.QUANTITY
FROM book;

INSERT INTO books_store (BOOK_ID, STORE_ID)
SELECT book.ID, store.ID from book, store where store.CITY != 'Калининград';

ALTER TABLE book DROP COLUMN PRICE;
ALTER TABLE book DROP COLUMN QUANTITY;


#1
# Подсчитать количество книг каждого автора (наименований).
# Столбцы ответа: Имя автора, общее количество книг

SELECT author.NAME, COUNT(BOOK_ID) as Total_number_of_book
FROM author_book
    JOIN author on author.ID = author_book.AUTHOR_ID
GROUP BY author.ID;


#2
# Подсчитать суммарный остаток книг каждого автора во всех магазинах.
# Столбцы ответа: Имя автора, Город магазина, Суммарный остаток книг

SELECT author.NAME,s.CITY, SUM(QUANTITY) as total_quantity
FROM author
	     JOIN author_book ab on author.ID = ab.AUTHOR_ID
	     JOIN book_store bs on ab.BOOK_ID = bs.BOOK_ID
	     JOIN store s on s.ID = bs.STORE_ID
GROUP BY author.ID, s.ID;

#3
# Вывести среднюю стоимость книг издательства «Азбука».
# Столбцы ответа: Название книги, средняя стоимость.

SELECT b.NAME, AVG(book_store.PRICE) as Avg_Price
FROM book_store
	     JOIN book b on b.ID = book_store.BOOK_ID
WHERE PUBLISHER_ID =
      (SELECT publisher.ID
       FROM publisher
       WHERE publisher.NAME = 'Азбука')
GROUP BY b.ID;

#4
# Вывести среднюю стоимость книг издательства «Азбука» в каждом магазине.
# Столбцы ответа: Город, Название книги, средняя стоимость

SELECT s.CITY, b.NAME, AVG(book_store.PRICE) as Avg_Price
FROM book_store
    JOIN book b on b.ID = book_store.BOOK_ID
    JOIN store s on s.ID = book_store.STORE_ID
WHERE
      PUBLISHER_ID = (SELECT publisher.ID
                     FROM publisher
                     WHERE publisher.NAME = 'Азбука')
GROUP BY s.CITY, b.ID;

#5
# Вывести разницу между остатком книг в Калининграде и Черняховске.
# Столбцы ответа: Название книги, остаток в Калининграде, остаток в Черняховске, Разница.


SELECT b.NAME,
       bs.QUANTITY as Quantity_Kaliningrad,
       bs1.QUANTITY Quantity_Chernyakhovsk,
       ABS(IFNULL(bs.QUANTITY, 0) - IFNULL(bs1.QUANTITY, 0)) as difference
FROM book_store bs
	     left join (SELECT BOOK_ID, QUANTITY
	                FROM  book_store
		                      JOIN store on store.ID = book_store.STORE_ID
	                WHERE CITY = 'Черняховск') bs1 on bs.BOOK_ID = bs1.BOOK_ID
	     JOIN book b on bs.BOOK_ID = b.ID
	     JOIN store s on s.ID = bs.STORE_ID
WHERE CITY= 'Калининград'

union

SELECT b.NAME,
       bs1.QUANTITY,
       bs.QUANTITY,
       ABS(IFNULL(bs.QUANTITY, 0) - IFNULL(bs1.QUANTITY, 0)) as difference
FROM book_store bs
	     left join (SELECT BOOK_ID, QUANTITY
	                FROM  book_store
		                      JOIN store on store.ID = book_store.STORE_ID
	                WHERE CITY = 'Калининград') bs1 on bs.BOOK_ID = bs1.BOOK_ID
	     JOIN book b on bs.BOOK_ID = b.ID
	     JOIN store s on s.ID = bs.STORE_ID
WHERE CITY= 'Черняховск';
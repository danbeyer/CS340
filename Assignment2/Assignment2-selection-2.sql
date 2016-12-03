-- Author: Daniel Beyer
-- CS340 - SQL Assignment
-- Date: 11/8/16

#1 Find the film title and language name of all films in which ADAM GRANT acted
#Order the results by title, descending (use ORDER BY title DESC at the end of the query)

SELECT title, language.name  FROM language INNER JOIN film 
ON language.language_id = film.language_id
INNER JOIN film_actor 
ON film.film_id = film_actor.film_id INNER JOIN actor
ON actor.actor_id = film_actor.actor_id
WHERE actor.first_name = "ADAM" AND actor.last_name = "GRANT"
ORDER BY title DESC;



#2 We want to find out how many of each category of film ED CHASE has started in so return a table with category.name and the count
#of the number of films that ED was in which were in that category order by the category name ascending (Your query should return every category even if ED has been in no films in that category).

SELECT c.name, count(table2.name) FROM category c LEFT JOIN
(SELECT c2.name FROM category c2 INNER JOIN film_category fc
ON c2.category_id = fc.category_id INNER JOIN film f
ON f.film_id = fc.film_id INNER JOIN film_actor fa
ON f.film_id = fa.film_id INNER JOIN actor a 
ON a.actor_id = fa.actor_id WHERE a.first_name = "ED" and a.last_name = "CHASE") AS table2
ON c.name = table2.name
GROUP BY c.name
ORDER BY c.name ASC;


#3 Find the first name, last name and total combined film length of Sci-Fi films for every actor
#That is the result should list the names of all of the actors(even if an actor has not been in any Sci-Fi films)and the total length of Sci-Fi films they have been in.

SELECT a.first_name, a.last_name, SUM(f.length) FROM actor a LEFT JOIN
(SELECT fa.actor_id, f.film_id FROM film_actor fa INNER JOIN film f
ON fa.film_id = f.film_id INNER JOIN film_category fc
ON fc.film_id = f.film_id INNER JOIN category c 
ON fc.category_id = c.category_id WHERE c.name = "Sci-Fi") AS table2
ON a.actor_id = table2.actor_id LEFT JOIN film f
ON f.film_id = table2.film_id
GROUP BY a.actor_id;


#4 Find the first name and last name of all actors who have never been in a Sci-Fi film

SELECT a.first_name, a.last_name FROM actor a WHERE a.actor_id NOT IN 
(SELECT a2.actor_id FROM actor a2 INNER JOIN film_actor fa 
ON a2.actor_id = fa.actor_id INNER JOIN film f
ON fa.film_id = f.film_id INNER JOIN film_category fc
ON fc.film_id = f.film_id INNER JOIN category c
ON c.category_id = fc.category_id WHERE c.name = "Sci-Fi")
GROUP BY a.actor_id; 


#5 Find the film title of all films which feature both KIRSTEN PALTROW and WARREN NOLTE
#Order the results by title, descending (use ORDER BY title DESC at the end of the query)
#Warning, this is a tricky one and while the syntax is all things you know, you have to think oustide
#the box a bit to figure out how to get a table that shows pairs of actors in movies

SELECT f.title FROM film f INNER JOIN 
(SELECT f.title FROM film f INNER JOIN film_actor fa
ON f.film_id = fa.film_id INNER JOIN actor a
ON a.actor_id = fa.actor_id WHERE a.first_name = "KIRSTEN" AND a.last_name = "PALTROW") AS kpaltrow
ON f.title = kpaltrow.title INNER JOIN 
(SELECT f.title FROM film f INNER JOIN film_actor fa
ON f.film_id = fa.film_id INNER JOIN actor a
ON a.actor_id = fa.actor_id WHERE a.first_name = "WARREN" AND a.last_name = "NOLTE") AS wnolte
ON kpaltrow.title = wnolte.title
ORDER BY title DESC;



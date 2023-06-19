--- В базе данных имеется таблица с товарами goods (id INTEGER, name TEXT), таблица с тегами tags (id INTEGER, name TEXT) и
-- таблица связи товаров и тегов goods_tags (tag_id INTEGER, goods_id INTEGER, UNIQUE(tag_id, goods_id)).
-- Выведите id и названия всех товаров, которые имеют все возможные теги в этой базе.

SELECT g.id, g.name FROM goods_tags gt INNER JOIN goods g ON g.id = gt.goods_id INNER JOIN tags t ON t.id = gt.tag_id GROUP BY g.id

---Выбрать без join-ов и подзапросов все департаменты, в которых есть мужчины, и все они (каждый) поставили высокую оценку (строго выше 5).
SELECT * FROM `evaluations` WHERE gender = 1 and value > 5 GROUP BY department_id

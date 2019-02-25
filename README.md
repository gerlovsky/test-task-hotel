# Тестовое задание для PHP-разработчика

Напишите класс или классы, с помощью объектов которых можно представлять, хранить и обрабатывать информацию о Номерах в Гостинице.

У каждого Номера есть обязательные атрибуты - идентификатор (например, "203") и число мест (1-местный, 2-местный итд.). Они не изменяемы. Номер может быть забронирован Гостем на один или более дней подряд. Два разных Гостя не могут забронировать один и тот же Номер на один и тот же день.

С Номером можно совершать такие операции:
- Забронировать этот Номер для Гостя на определенный диапазон дат (например, с 1 ноября по 4 ноября) по определенной цене (например, 500 тугриков). Цена может быть разная в зависимости от дня, Гостя, итд. Ее вычислять не требуется, она будет передана явно.
- Проверить, свободен ли Номер в определенный день (например, 1 ноября 2018)
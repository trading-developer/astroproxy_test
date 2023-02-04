## Порядок установки

```
1. git clone https://github.com/trading-developer/astroproxy_test
2. cd astroproxy_test && cd docker
3. make init
```

## Команды
```
1. make gophp - переходим в php контейнер
```

## Запуск тестов
```
1. cd docker
2. make tests
```

## Информация
```
1. https://api.postman.com/collections/23579261-1d8ea253-b102-469b-a089-c02548c33097?access_key=PMAT-01GREX6QHASKT9WMTHN5K0G6KN - постман API запросы
2. 
```

## Описание задачи

Реализовать CRUD-интерфейс списка пользователей и их платежей на Laravel и Vue.js
Сделать возможность редактирования данных пользователя (email, имя, номер телефона) и просмотра его платежей
1) Весь front-end реализовать на Vue.js через API к back-end на Laravel
2) Всё должно быть под авторизацией, в т.ч. API
   API:
   GET /users
   GET /users/1
   POST /users
   DELETE /users
   GET /users/1/payments

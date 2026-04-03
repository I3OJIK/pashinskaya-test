# Тестовое задание

## Setup

### Клонирование проекта:
```bash
git clone git@github.com:I3OJIK/pashinskaya-test.git pashinskayaTest  
cd pashinskayaTest
```
### Разворачивание проекта:

Если порт 3008 свободен запускаем команду:
```bash
make setup
```
Если нужно изменить порт:
```bash
# Добавляем в .env.example DB_EXTERNAL_PORT и после этого 
make setup
```

После успешного разворачивания список задач доуступен по адресу - http://localhost:3007/tasks

БД наполнена тестовыми задачами.

Для валидации и работы с дто использовалась библиотека Laravel data от Spatie.


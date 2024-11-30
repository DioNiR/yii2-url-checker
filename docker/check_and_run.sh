#!/bin/bash

# Команда для запуска
COMMAND="php /app/yii queue/listen"

# Функция для проверки, запущен ли процесс
is_process_running() {
    pgrep -f "$COMMAND" > /dev/null 2>&1
}

# Проверка, запущен ли процесс
if ! is_process_running; then
    echo "Процесс не запущен. Запускаем..."
    # Запуск команды
    nohup $COMMAND > /dev/null 2>&1 &
else
    echo "Процесс уже запущен."
fi